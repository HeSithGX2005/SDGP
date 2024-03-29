<?php
require_once ('database.php');

if(isset($_POST['employeeID']) && !empty($_POST['employeeID'])) {
    $employeeID = mysqli_real_escape_string($database_connection, $_POST['employeeID']);
    $query = "DELETE FROM employee WHERE Employee_ID = '$employeeID'";
    $result = mysqli_query($database_connection, $query);

    if($result) {
        $response['status'] = 'success';
        $response['message'] = 'Employee deleted successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($database_connection);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}
echo json_encode($response);



if (!empty($_POST['Company_ID'])) {
    $companyID = $_POST['Company_ID'];
    
    // Include database connection code here
    
    $query = "DELETE FROM company WHERE Company_ID = '$companyID'";
    $result = mysqli_query($database_connection, $query);

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'Company deleted successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . mysqli_error($database_connection);
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);


?>