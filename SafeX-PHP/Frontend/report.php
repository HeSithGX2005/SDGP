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
    <title>SafeX|Report</title>
    <style>
        #report{
            color: black;
        }
    </style>
</head>
<body>
<div class="content text-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <h1 id="report">Report Issue</h1>
                <div class="card">
                    <div class="card-body">
                        <form action="../Backend/report.php" method="post" id="report-form">
                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Name" name="id" value="<?php
                                    if(isset($_SESSION["Employee_ID"])) {
                                        $employeeID = $_SESSION["Employee_ID"];
                                        echo $employeeID;
                                    } elseif(isset($_SESSION["Company_ID"])) {
                                        $companyID = $_SESSION["Company_ID"];
                                        echo $companyID;
                                    }
                                ?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="message" placeholder="Issue" name="text" style="resize: none;"></textarea>
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" value="Send" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



        <script src="js/notification-panel.js"></script>
        <script>
        handleFormSubmit("report-form");
    </script>
    </body>
</html>
