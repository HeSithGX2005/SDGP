#define trigPin1 12          // Trig Pin Of HC-SR04 (Left Sensor)
#define echoPin1 13          // Echo Pin Of HC-SR04 (Left Sensor)
#define trigPin2 6           // Trig Pin Of HC-SR04 (Rear Sensor)
#define echoPin2 7           // Echo Pin Of HC-SR04 (Rear Sensor)
#define trigPin3 11          // Trig Pin Of HC-SR04 (Right Sensor)
#define echoPin3 10          // Echo Pin Of HC-SR04 (Right Sensor)
#define trigPin4 8           // Trig Pin Of HC-SR04 (Upwards Sensor)
#define echoPin4 9           // Echo Pin Of HC-SR04 (Upwards Sensor)
#define buzzerPin 4          // Buzzer Pin
#define aqsensor A0          // Air Quality Sensor Pin
#define ledPin 3             // LED Pin

long duration1, distance1, duration2, distance2, duration3, distance3, duration4, distance4;
int threshold = 500; // Set the threshold for air quality

void setup() {
  Serial.begin(9600);
  pinMode(buzzerPin, OUTPUT);  // Set Buzzer Pin as Output
  pinMode(ledPin, OUTPUT);     // Set LED Pin as Output
  pinMode(trigPin1, OUTPUT);   // Set Trig Pins as Output to Transmit Waves
  pinMode(echoPin1, INPUT);    // Set Echo Pins as Input to Receive Reflected Waves
  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  pinMode(trigPin3, OUTPUT);
  pinMode(echoPin3, INPUT);
  pinMode(trigPin4, OUTPUT);
  pinMode(echoPin4, INPUT);
}

void loop() {
  checkAirQuality(); // Call function to check air quality
  
  // Front Sensor
  digitalWrite(trigPin1, LOW);
  delayMicroseconds(10);
  digitalWrite(trigPin1, HIGH);   // Transmit Waves
  delayMicroseconds(30);
  duration1 = pulseIn(echoPin1, HIGH);  // Receive Reflected Waves
  distance1 = duration1 * 0.0343 / 2;    // Calculate Distance

  // Rear Sensor
  digitalWrite(trigPin2, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin2, HIGH);   // Transmit Waves
  delayMicroseconds(10);
  duration2 = pulseIn(echoPin2, HIGH);  // Receive Reflected Waves
  distance2 = duration2 * 0.0343 / 2;    // Calculate Distance

  // Side Sensor
  digitalWrite(trigPin3, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin3, HIGH);   // Transmit Waves
  delayMicroseconds(10);
  duration3 = pulseIn(echoPin3, HIGH);  // Receive Reflected Waves
  distance3 = duration3 * 0.0343 / 2;    // Calculate Distance

  // Upwards Sensor
  digitalWrite(trigPin4, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin4, HIGH);  // Transmit Waves For 10us
  delayMicroseconds(10);
  duration4 = pulseIn(echoPin4, HIGH);  // Receive Reflected Waves
  distance4 = duration4 * 0.0343 / 2;    // Convert duration to distance

  // Print distances for debugging
  Serial.print("Left Distance: ");
  Serial.print(distance1);
  Serial.print(" cm, Rear Distance: ");
  Serial.print(distance2);
  Serial.print(" cm, Right Distance: ");
  Serial.print(distance3);
  Serial.print(" cm, Upwards: ");
  Serial.println(distance4);

  // Check for incorrect readings and apply delay if needed
  if (distance1 <= 0 || distance1 > 200 || distance2 <= 0 || distance2 > 200 || distance3 <= 0 || distance3 > 200 || distance4 <= 0 || distance4 > 200) {
    delay(1000); 
    return; 
  }

  // Activate buzzer if an edge or obstacle is detected within a certain distance by any sensor
  if (distance1 <= 200 || distance2 <= 200 || distance3 <= 200 || distance4 <= 200) {
    digitalWrite(buzzerPin, HIGH); // Turn on the buzzer
    digitalWrite(ledPin, HIGH);    // Turn on the LED
    Serial.println("Edge Detected");
  } else {
    digitalWrite(buzzerPin, LOW); // Turn off the buzzer
    digitalWrite(ledPin, LOW);    // Turn off the LED
  }

  delay(1000); // Adjust the delay as needed
}

// Function to check air quality
void checkAirQuality() {
  int ppm = analogRead(aqsensor); // Read MQ135 analog outputs at specified pin and store it in ppm

  Serial.print("Air Quality: ");  // Print message in serial monitor
  Serial.println(ppm);            // Print value of ppm in serial monitor

  
  if (ppm < threshold) {          // Check if ppm is greater than threshold or not
    Serial.println("AQ Level HIGH");
    tone(buzzerPin, 1000, 200);    // Sound the buzzer
  } else {
    noTone(buzzerPin);             // Turn off the buzzer if air quality is good
    Serial.println("AQ Level Good");
  }
  delay(500);
}

