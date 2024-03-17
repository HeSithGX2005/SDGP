<?php
session_start();
require "database.php";
$companyID = $_SESSION["Company_ID"];
$siteId = $_POST['siteId'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST['operation'])) {
        $assignment_type = $_POST['operation'];
        if ($assignment_type =='Automatic') {
            automaticAssignment($companyID,$database_connection,$siteId);
            /*$status['status'] = 'success';
            $status['message'] = 'Auto Assignment Successful';
            echo json_encode($status);*/
            echo "Succesfully Added";
            exit();
        } elseif ($assignment_type == 'Manual') {
            manualAssignment();
            //$status['status'] = 'success';
            //$status['message'] = 'Manual Assignment Successful';
            //echo json_encode($status);
            echo "Succesfully Adde42";
            exit();
        } else {
            /*$status['message'] = 'Invalid assignment type selected';
            echo json_encode($status);*/
            echo "Invalid assignment type selected1"; 
        }
    } else {
       /* $status['message'] = 'Please select an assignment type';
        echo json_encode($status);*/
        echo "Invalid assignment type selected23"; 
    }
}

// Function for automatic assignment
function automaticAssignment($companyID,$database_connection,$siteId) {
    if(isset($_POST['NumofWorker']) && isset($_POST['NumofSupervisior'])){
        $workers = $_POST['NumofWorker'];
        $supervisors = $_POST['NumofSupervisior'];
        $selectWorkersSql = "SELECT * FROM employee WHERE assinged = 0 AND position = 'worker' AND Company_ID = '$companyID' LIMIT '$workers'";
        $resultWorkers = $database_connection->query($selectWorkersSql);
        $selectSupervisiorSql = "SELECT * FROM employee WHERE assinged = 0 AND position = 'supervisior' AND Company_ID = '$companyID' LIMIT '$supervisors'";
        $resultSupervisiors = $database_connection->query($selectSupervisiorSql);

        while ($rowWorker = $resultWorkers->fetch_assoc()) {
            $workerId = $rowWorker['Employee_ID'];
            $insertWorkerSql = "INSERT INTO  site_assigend_wokers (employee_id, company_id,site_id) VALUES ('$workerId', '$companyID','$siteId')";
            $database_connection->query($insertWorkerSql);
        }
        while ($rowSupervisor = $resultSupervisiors->fetch_assoc()) {
            $supervisorId = $rowSupervisor['Employee_ID'];
            $insertSupervisorSql = "INSERT INTO site_assigend_wokers (employee_id,company_id,site_id) VALUES ('$supervisorId', '$companyID','$siteId')";
            $database_connection->query($insertSupervisorSql);
        }
    }
}

// Function for manual assignment
function manualAssignment() {
    // Implement your manual assignment algorithm here
    echo "Manual assignment algorithm is executed";
}
?>
