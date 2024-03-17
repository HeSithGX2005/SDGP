<?php
include("css/css-links.php");
require ("sidepanel.php");
require ("../Backend/database.php");

$user_role = $_SESSION["user_role"];
$company_id = $_SESSION["Company_ID"];
$site_id = $_GET['siteID'];

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
            <form id="dynamicForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Select an option:</h2>
            <select id="dropdown" onchange="showFields()">
                <option value="">Select an option</option>
                <option value="Automatic">Automatic Assigning</option>
                <option value="Manual">Manual Assigning</option>
            </select>
                <input type="submit" value="Assign Worker">
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
            $company_query = "SELECT * FROM company";
            $construction_query = "SELECT * FROM construction_site WHERE company_id = '$company_id'";

            if (isset($_POST['search_constructionsite_button']) && !empty($_POST['search_constructionsite'])) {
                $search_constructionSite = $_POST['search_constructionsite'];
                $construction_query = "SELECT * FROM construction_site WHERE Site_Name LIKE '%$search_constructionSite%' AND company_id = '$company_id'";
            }

            $construction_result = mysqli_query($database_connection, $construction_query);

            if ($construction_result->num_rows > 0) {
                while ($row = $construction_result->fetch_assoc()) {
                    $numWorkers = $row['Number_of_workers'] ?? 0;
                    $assignedHelmets = $row['Assigned_Helmets'] ?? 0;
                    echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Site_Name'] . '</td>
                        <td>' .$numWorkers . '</td>
                        <td>' . $assignedHelmets. '</td>
                        <td>
                            <a href="construction-site.php?delete=' . $row['site_id'] . '"class="btn btn-danger">Delete</a>
                            <a href="#" data-userid="'.$row['site_id'].'" class="btn btn-primary assign-btn">Assign</a>
                        </td>
                        </tr>';
                    $row_number++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("dynamicForm");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/assign-helmet.js"></script>
    
</body>
</html>