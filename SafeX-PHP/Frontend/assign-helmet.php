<?php
include("css/css-links.php");
require ("sidepanel.php");
require ("../Backend/database.php");

$user_role = $_SESSION["user_role"];
$company_id = $_SESSION["Company_ID"];

$siteId = $_GET['siteId'];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SafeX|Assigning Workers</title>
<script src="js/assign-helmet.js"></script>
<link rel="stylesheet" href="css/company.css">
</head>
<body>
<div class="main-container">
        <div class="upper-part col-md-6">
        <h1>Assigning Workers to Construction Site </h1>
            <form id="dynamicForm" action="../Backend/assign-helmet.php" method="post" name="assignment_type">
            <input type="hidden" name="siteId" value="<?php echo $siteId ?>">
            <div class="dynamicform">
            <h2>Select an option:</h2>
            <select id="dropdown" onchange="showFields()">
                <option value="">Select an option</option>
                <option value="Automatic">Automatic Assigning</option>
                <option value="Manual">Manual Assigning</option>
            </select>
            </div>
            </form>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Employee Name</th>
                    <th class="resizable">Position</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
     
            $row;
            $row_number = 1;
            $assigned_workers_query = "SELECT e.Name,e.Position,saw.site_id FROM  site_assigend_wokers  saw JOIN employee e ON saw.employee_id = e.Employee_Id WHERE saw.site_id = '$siteId'";
            $assigned_workers_result = mysqli_query($database_connection, $assigned_workers_query);

            if ($assigned_workers_result->num_rows > 0) {
                while ($row = $assigned_workers_result->fetch_assoc()) {
                    echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Name'] . '</td>
                        <td>' .$row['Position'] . '</td>
                        <td>
                            <a href="assign-helmet.php?delete=' . $row['site_id'] . '"class="btn btn-danger">Delete</a>
                        </td>
                        </tr>';
                    $row_number++;
                }
            }else{
                echo '<tr><td colspan="4">No assigned workers found for this construction site.</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
 
    <script>
        //handleFormSubmit("dynamicForm");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/assign-helmet.js"></script>
    
</body>
</html>