<?php 
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeX|Message</title>
</head>
<body>
<div class="content text-center mt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="../Backend/message.php" id="message-form">
                                    <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="To" name="receiver">
                                    </div>
                                    <div class="col">
                                        <input type="hidden" class="form-control"  name="from" value="<?php if(isset($_SESSION["Company_ID"])){
                                            $companyID = $_SESSION["Company_ID"];echo $companyID;
                                        }elseif(isset( $_SESSION["Employee_ID"] )){$employeeID = $_SESSION["Employee_ID"] ;echo $employeeID;}
                                        ?>">
                                    </div>
                                    </div><br>
                                    <div class="row">
                                        <textarea class="form-control" rows="5" id="message" placeholder="Message" name="message-body" required></textarea>
                                    </div>
                                    <div class="row">
                                        <input type="submit" class="btn btn-primary" value="Sent">
                                    </div>
                                </form><br>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
       <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("message-form");
    </script>
</body>
</html>