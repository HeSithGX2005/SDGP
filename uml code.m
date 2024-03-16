@startuml

entity Company {
    + Company_ID : INT [PK]
    - Company_Name : VARCHAR(255)
    - Join_Date : DATETIME
    - No_Of_Helmets : INT
    - No_Of_Employees : INT
    - Cloud_Storage_Renew_Date : DATETIME
}

entity Helmet {
    + Helmet_ID : INT [PK]
    - Location : VARCHAR(255)
    - Start_Time : DATETIME
    - End_Time : DATETIME
    - Total_Hours : INT
    - Helmet_Unique_Code : VARCHAR(255) [UNIQUE]
    - Company_ID : INT [FK]
}

entity Employee {
    + Employee_ID : INT [PK]
    - Employee_Name : VARCHAR(255)
    - Hourly_Rate : DECIMAL(10,2)
    - Position : VARCHAR(255)
    - Email : VARCHAR(255)
    - Telephone_No : VARCHAR(20)
    - Join_Date : DATETIME
    - Photo : TEXT
    - Helmet_ID : INT [FK]
    - Company_ID : INT [FK]
}

entity Salary_Calculation {
    + Calculation_ID : INT [PK]
    - Total_Salary : DECIMAL(10,2)
    - Employee_ID : INT [FK]
}

entity Emergency_Alarm_System {
    + Alarm_ID : INT [PK]
    - Type : VARCHAR(255)
    - Location : VARCHAR(255)
    - Helmet_ID : INT [FK]
    - Employee_ID : INT [FK]
}

entity Fall_Detection_Event {
    + Fall_Detection_Event_ID : INT [PK]
    - Location : VARCHAR(255)
    - Time_Stamp : DATETIME
    - Date : DATE
    - Helmet_ID : INT [FK]
}

entity Gas_Detection_Event {
    + Gas_Detection_Event_ID : INT [PK]
    - Location : VARCHAR(255)
    - Timestamp : DATETIME
    - Date : DATE
    - Helmet_ID : INT [FK]
}

entity Construction_Site {
    + Site_ID : INT [PK]
    - Location : VARCHAR(255)
    - Company_ID : INT [FK]
}

entity Materials {
    + Material_ID : INT [PK]
    - Type : VARCHAR(255)
    - Quantity : INT
}

entity Leave {
    + Leaving_ID : INT [PK]
    - Reason : VARCHAR(255)
    - Start_Date : DATE
    - End_Date : DATE
    - Employee_ID : INT [FK]
}

entity Health_Monitoring_System {
    + Health_status_ID : INT [PK]
    - Vital_Sign : VARCHAR(255)
    - Heart_Rate : INT
    - Helmet_ID : INT [FK]
}

entity Bank_Account {
    + Account_Number : INT [PK]
    - Bank : VARCHAR(255)
    - Branch : VARCHAR(255)
    - Employee_ID : INT [FK]
}

entity Login {
    + Login_ID : INT [PK]
    - Access_Level : INT
    - Username : VARCHAR(255)
    - Password : VARCHAR(255)
    - Company_ID : INT [FK]
}

entity Material_Request {
    + Request_ID : INT [PK]
    - Quantity_Requested : INT
    - Receiving_Date : DATE
    - Supervisor_Name : VARCHAR(255)
    - Material_ID : INT [FK]
    - Company_ID : INT [FK]
}

entity Alert_History {
    + Alert_ID : INT [PK]
    - Alert_Type : VARCHAR(255)
    - Date : DATE
    - Time : TIME
    - Employee_Name : VARCHAR(255)
    - Helmet_ID : INT [FK]
    - Employee_ID : INT [FK]
}

entity Projects {
    + Project_ID : INT [PK]
    - Project_Name : VARCHAR(255)
    - Start_Date : DATE
    - estimatedDurationDays : INT
    - Company_ID : INT [FK]
}

Company ||--o{ Helmet
Company ||--o{ Employee
Employee ||--o{ Salary_Calculation
Helmet ||--o{ Emergency_Alarm_System
Helmet ||--o{ Fall_Detection_Event
Helmet ||--o{ Gas_Detection_Event
Company ||--o{ Construction_Site
Material ||--o{ Material_Request
Employee ||--o{ Leave
Helmet ||--o{ Health_Monitoring_System
Employee ||--o{ Bank_Account
Company ||--o{ Login
Employee ||--o{ Alert_History
Company ||--o{ Projects

@enduml
