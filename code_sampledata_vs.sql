INSERT INTO Gas_Sensor (Gas_Type, Detection_Range) VALUES 
('Carbon Monoxide', '0-1000 ppm'),
('Methane', '0-5000 ppm'),
('Propane', '0-10000 ppm');


INSERT INTO Air_Quality_Sensor (Detection_Range, Pollutant) VALUES 
('0-100 ppm', 'Carbon Monoxide'),
('0-200 ppm', 'Sulfur Dioxide'),
('0-300 ppm', 'Nitrogen Dioxide');


INSERT INTO Communication_Module (Type, SIM_Number) VALUES 
('Wi-Fi', '1234567890'),
('GSM', '0987654321'),
('Bluetooth', '1357902468');


INSERT INTO Lighting_System (Type, Brightness_Level) VALUES 
('LED', 'High'),
('Fluorescent', 'Medium'),
('Incandescent', 'Low');


INSERT INTO Feedback_Mechanism_System (Type, Description) VALUES 
('Button', 'Physical button for feedback'),
('Touchscreen', 'Interactive touchscreen for feedback'),
('Voice', 'Voice recognition system for feedback');


INSERT INTO Emergency_Response_System (Contact_Number, Response_Type) VALUES 
('911', 'Medical'),
('999', 'Fire'),
('112', 'Police');


INSERT INTO Hazard_Detection_System (Type, Description) VALUES 
('Fire Alarm', 'Detects smoke or fire'),
('Intrusion Detection', 'Detects unauthorized entry'),
('Gas Leak Detector', 'Detects leaks of combustible gases');


INSERT INTO Health_Monitoring_System (Vital_Sign, Alert) VALUES 
('Heart Rate', 'High'),
('Blood Pressure', 'Low'),
('Blood Oxygen Level', 'Normal');


INSERT INTO Productivity_Monitoring_System (Activity, Time) VALUES 
('Meetings', '10:00 AM - 11:00 AM'),
('briefing', '11:00 AM - 1:00 PM'),
('working', '2:00 PM - 4:00 PM');


INSERT INTO Employee_Management_System (Access_Level, Control,User_Name, Pass_Word) VALUES 
('Admin', 'Full control over system','q123','erty'),
('Manager', 'Control over specific departments','q321','rtye'),
('Employee', 'Limited control over personal data','q234','rtyh');


INSERT INTO Company (Company_Name, Join_Date, No_Of_Helmets, No_Of_Employees, Cloud_Storage_Renew_Date) VALUES 
('ABC Inc.', '2024-01-01', 100, 50, '2024-03-01'),
('XYZ Corp.', '2024-02-01', 150, 75, '2024-04-01'),
('123 Industries', '2024-03-01', 200, 100, '2024-05-01');


INSERT INTO Emergency_Alarm_System (Type, Location) VALUES 
('Fire Alarm', 'Building A, Floor 1'),
('Intrusion Alarm', 'Building B, Floor 2'),
('Medical Alarm', 'Building C, Floor 3');


INSERT INTO Employee (Name, Position, Authorization_Level, Telephone_No, Helmet_ID, Company_ID) VALUES 
('John Doe', 'worker', 'Employee', '123-456-7890', 1, 1),
('Jane Smith', 'Engineer', 'Employee', '987-654-3210', 2, 1),
('Alice Johnson', 'Supervisor', 'Manager', '555-555-5555', 3, 2);


INSERT INTO Helmet (Employee_ID, Location) VALUES 
(1, '1 floor'),
(2, '2 floor'),
(3, '3 floor');


INSERT INTO Time_Log (Employee_ID, Start_Time, End_Time) VALUES 
(1, '2024-02-14 08:00:00', '2024-02-14 17:00:00'),
(2, '2024-02-14 09:00:00', '2024-02-14 18:00:00'),
(3, '2024-02-14 10:00:00', '2024-02-14 19:00:00');


INSERT INTO Salary_Calculation (Employee_ID, Total_Hours, Hourly_Rate, Total_Salary) VALUES 
(1, 9, 20.00, 180.00),
(2, 9, 18.00, 162.00),
(3, 9, 22.00, 198.00);
