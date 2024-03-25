-- Sample data for Company table
INSERT INTO Company (Company_Name, Join_Date, No_Of_Helmets, No_Of_Employees, Cloud_Storage_Renew_Date) VALUES
('ABC Construction', '2023-01-01', 50, 100, '2024-01-01'),
('XYZ Builders', '2023-02-15', 30, 75, '2024-02-15'),
('LMN Constructors', '2023-03-20', 40, 80, '2024-03-20'),
('PQR Developers', '2023-04-10', 25, 60, '2024-04-10'),
('EFG Engineering', '2023-05-05', 35, 70, '2024-05-05');


-- Sample data for Helmet table
INSERT INTO Helmet (Location, Start_Time, End_Time, Total_Hours, Helmet_Unique_Code, Company_ID) VALUES
('Site A', '2023-01-01 08:00:00', '2023-01-01 16:00:00', 8, 'H001', 1),
('Site B', '2023-02-15 09:00:00', '2023-02-15 17:00:00', 8, 'H002', 2),
('Site C', '2023-03-20 07:30:00', '2023-03-20 15:30:00', 8, 'H003', 3),
('Site D', '2023-04-10 08:30:00', '2023-04-10 16:30:00', 8, 'H004', 4),
('Site E', '2023-05-05 07:00:00', '2023-05-05 15:00:00', 8, 'H005', 5);


-- Sample data for Employee table
INSERT INTO Employee (Employee_Name, Hourly_Rate, Position, Email, Telephone_No, Join_Date, Photo, Helmet_ID, Company_ID) VALUES
('Saman Perera', 15.00, 'Foreman', 'saman@example.com', '0712345678', '2023-01-01', 'saman_photo.jpg', 1, 1),
('Nimal Silva', 12.50, 'Laborer', 'nimal@example.com', '0776543210', '2023-02-15', 'nimal_photo.jpg', 2, 2),
('Kamal Fernando', 14.00, 'Engineer', 'kamal@example.com', '0765432109', '2023-03-20', 'kamal_photo.jpg', 3, 3),
('Sunil Rathnayake', 13.00, 'Carpenter', 'sunil@example.com', '0754321098', '2023-04-10', 'sunil_photo.jpg', 4, 4),
('Anil Bandara', 11.50, 'Welder', 'anil@example.com', '0723456789', '2023-05-05', 'anil_photo.jpg', 5, 5);


-- Sample data for Salary_Calculation table
INSERT INTO Salary_Calculation (Total_Salary, Employee_ID) VALUES
(1200.00, 1),
(1000.00, 2),
(1120.00, 3),
(1040.00, 4),
(920.00, 5);


-- Sample data for Emergency_Alarm_System table
INSERT INTO Emergency_Alarm_System (Type, Location, Helmet_ID, Employee_ID) VALUES
('Fire', 'Site A', 1, 1),
('Gas Leak', 'Site B', 2, 2),
('Fall', 'Site C', 3, 3),
('Injury', 'Site D', 4, 4),
('Accident', 'Site E', 5, 5);


-- Sample data for Fall_Detection_Event table
INSERT INTO Fall_Detection_Event (Location, Time_Stamp, Date, Helmet_ID) VALUES
('Site A', '2023-01-01 10:30:00', '2023-01-01', 1),
('Site B', '2023-02-15 12:45:00', '2023-02-15', 2),
('Site C', '2023-03-20 11:15:00', '2023-03-20', 3),
('Site D', '2023-04-10 09:20:00', '2023-04-10', 4),
('Site E', '2023-05-05 10:00:00', '2023-05-05', 5);


-- Sample data for Gas_Detection_Event table
INSERT INTO Gas_Detection_Event (Location, Timestamp, Date, Helmet_ID) VALUES
('Site A', '2023-01-01 14:00:00', '2023-01-01', 1),
('Site B', '2023-02-15 16:30:00', '2023-02-15', 2),
('Site C', '2023-03-20 13:45:00', '2023-03-20', 3),
('Site D', '2023-04-10 15:10:00', '2023-04-10', 4),
('Site E', '2023-05-05 14:20:00', '2023-05-05', 5);


