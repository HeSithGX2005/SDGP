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
            <form id="dynamicForm" action="../Backend/assign-helmet.php" method="post">
            <input type="hidden" name="siteId" value="<?php echo $siteId ?>">
            <div class="dynamicform">
            <label for="NumofWorker">Number of Worker:</label>
            <input type="number" id="input1" name="NumofWorker" required>
            <label for="NumofSupervisor">Number of Supervisor:</label>
            <input type="number" id="input2" name="NumofSupervisor" required>  
            <input type="submit" value="Assign Worker">
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
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                    if(isset($_GET['siteId'])) {
                        $siteId = $_GET['siteId'];
                        $query = "SELECT e.Name AS employee_name, e.Position AS employee_position
                                  FROM site_assigend_wokers saw
                                  JOIN employee e ON saw.Employee_ID = e.Employee_ID
                                  WHERE saw.Site_ID = '$siteId'";
                    
                        // Perform the query
                        $result = $database_connection->query($query);
                        if ($result->num_rows > 0) {
                            $row_number = 1;

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row_number . '</td>';
                                echo '<td>' . $row["employee_name"] . '</td>';
                                echo '<td>' . $row["employee_position"] . '</td>';
                                echo '</tr>';
                                $row_number++;
                            }
                        } else {
                            echo "No workers assigned to this site.";
                        }
                    } else {
                        echo "Site ID not found in the URL.";
                    }
                    
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/notification-panel.js"></script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    //<script src="js/assign-helmet.js"></script>
    <script>
        handleFormSubmit("dynamicForm");
    </script>
    
</body>
</html>