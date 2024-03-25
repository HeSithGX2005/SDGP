#include <Wire.h>
#include <MPU6050.h>
#include <WiFi.h>
#include <HTTPClient.h>

MPU6050 mpu;

#define HOST "localhost"
#define WIFI_SSID "Dialog 4G 833"
#define WIFI_PASSWORD "7949kaweya"

const float ACCEL_THRESHOLD = 1000;
const float ANGLE_THRESHOLD = 60;
const int FALL_DURATION = 200;

int16_t ax, ay, az;
float angleX, angleY;
unsigned long fallStartTime;

void checkWiFiConnection() {
  while (WiFi.status() != WL_CONNECTED) {
    Serial.println("Connecting to Wi-Fi...");
    delay(1000);
  }
  Serial.println("Connected to Wi-Fi");
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());
}

void setup() {
  Serial.begin(115200);
  Wire.begin();
  mpu.initialize();
  Serial.println(mpu.testConnection() ? "MPU6050 connection successful" : "MPU6050 connection failed");

  WiFi.mode(WIFI_STA);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  checkWiFiConnection();

  mpu.getAcceleration(&ax, &ay, &az);
  angleX = atan2(ax, sqrt(ay * ay + az * az)) * 180 / PI;
  angleY = atan2(ay, sqrt(ax * ax + az * az)) * 180 / PI;
}

void loop() {
  checkWiFiConnection();
  mpu.getAcceleration(&ax, &ay, &az);
  float accelerationMagnitude = sqrt(ax * ax + ay * ay + az * az);
  angleX = atan2(ax, sqrt(ay * ay + az * az)) * 180 / PI;
  angleY = atan2(ay, sqrt(ax * ax + az * az)) * 180 / PI;

  if (isFallDetected(accelerationMagnitude, angleX, angleY)) {
    Serial.println("Fall detected!");
    sendFallDataToDatabase("Fall detected!");
    delay(FALL_DURATION);
  }

  delay(100);
}

bool isFallDetected(float accelerationMagnitude, float angleX, float angleY) {
  static float prevAngleX, prevAngleY;

  if (accelerationMagnitude > ACCEL_THRESHOLD &&
      (abs(angleX - prevAngleX) > ANGLE_THRESHOLD || abs(angleY - prevAngleY) > ANGLE_THRESHOLD)) {
    fallStartTime = millis();
    prevAngleX = angleX;
    prevAngleY = angleY;
    return true;
  } else if (millis() - fallStartTime > FALL_DURATION) {
    fallStartTime = 0;
  }

  return false;
}

void sendFallDataToDatabase(String postData) {
  WiFiClient client;
  HTTPClient http;

  http.begin("http://192.168.8.188/SDGP/Helmet System Softwares/Fall_Detection/FALL_DETECTION/SCRIPT.PHP");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpResponseCode = http.POST(postData);

  if (httpResponseCode == HTTP_CODE_OK) {
    String response = http.getString();
    Serial.println("Server response: " + response);
  } else {
    Serial.print("HTTP POST request failed with error code: ");
    Serial.println(httpResponseCode);
    if (httpResponseCode == HTTPC_ERROR_CONNECTION_REFUSED) {
      Serial.println("Connection refused by the server.");
    } else if (httpResponseCode == HTTP_CODE_NOT_FOUND) {
      Serial.println("Server resource not found.");
    } else {
      Serial.println("Unknown error occurred.");
    }
  }

  http.end();
}