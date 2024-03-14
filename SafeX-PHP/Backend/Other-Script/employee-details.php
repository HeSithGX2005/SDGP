<?php
function fetchAllEmployeeetails($database_connection){
    $companyID = $_SESSION["Company_ID"];
    $getEmployeesSQL = "SELECT * FROM employee WHERE Company_ID = '$companyID'";
    $getEmployeesQuery = mysqli_query($database_connection, $getEmployeesSQL);
    if(mysqli_num_rows($getEmployeesQuery) > 0) {
        $employees = array();
        while($row= mysqli_fetch_assoc($getEmployeesQuery)) {
                $employees[]  = $row;
        }
    } else {
        $employees = array();
        echo "No Employee Found";
    }
    return $employees;
 }

function fetchSearchEmployeeDetails($searchEmployee,$database_connection){
    $companyID = $_SESSION["Company_ID"];
    $getSearchEmployeeSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Name = '$searchEmployee' ";
    $getSeachEmployeeQuery = mysqli_query($database_connection,$getSearchEmployeeSql);
    if(mysqli_num_rows($getSeachEmployeeQuery) > 0) {
        $employees = array();
        while($row= mysqli_fetch_assoc($getSeachEmployeeQuery)) {
                $employees[]  = $row;
        }
    } else {
        $employees = array();
        echo "No Employee Found";
    }
    return $employees;
}

 
?>