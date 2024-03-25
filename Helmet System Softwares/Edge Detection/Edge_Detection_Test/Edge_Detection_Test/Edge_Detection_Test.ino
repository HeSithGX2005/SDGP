#include <AUnit.h>

long mockDistance1 = 100;
long mockDistance2 = 50;
long mockDistance3 = 300;

void mockSensorReadings(long* distance1, long* distance2, long* distance3) {
  *distance1 = mockDistance1;
  *distance2 = mockDistance2;
  *distance3 = mockDistance3;
}

test(edge_detection) {
  long distance1, distance2, distance3;

  // Scenario 1: No edge detected
  mockDistance1 = 150;
  mockDistance2 = 180;
  mockDistance3 = 250;
  mockSensorReadings(&distance1, &distance2, &distance3);

  mockDistance1 = 50;
  mockDistance2 = 180;
  mockDistance3 = 250;
  mockSensorReadings(&distance1, &distance2, &distance3);

}

// Test runner
void setup() {
  Serial.begin(115200);
  while (!Serial); 
}

void loop() {
  aunit::TestRunner::run();
}