-- Sample data for Construction_Site table
INSERT INTO Construction_Site (Location, Company_ID) VALUES
('Site A', 1),
('Site B', 2),
('Site C', 3),
('Site D', 4),
('Site E', 5);


-- Sample data for Materials table
INSERT INTO Materials (Type, Quantity) VALUES
('Concrete', 100),
('Bricks', 5000),
('Steel Bars', 200),
('Cement', 50),
('Sand', 1000);


-- Sample data for Leave table
INSERT INTO `Leave` (Reason, Start_Date, End_Date, Employee_ID) VALUES
('Vacation', '2023-01-15', '2023-01-20', 1),
('Sick Leave', '2023-02-25', '2023-02-27', 2),
('Family Emergency', '2023-03-30', '2023-04-03', 3),
('Personal Leave', '2023-04-20', '2023-04-22', 4),
('Maternity Leave', '2023-05-10', '2023-06-10', 5);


-- Sample data for Health_Monitoring_System table
INSERT INTO Health_Monitoring_System (Vital_Sign, Heart_Rate, Helmet_ID) VALUES
('Normal', 75, 1),
('High', 90, 2),
('Normal', 80, 3),
('Low', 60, 4),
('Normal', 70, 5);


-- Sample data for Bank_Account table
INSERT INTO Bank_Account (Account_Number, Bank, Branch, Employee_ID) VALUES
(123456789, 'ABC Bank', 'Main Branch', 1),
(234567890, 'XYZ Bank', 'Downtown Branch', 2),
(345678901, 'LMN Bank', 'East Branch', 3),
(456789012, 'PQR Bank', 'West Branch', 4),
(567890123, 'EFG Bank', 'North Branch', 5);


-- Sample data for Login table
INSERT INTO Login (Access_Level, Username, Password, Company_ID) VALUES
(1, 'saman123', 'password123', 1),
(2, 'nimal456', 'password456', 2),
(3, 'kamal789', 'password789', 3),
(4, 'sunil012', 'password012', 4),
(5, 'anil345', 'password345', 5);


-- Sample data for Material_Request table
INSERT INTO Material_Request (Quantity_Requested, Receiving_Date, Supervisor_Name, Material_ID, Company_ID) VALUES
(50, '2023-01-05', 'Supervisor A', 1, 1),
(1000, '2023-02-20', 'Supervisor B', 2, 2),
(20, '2023-03-25', 'Supervisor C', 3, 3),
(10, '2023-04-15', 'Supervisor D', 4, 4),
(200, '2023-05-10', 'Supervisor E', 5, 5);


-- Sample data for Alert_History table
INSERT INTO Alert_History (Alert_Type, Date, Time, Employee_Name, Helmet_ID, Employee_ID) VALUES
('Fire', '2023-01-01', '10:45:00', 'Saman Perera', 1, 1),
('Gas Leak', '2023-02-15', '13:00:00', 'Nimal Silva', 2, 2),
('Fall', '2023-03-20', '11:30:00', 'Kamal Fernando', 3, 3),
('Injury', '2023-04-10', '09:30:00', 'Sunil Rathnayake', 4, 4),
('Accident', '2023-05-05', '11:15:00', 'Anil Bandara', 5, 5);


-- Sample data for Projects table
INSERT INTO Projects (Project_Name, Start_Date, estimatedDurationDays, Company_ID) VALUES
('Building Construction', '2023-01-01', 180, 1),
('Road Infrastructure', '2023-02-15', 240, 2),
('Bridge Construction', '2023-03-20', 300, 3),
('Apartment Complex', '2023-04-10', 360, 4),
('Commercial Building', '2023-05-05', 420, 5);
