#define trigPin1 12        // Trig Pin Of HC-SR04 (Left Sensor)
#define echoPin1 13           // Echo Pin Of HC-SR04 (Left Sensor)
#define trigPin2 6           // Trig Pin Of HC-SR04 (Rear Sensor)
#define echoPin2 7           // Echo Pin Of HC-SR04 (Rear Sensor)
#define trigPin3 11           // Trig Pin Of HC-SR04 (Right Sensor)
#define echoPin3 10           // Echo Pin Of HC-SR04 (Right Sensor)
#define buzzerPin 1         // Buzzer Pin

long duration1, distance1, duration2, distance2, duration3, distance3;

void setup() {
  Serial.begin(9600);
  pinMode(buzzerPin, OUTPUT);  // Set Buzzer Pin as Output
  pinMode(trigPin1, OUTPUT);   // Set Trig Pins as Output to Transmit Waves
  pinMode(echoPin1, INPUT);    // Set Echo Pins as Input to Receive Reflected Waves
  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);
  pinMode(trigPin3, OUTPUT);
  pinMode(echoPin3, INPUT);
}

void loop() {
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

  // Print distances for debugging
  Serial.print("Left Distance: ");
  Serial.print(distance1);
  Serial.print(" cm, Rear Distance: ");
  Serial.print(distance2);
  Serial.print(" cm, Right Distance: ");
  Serial.print(distance3);
  Serial.println(" cm");

  // Check for incorrect readings and apply delay if needed
  if (distance1 <= 0 || distance1 > 200 || distance2 <= 0 || distance2 > 200 || distance3 <= 0 || distance3 > 200) {
    delay(1000); 
    return; 
  }

  // Activate buzzer if an edge or obstacle is detected within a certain distance by any sensor
  if (distance1 <= 200 || distance2 <= 200 || distance3 <= 200) {
    digitalWrite(buzzerPin, HIGH); // Turn on the buzzer
    Serial.println("Edge Detected");
  } else {
    digitalWrite(buzzerPin, LOW); // Turn off the buzzer
  }

  delay(1000); // Adjust the delay as needed
}
