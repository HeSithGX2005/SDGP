--  Retrieve all employees along with their positions and telephone numbers:
SELECT Employee_Name, Position, Telephone_No
FROM Employee;


--  Retrieve the total number of helmets in each company:
SELECT c.Company_Name, SUM(c.No_Of_Helmets) AS Total_Helmets
FROM Company c
GROUP BY c.Company_Name;


--  Retrieve the details of employees who have experienced a fall detection event:
SELECT e.Employee_Name, e.Position, fde.Location, fde.Time_Stamp
FROM Employee e
JOIN Fall_Detection_Event fde ON e.Employee_ID = fde.Employee_ID;


--  Retrieve the supplier names and their corresponding material types:
SELECT m.Type AS Material_Type, s.Supplier_Name
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID;


--  Retrieve the company with the highest number of employees:
SELECT Company_ID, Company_Name, No_Of_Employees
FROM Company
WHERE No_Of_Employees = (SELECT MAX(No_Of_Employees) FROM Company);


--  Retrieve the total salary paid to employees in each company:
SELECT c.Company_Name, SUM(sc.Total_Salary) AS Total_Salary
FROM Company c
JOIN Employee e ON c.Company_ID = e.Company_ID
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY c.Company_Name;


--  Retrieve the materials supplied by each supplier along with their quantities:
SELECT s.Supplier_Name, m.Type, m.Quantity
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID;


--  Retrieve the total number of fall detection events per employee:
SELECT e.Employee_Name, COUNT(fde.Fall_Detection_Event_ID) AS Total_Fall_Events
FROM Employee e
LEFT JOIN Fall_Detection_Event fde ON e.Employee_ID = fde.Employee_ID
GROUP BY e.Employee_Name;

--  Retrieve the average salary paid to employees in each position:
SELECT e.Position, AVG(sc.Total_Salary) AS Average_Salary
FROM Employee e
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY e.Position;


--  Retrieve the top 3 suppliers with the highest quantity of materials supplied:
SELECT s.Supplier_Name, SUM(m.Quantity) AS Total_Quantity
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID
GROUP BY s.Supplier_Name
ORDER BY Total_Quantity DESC
LIMIT 3;


--  Retrieve the fall detection events that occurred after 2023-03-01:
SELECT *
FROM Fall_Detection_Event
WHERE Time_Stamp > '2023-03-01';


--  Retrieve the top 3 employees with the highest total salary:
SELECT e.Employee_Name, SUM(sc.Total_Salary) AS Total_Salary
FROM Employee e
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY e.Employee_Name
ORDER BY Total_Salary DESC
LIMIT 3;

--  Retrieve the average total salary paid per company:
SELECT c.Company_Name, AVG(sc.Total_Salary) AS Average_Total_Salary
FROM Company c
JOIN Employee e ON c.Company_ID = e.Company_ID
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY c.Company_Name;


--  Retrieve the details of employees who have changed their position:
SELECT e.Employee_Name, e.Position, e_new.Position AS New_Position
FROM Employee e
JOIN Employee e_new ON e.Employee_ID = e_new.Employee_ID
WHERE e.Position <> e_new.Position;


--  Retrieve the average quantity of materials supplied by each supplier:
SELECT s.Supplier_Name, AVG(m.Quantity) AS Average_Quantity_Supplied
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID
GROUP BY s.Supplier_Name;


--  Retrieve the details of employees who have never set an emergency alarm:
SELECT e.Employee_Name
FROM Employee e
LEFT JOIN Emergency_Alarm_System eas ON e.Employee_ID = eas.Employee_ID
WHERE eas.Alarm_ID IS NULL;


--  Retrieve the details of employees who have not changed their positions:
SELECT e.Employee_Name, e.Position
FROM Employee e
LEFT JOIN (
    SELECT DISTINCT e.Employee_ID, e.Position
    FROM Employee e
    JOIN Employee e_new ON e.Employee_ID = e_new.Employee_ID
    WHERE e.Position <> e_new.Position
) AS e_changed ON e.Employee_ID = e_changed.Employee_ID
WHERE e_changed.Employee_ID IS NULL;

--  Retrieve the materials supplied by suppliers with the highest quantity of materials supplied:
SELECT m.Material_ID, m.Type, m.Quantity, s.Supplier_Name
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID
WHERE m.Quantity = (SELECT MAX(Quantity) FROM Materials);


SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason = 'Vacation';

SELECT Reason, COUNT(*) AS Total_Leaves
FROM `Leave`
GROUP BY Reason;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE DATEDIFF(l.End_Date, l.Start_Date) > 10;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE YEAR(l.Start_Date) = YEAR(CURDATE());

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason LIKE '%medical%';

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason = 'Personal Leave' AND l.End_Date > CURDATE();


SELECT MONTH(Start_Date) AS Month, COUNT(*) AS Total_Leaves
FROM `Leave`
GROUP BY MONTH(Start_Date);

SELECT e.Employee_Name, COUNT(*) AS Total_Leaves
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
GROUP BY e.Employee_Name
HAVING COUNT(*) > 1;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE MONTH(l.Start_Date) = 12;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE DATEDIFF(l.End_Date, l.Start_Date) BETWEEN 5 AND 10;

SELECT e.Employee_Name, COUNT(DISTINCT l.Reason) AS Total_Reasons
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
GROUP BY e.Employee_Name
HAVING COUNT(DISTINCT l.Reason) > 1;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
ORDER BY DATEDIFF(l.End_Date, l.Start_Date) DESC
LIMIT 1;

SELECT Reason, AVG(DATEDIFF(End_Date, Start_Date)) AS Average_Duration
FROM `Leave`
GROUP BY Reason;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE YEAR(Start_Date) = YEAR(CURDATE()) AND YEAR(End_Date) = YEAR(CURDATE())
AND MONTH(Start_Date) = MONTH(CURDATE()) OR MONTH(End_Date) = MONTH(CURDATE());

SELECT e.Employee_Name, l1.Start_Date AS Leave_Start_Date_1, l1.End_Date AS Leave_End_Date_1,
       l2.Start_Date AS Leave_Start_Date_2, l2.End_Date AS Leave_End_Date_2
FROM Employee e
JOIN `Leave` l1 ON e.Employee_ID = l1.Employee_ID
JOIN `Leave` l2 ON e.Employee_ID = l2.Employee_ID
WHERE DATEDIFF(l2.Start_Date, l1.End_Date) = 1;



SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE DAYOFWEEK(l.Start_Date) IN (1, 7) OR DAYOFWEEK(l.End_Date) IN (1, 7);

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
ORDER BY DATEDIFF(l.End_Date, l.Start_Date) ASC
LIMIT 1;

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE DAYOFWEEK(l.Start_Date) BETWEEN 2 AND 6 OR DAYOFWEEK(l.End_Date) BETWEEN 2 AND 6;


SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason = 'Personal Leave' AND DATEDIFF(l.End_Date, l.Start_Date) <= 3;


SELECT fde.Location, COUNT(*) AS Total_Fall_Events
FROM Fall_Detection_Event fde
GROUP BY fde.Location;


SELECT c.Company_Name
FROM Company c
WHERE c.No_Of_Employees > 50 AND c.No_Of_Helmets < 100;

SELECT e.Employee_Name
FROM Employee e
JOIN Company c ON e.Company_ID = c.Company_ID
WHERE c.Join_Date < '2020-01-01';

SELECT e.Employee_Name, SUM(sc.Total_Salary) AS Total_Salary
FROM Employee e
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY e.Employee_Name
ORDER BY Total_Salary DESC
LIMIT 5;

SELECT c.Company_Name
FROM Company c
WHERE MONTH(c.Cloud_Storage_Renew_Date) = MONTH(CURRENT_DATE) + 1;

SELECT m.Type, s.Supplier_Name
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID
WHERE s.Phone_Number LIKE '%555%';

SELECT e.Employee_Name, l.Reason, l.Start_Date, l.End_Date
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason LIKE '%medical%' AND DATEDIFF(l.End_Date, l.Start_Date) <= 5;


SELECT c.Company_Name, c.No_Of_Helmets / c.No_Of_Employees AS Helmets_Per_Employee
FROM Company c
ORDER BY Helmets_Per_Employee DESC;

SELECT e.Employee_Name
FROM Employee e
JOIN Fall_Detection_Event fde ON e.Employee_ID = fde.Employee_ID
WHERE fde.Location = 'Construction Site A';

SELECT DISTINCT c.Company_Name
FROM Company c
JOIN Employee e ON c.Company_ID = e.Company_ID
WHERE e.Authorization_Level >= 2;

