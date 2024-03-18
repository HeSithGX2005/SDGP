<?php
session_start();
require "../Backend/database.php";
$companyID = $_SESSION["Company_ID"];
$siteId = $_POST['siteId'];
$selectedOption = $_POST['selectedOption'];
$row;
if ($selectedOption === "Automatic") {
    // Query for automatic assignment
    $assigned_workers_query = "SELECT e.Name, e.Position, saw.Site_ID, saw.Employee_ID 
                                FROM site_assigend_wokers saw
                                JOIN employee e ON saw.Employee_ID = e.Employee_Id
                                WHERE saw.Site_ID = '$siteId'
                                ORDER BY e.Name";
} elseif($selectedOption === "Manual") {
    $assigned_workers_query = "SELECT  * FROM employee WHERE Company_ID = '$companyID' AND Assigned =0  ";
}

$assigned_workers_result = $database_connection->query($assigned_workers_query);


$row;
$row_number = 1;
$table_html = '';

$assigned_workers_result = mysqli_query($database_connection, $assigned_workers_query);
if ($assigned_workers_result->num_rows > 0) {
    while ($row = $assigned_workers_result->fetch_assoc()) {
        if ($selectedOption === "Automatic") {
            $button='<a href="assign-helmet.php?site_ID='.$siteId.'delete=' . $row['Employee_ID'] . '" class="btn btn-danger">Delete</a>';
        } elseif($selectedOption === "Manual") {
            $button='<a href="assign-helmet.php?site_ID='.$siteId.'update=' . $row['Employee_ID'] . '" class="btn btn-danger">Assigned Worker</a>';
        }
        echo '<tr>
        <td>' . $row_number . '</td>
        <td>' . $row['Name'] . '</td>
        <td>' .$row['Position'] . '</td>
        <td>
           '.$button.'
        </td>
        </tr>';
        $row_number++;
        }
}else{
    echo '<tr><td colspan="4">No assigned workers found for this construction site.</td></tr>';
}



?>