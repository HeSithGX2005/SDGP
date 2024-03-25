<?php
session_start();
require "database.php";
$companyID = $_SESSION["Company_ID"];
$siteId = $_POST['siteId'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if (isset($_POST['NumofWorker']) && isset($_POST['NumofSupervisor'])) {
        $workers = $_POST['NumofWorker'];
        $supervisors = $_POST['NumofSupervisor'];
        $selectWorkersSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Assigned = 0 AND Position = 'worker' LIMIT $workers";
        $resultWorkers = $database_connection->query($selectWorkersSql);
        if ($resultWorkers == false) {
            $status['message'] = "Error executing query: " . $database_connection->error;;
            echo json_encode($status);
            exit();
        }
        $selectSupervisiorSql = "SELECT * FROM employee WHERE Company_ID = '$companyID' AND Assigned = 0 AND Position = 'supervisor' LIMIT $supervisors";
        $resultSupervisiors = $database_connection->query($selectSupervisiorSql);
        if (!$database_connection->query($selectSupervisiorSql)) {
            $supervisorSuccess = false;
            $status['message'] = "Error adding worker:" . $database_connection->error ;
            echo json_encode($status);
            exit();
            
        }
        $workerSuccess = true;
        $supervisorSuccess = true;
    
        while ($rowWorker = $resultWorkers->fetch_assoc()) {
            $workerId = $rowWorker['Employee_ID'];
            $insertWorkerSql = "INSERT INTO site_assigend_wokers  (Company_ID, Employee_ID, Site_ID) VALUES ('$companyID', '$workerId', '$siteId')";
            $resultInsertWorkers = $database_connection->query($insertWorkerSql);
            if ($resultInsertWorkers == false) {
                $status['message'] = "Error executing query: " . $database_connection->error;;
                echo json_encode($status);
                exit();
            }
        }
    
        while ($rowSupervisor = $resultSupervisiors->fetch_assoc()) {
            $supervisorId = $rowSupervisor['Employee_ID'];
            $insertSupervisorSql = "INSERT INTO site_assigend_wokers  (Company_ID, Employee_ID, Site_ID) VALUES ('$companyID', '$supervisorId','$siteId')";
            if ($supervisors > 0 && !$database_connection->query($insertSupervisorSql)) {
                $supervisorSuccess = false;
                $status['message'] = "Error adding supervisor: " . $database_connection->error ;
                echo json_encode($status);
            }
        }
        if ($workerSuccess && $supervisorSuccess) {
            $status['status'] = 'success';
            $status['message'] = 'Auto Assignment Successful';
            echo json_encode($status);
            exit();
        } else {
            $status['message'] = 'Error Occured';
            echo json_encode($status);
            exit();
        }
    }
}

?>
