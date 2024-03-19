<?php
session_start();
require "database.php";

if (!isset($_SESSION["Company_ID"])) {
    $_SESSION["Company_ID"] = 0;
    $companyID = 0;
} else {
    $companyID = $_SESSION["Company_ID"];
}

if (!isset($_SESSION["Employee_ID"])) {
    $_SESSION["Employee_ID"] = 0;
    $employeeID = 0;
} else {
    $employeeID = $_SESSION["Employee_ID"];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "Received1";
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';

    if(isset($_POST['receiver'] ) && isset($_POST['from']) && isset($_POST['message-body'])){
        $receiver=$_POST['receiver'];
        $from = $_POST['from'];
        $message = $_POST['message-body'];
        echo "Received2";
        if($from == $companyID){
            $selectEmployeeSql = "SELECT * FROM employee WHERE Company_ID = $companyID AND Name ='$receiver' AND Position = 'supervisor'";
            $resultEmployee = $database_connection->query($selectEmployeeSql);
            if ($resultEmployee == false) {
                $status['message'] = "Error executing query: " . $database_connection->error;;
                echo json_encode($status);
                //echo "Error executing query: " . $database_connection->error;
                exit();
            }
            while ($rowEmployee = $resultEmployee->fetch_assoc()) {
                $receiverID = $rowEmployee['Employee_ID'];
                $insertMessageSql = "INSERT INTO messaging(Sender_Company_ID,Receiver_Employee_ID, Message_Body) VALUES ('$from', '$receiverID', '$message')";
                $resultMessage = $database_connection->query($insertMessageSql);
                if ($resultMessage == false) {
                    //$status['message'] = "Error executing query: " . $database_connection->error;;
                    //echo json_encode($status);
                    echo "Error executing query: " . $database_connection->error;
                    exit();
                }else{
                    echo "Message Sent Succefully";
                    //$status['status'] = 'success';
                    //$status['message'] = 'Message Sent Successfully';
                    //echo json_encode($status);
                    exit();
                }
            }
        }else if ($from == $employeeID){
            echo "Received";
            $selectWorkerCompanySql = "SELECT e.*, c.Company_Name FROM  employee e JOIN company c ON e.Company_ID = c.Company_ID";
            $resultWorkerCompany = $database_connection -> query($selectWorkerCompanySql);
            if($resultWorkerCompany == true){
                while($rowEmployee =$resultWorkerCompany-> fetch_assoc()){
                    $receiverID = $rowEmployee['Employee_ID'];
                    $insertMessageSql = "INSERT INTO messaging(Sender_Employee_ID,Receiver_Company_ID, Message_Body) VALUES ('$from', '$receiverID', '$message')";
                    $resultMessage = $database_connection->query($insertMessageSql);
                if ($resultMessage == false) {
                    //$status['message'] = "Error executing query: " . $database_connection->error;;
                    //echo json_encode($status);
                    echo "Error executing query: " . $database_connection->error;
                    exit();
                }else{
                    echo "Message Sent Succefully";
                    //$status['status'] = 'success';
                    //$status['message'] = 'Message Sent Successfully';
                    //echo json_encode($status);
                    exit();
                }
                }
            }

            }else{
                echo "No Company Message";
                $selectWorkerSql="SELECT * FROM employee WHERE Company_ID = $companyID AND Name ='$receiver' AND Position = 'supervisor'";
                $resultWorker = $database_connection -> query($selectWorkerSql);
                if($resultWorker === false){
                    echo "Error executing query: " . $database_connection->error;
                    exit();
                }
                while($rowEmployee =$resultWorker-> fetch_assoc()){
                    $receiverID = $rowEmployee['Employee_ID'];
                    $insertMessageSql = "INSERT INTO messaging(Sender_Employee_ID,Receiver_Employee_ID, Message_Body) VALUES ('$from', '$receiverID', '$message')";
                    $resultMessage = $database_connection->query($insertMessageSql);
                if ($resultMessage == false) {
                    $status['message'] = "Error executing query: " . $database_connection->error;;
                    echo json_encode($status);
                    //echo "Error executing query: " . $database_connection->error;
                    exit();
                }else{
                    //echo "Message Sent Succefully";
                    $status['status'] = 'success';
                    $status['message'] = 'Message Sent Successfully';
                    echo json_encode($status);
                    exit();
                }
                }
            }
        }
        
    }



?>