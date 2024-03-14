<?php
session_start();
require "database.php";
require "Other-Script/random-string-generating.php";
require "Other-Script/email-sender.php";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $status = array();
    $status['status'] = 'error';
    $status['message'] = '';
    if(isset($_POST["name"]) && isset($_POST["position"]) && isset($_POST["telephone"]) && isset($_FILES["employeePic"])) {
        $employeeName = $_POST["name"];
        $companyID = $_SESSION["Company_ID"];
        $position = $_POST["position"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
    
        $targetDir = "uploads/";
        if(!empty($_FILES["employeePic"]["name"])) {
            // Get file info
            $fileName = basename($_FILES["employeePic"]["name"]);
            $employeeFileName = str_replace(" ","_",$employeeName) .'_' . $fileName;
            $targetFilePath  = $targetDir . $employeeFileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if(in_array($fileType, $allowTypes)){
                if(move_uploaded_file($_FILES["employeePic"]["tmp_name"],$targetFilePath)){
                    if ($position == 'supervisor' || $position == 'managment') {
                        // Generate random username and password
                        $username = generateRandomString(8);
                        $password = generateRandomString(10);
                        $encryptPassword = password_hash($password,PASSWORD_DEFAULT);
                        $insert = $database_connection->query("INSERT INTO employee (Name, Position, Telephone_No, Company_ID, Employee_Pic,Username,Password_Hash,Email_Address)
                                                         VALUES ('$employeeName', '$position', '$telephone', '$companyID', '$targetFilePath','$username','$encryptPassword','$email')");
                    } else {
                        $username = '';
                        $password = '';
                        $insert = $database_connection->query("INSERT INTO employee (Name, Position, Telephone_No, Company_ID, Employee_Pic,Username,Password_Hash,Email_Address)
                                                         VALUES ('$employeeName', '$position', '$telephone', '$companyID', '$targetFilePath','$username','$password','$email')");
                    }
                    if($insert){
                    if($position == 'supervisor'|| $position == 'managment'){
                        employeeEmailSender($email,$employeeName,$username,$password);
                    } 
                    $status['status'] = 'success';
                    $status['message'] = "Employee Registered Succefully";
                    echo json_encode($status);
                    
                } else{
                    $status['message'] = "Failed to insert new data: " . $database_connection->error;
                    echo json_encode($status);
                }
                }else{
                    $status['message'] = "Sorry, there was an error uploading your file.";
                    echo json_encode($status);

                }
            } else{
                $status['message'] = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                echo json_encode($status);
            }
        } else{
            $statusMsg = 'Please select an image file to upload.';
            $status['message'] = 'Please select an image file to upload.';
            echo json_encode($status);

        }
    }

} 

?>