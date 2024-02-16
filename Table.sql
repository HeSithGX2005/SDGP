-- table for the Gas_sensor entity

CREATE TABLE Gas_Sensor (
    Sensor_ID INT AUTO_INCREMENT PRIMARY KEY,
    Gas_Type VARCHAR(255) NOT NULL,
    Detection_Range VARCHAR(255) NOT NULL
);


-- table for the Air_Quality_Sensor entity

CREATE TABLE Air_Quality_Sensor (
    Sensor_ID INT AUTO_INCREMENT PRIMARY KEY,
    Detection_Range VARCHAR(255) NOT NULL,
    Pollutant VARCHAR(255) NOT NULL
);


-- table for the Communication_Module entity

CREATE TABLE Communication_Module (
    Module_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255) NOT NULL,
    SIM_Number VARCHAR(255) NOT NULL
);


-- table for the Lighting_System entity

CREATE TABLE Lighting_System (
    Light_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255) NOT NULL,
    Brightness_Level VARCHAR(255) NOT NULL
);


-- table for the Feedback_Mechanism_System entity

CREATE TABLE Feedback_Mechanism_System (
    Feedback_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255) NOT NULL,
    Description TEXT NOT NULL
);


-- table for the Emergency_Response_System entity

CREATE TABLE Emergency_Response_System (
    Response_ID INT AUTO_INCREMENT PRIMARY KEY,
    Contact_Number VARCHAR(255) NOT NULL,
    Response_Type VARCHAR(255) NOT NULL
);



-- table for the  Hazard_Detection_System entity

CREATE TABLE Hazard_Detection_System (
    Hazard_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255) NOT NULL,
    Description VARCHAR(255) NOT NULL
);


-- table for the Health_Monitoring_System entity

CREATE TABLE Health_Monitoring_System (
    Health_Status_ID INT AUTO_INCREMENT PRIMARY KEY,
    Vital_Sign VARCHAR(255) NOT NULL,
    Alert VARCHAR(255) NOT NULL
);


-- table for the Productivity_Monitoring_System entity

CREATE TABLE Productivity_Monitoring_System (
    Monitoring_ID INT AUTO_INCREMENT PRIMARY KEY,
    Activity VARCHAR(255) NOT NULL,
    Time VARCHAR(255) NOT NULL
);


-- table for the Employee_Management_System entity

CREATE TABLE Employee_Management_System (
    Management_ID INT AUTO_INCREMENT PRIMARY KEY,
    Access_Level VARCHAR(255) NOT NULL,
    Control VARCHAR(255) NOT NULL,
    User_Name VARCHAR(255) NOT NULL,
    Pass_Word VARCHAR (255) NOT NULL
);


-- table for the Company entity

CREATE TABLE Company (
    Company_ID INT AUTO_INCREMENT PRIMARY KEY,
    Company_Name VARCHAR(255) NOT NULL,
    Join_Date DATE NOT NULL,
    No_Of_Helmets INT NOT NULL,
    No_Of_Employees INT NOT NULL,
    Cloud_Storage_Renew_Date DATE NOT NULL
);


-- table for the Emergency_Alarm_System  entity

CREATE TABLE Emergency_Alarm_System (
    Alarm_ID INT AUTO_INCREMENT PRIMARY KEY,
    Type VARCHAR(255) NOT NULL,
    Location VARCHAR(255) NOT NULL
);

-- table for the Employee entity

CREATE TABLE Employee (
    Employee_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Position VARCHAR(255) NOT NULL,
    Authorization_Level VARCHAR(255) NOT NULL,
    Telephone_No VARCHAR(20),
    Helmet_ID INT NOT NULL,
    Company_ID INT NOT NULL,
    FOREIGN KEY (Company_ID) REFERENCES Company(Company_ID)
);

-- table for the Helmet entity

CREATE TABLE Helmet (
    Helmet_ID INT AUTO_INCREMENT PRIMARY KEY,
    Employee_ID INT NOT NULL,
    Location VARCHAR(255) NOT NULL,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


-- table for the ime_Log entity

CREATE TABLE Time_Log (
    Log_ID INT AUTO_INCREMENT PRIMARY KEY,
    Employee_ID INT NOT NULL,
    Start_Time DATETIME,
    End_Time DATETIME,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


-- table for the Salary_Calculation entity

CREATE TABLE Salary_Calculation (
    Calculation_ID INT AUTO_INCREMENT PRIMARY KEY,
    Employee_ID INT NOT NULL,
    Total_Hours INT NOT NULL,
    Hourly_Rate DOUBLE NOT NULL,
    Total_Salary DOUBLE,
    FOREIGN KEY (Employee_ID) REFERENCES Employee(Employee_ID)
);