SELECT m.Type, AVG(m.Quantity) AS Avg_Quantity_Supplied
FROM Materials m
JOIN Supplier s ON m.Supplier_ID = s.Supplier_ID
GROUP BY m.Type
ORDER BY Avg_Quantity_Supplied DESC;

SELECT e.Employee_Name
FROM Employee e
JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE l.Reason = 'Personal' 
GROUP BY e.Employee_Name
HAVING COUNT(*) > 1;

SELECT e.Employee_Name
FROM Employee e
JOIN (
    SELECT Employee_ID
    FROM Employee
    GROUP BY Employee_ID
    HAVING COUNT(DISTINCT Position) > 1
) AS changed_positions ON e.Employee_ID = changed_positions.Employee_ID;


SELECT ba.Account_Number, ba.Bank, ba.Branch, e.Employee_Name AS Employee_Name, e.Position AS Employee_Position
FROM Bank_Account ba
JOIN Employee e ON ba.Employee_ID = e.Employee_ID;


SELECT e.Employee_Name AS Employee_Name, e.Position AS Employee_Position, ba.Account_Number, ba.Bank, ba.Branch
FROM Bank_Account ba
JOIN Employee e ON ba.Employee_ID = e.Employee_ID
WHERE ba.Bank = 'Sampath Bank';


SELECT Bank, COUNT(*) AS Total_Bank_Accounts
FROM Bank_Account
GROUP BY Bank;

SELECT e.Employee_Name AS Employee_Name, e.Position AS Employee_Position
FROM Employee e
LEFT JOIN Bank_Account ba ON e.Employee_ID = ba.Employee_ID
WHERE ba.Employee_ID IS NULL;


SELECT e.Employee_ID, e.Employee_Name, COUNT(eas.Alarm_ID) AS Num_Emergency_Alarms
FROM Employee e
LEFT JOIN Emergency_Alarm_System eas ON e.Employee_ID = eas.Employee_ID
GROUP BY e.Employee_ID, e.Employee_Name;

SELECT e.Employee_ID, e.Employee_Name, SUM(TIMESTAMPDIFF(HOUR, h.Start_Time, h.End_Time)) AS Total_Hours_Worked
FROM Employee e
JOIN Helmet h ON e.Helmet_ID = h.Helmet_ID
GROUP BY e.Employee_ID, e.Employee_Name;

SELECT e.*
FROM Employee e
INNER JOIN `Leave` l ON e.Employee_ID = l.Employee_ID
WHERE (l.Start_Date <= '2024-01-15' AND l.End_Date >= '2024-01-10');

SELECT c.Company_ID, c.Company_Name, SUM(sc.Total_Salary) AS Total_Salary_Expenses
FROM Company c
JOIN Employee e ON c.Company_ID = e.Company_ID
JOIN Salary_Calculation sc ON e.Employee_ID = sc.Employee_ID
GROUP BY c.Company_ID, c.Company_Name;

SELECT e.*
FROM Employee e
LEFT JOIN Emergency_Alarm_System eas ON e.Employee_ID = eas.Employee_ID
WHERE eas.Alarm_ID IS NULL;

SELECT e.Employee_ID, e.Employee_Name, b.Account_Number, b.Bank, b.Branch
FROM Employee e
JOIN Bank_Account b ON e.Employee_ID = b.Employee_ID;

SELECT e.Employee_ID, e.Employee_Name, h.Vital_Sign, h.Heart_Rate
FROM Employee e
JOIN Health_Monitoring_System h ON e.Helmet_ID = h.Helmet_ID
WHERE h.Heart_Rate > 90;

SELECT e.Employee_ID, e.Employee_Name, mr.Material_ID, mr.Receiving_Date
FROM Employee e
LEFT JOIN Material_Request mr ON e.Employee_ID = mr.Request_ID;

SELECT e.Employee_ID, e.Employee_Name, COUNT(eas.Alarm_ID) AS Num_Emergency_Alarms
FROM Employee e
LEFT JOIN Emergency_Alarm_System eas ON e.Employee_ID = eas.Employee_ID
GROUP BY e.Employee_ID, e.Employee_Name;

SELECT e.*
FROM Employee e
JOIN (
    SELECT Employee_ID
    FROM Emergency_Alarm_System
    GROUP BY Employee_ID
    HAVING COUNT(*) > 1
) AS multiple_alarms ON e.Employee_ID = multiple_alarms.Employee_ID;






