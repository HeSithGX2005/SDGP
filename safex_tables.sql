CREATE TABLE Company (
    Company_ID INT AUTO_INCREMENT PRIMARY KEY,
    Company_Name VARCHAR(255),
    Join_Date DATETIME,
    No_Of_Helmets INT,
    No_Of_Employees INT,
    Cloud_Storage_Renew_Date DATETIME
);


CREATE TABLE Helmet (
    Helmet_ID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255),
    Start_Time DATETIME,
    End_Time DATETIME,
    Total_Hours INT,
    Helmet_Unique_Code VARCHAR(255) UNIQUE,
    Company_ID INT,
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);


CREATE TABLE Employee (
    Employee_ID INT AUTO_INCREMENT PRIMARY KEY,
    Employee_Name VARCHAR(255),
    Hourly_Rate DECIMAL(10,2),
    Position VARCHAR(255),
    Email VARCHAR(255),
    Telephone_No VARCHAR(20),
    Join_Date DATETIME,
    Photo TEXT,
    Helmet_ID INT,
    Company_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID),
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);


CREATE TABLE Salary_Calculation (
    Calculation_ID INT AUTO_INCREMENT PRIMARY KEY,
    Total_Salary DECIMAL(10,2),
    Employee_ID INT,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


CREATE TABLE Emergency_Alarm_System (
    Alarm_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255),
    Location VARCHAR(255),
    Helmet_ID INT,
    Employee_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID),
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


CREATE TABLE Fall_Detection_Event (
    Fall_Detection_Event_ID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255),
    Time_Stamp DATETIME,
    Date DATE,
    Helmet_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID)
);


CREATE TABLE Gas_Detection_Event (
    Gas_Detection_Event_ID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255),
    Timestamp DATETIME,
    Date DATE,
    Helmet_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID)
);


CREATE TABLE Construction_Site (
    Site_ID INT AUTO_INCREMENT PRIMARY KEY,
    Location VARCHAR(255),
    Company_ID INT,
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);


CREATE TABLE Materials (
    Material_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255),
    Quantity INT
);


CREATE TABLE `Leave` (
    Leaving_ID INT AUTO_INCREMENT PRIMARY KEY,
    Reason VARCHAR(255),
    Start_Date DATE,
    End_Date DATE,
    Employee_ID INT,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


CREATE TABLE Health_Monitoring_System (
    Health_status_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vital_Sign VARCHAR(255),
    Heart_Rate INT,
    Helmet_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID)
);


CREATE TABLE Bank_Account (
    Account_Number INT PRIMARY KEY,
    Bank VARCHAR(255),
    Branch VARCHAR(255),
    Employee_ID INT,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


CREATE TABLE Login (
    Login_ID INT AUTO_INCREMENT PRIMARY KEY,
    Access_Level TEXT,
    Username VARCHAR(255),
    Password VARCHAR(255),
    Company_ID INT,
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);


CREATE TABLE Material_Request (
    Request_ID INT AUTO_INCREMENT PRIMARY KEY,
    Quantity_Requested INT,
    Receiving_Date DATE,
    Supervisor_Name VARCHAR(255),
    Material_ID INT,
    Company_ID INT,
    FOREIGN KEY (Material_ID) REFERENCES Materials(Material_ID),
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);


CREATE TABLE Alert_History (
    Alert_ID INT AUTO_INCREMENT PRIMARY KEY,
    Alert_Type VARCHAR(255),
    Date DATE,
    Time TIME,
    Employee_Name VARCHAR(255),
    Helmet_ID INT,
    Employee_ID INT,
    FOREIGN KEY (Helmet_ID) REFERENCES Helmet(Helmet_ID),
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


CREATE TABLE Projects (
    Project_ID INT AUTO_INCREMENT PRIMARY KEY,
    Project_Name VARCHAR(255),
    Start_Date DATE,
    estimatedDurationDays INT,
    Company_ID INT,
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);
