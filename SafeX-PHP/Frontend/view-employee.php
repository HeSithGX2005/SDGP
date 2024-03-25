<?php
require("../Backend/database.php");
include_once("css/css-links.php");
require_once("../Frontend/sidepanel.php");


if(isset($_GET['id'])) {
    $employeeID = $_GET['id'];
    
    // Fetch the details of the selected employee based on the Employee_ID
    $selectEmployeeSQL = "SELECT * FROM employee WHERE Employee_ID = $employeeID";
    $result = $database_connection->query($selectEmployeeSQL);
    
    // Check if employee details are found
    if ($result && $result->num_rows > 0) {
        $employee = $result->fetch_assoc();
?>

<!doctype html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Employee Details</title>
        <style>
            body {
                background-color: #fff !important;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                min-height: 100vh;
                overflow: hidden;
}

            .img-fluid {
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                border: 1px solid #ccc;
                width: 100%;
                height: auto;
            }

            .img-fluid:hover {
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
        }

            .card-body {
            text-align: left;
            }

        .card{
            margin-top: 25px;
        background-color: #ffffff;
        border-width: 0;
        border-radius: 30px !important;
        padding: 25px;
        align-items:center;
        margin: 10px;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 18px 36px -18px ;
        transition:all 0.5s ease;
        border: 1px solid #ebecf0;
        text-align: center;
        overflow: hidden;

        }

        .card:hover{
        transform: scale(101%);
        background: #ffffff;
        box-shadow: rgba(8, 161, 164, 0.35) 0px 5px 15px !important;
        }

        h5{
        font-family: "Philosopher", sans-serif;
        font-weight: 400;
        font-style: normal;
        text-align: center;
        }

        </style>
        
        
    </head>

    <body>
       <!-- Your HTML content -->
       <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h5 class="text-center">Employee Details</h5>
                <div class="card">
                    <div class="card-body">
                    <img src="<?php echo '../Backend/'.$employee['Employee_Pic'];?>" alt="<?php echo $employee['Name'];?>" width="100" class="img-fluid rounded-start border">
                        <p>Employee ID: <?php echo $employee['Employee_ID']; ?></p>
                        <p>Name: <?php echo $employee['Name']; ?></p>
                        <p class="card-text text-start">Helmet Id: <?php echo $employee['Helmet_ID'];?></p>
                        <p class="card-text text-start">Position: <?php echo $employee['Position'];?></p>
                        <p class="card-text text-start">Contact No: <?php echo $employee['Telephone_No'];?></p>
                        <p class="card-text text-start">Email: <?php echo $employee['Email_Address'];?></p>
                        <p class="card-text text-start">Health Status: <?php echo $employee['Name'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap and other scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<?php
    } else {
        header('Location:employee.php');
    }
} else {
    header('Location:employee.php');
}?>
        
    <!--bootstrap 5 javascript links-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>