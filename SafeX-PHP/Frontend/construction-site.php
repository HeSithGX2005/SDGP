<?php
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
$user_role = $_SESSION["user_role"];
$company_id = $_SESSION["Company_ID"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Add New Construction Site</title>
    <link rel="stylesheet" href="css/company.css">
    <style>
.add_new_site_form{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 1px solid gray; 
    border-radius: 10px;
    padding: 20px; 
    z-index: 1000; /* make sure the form appears on top of the overlay */
    background-color: #fff; /* white background */
    display: none; /* initially hidden */
    max-width: 80%; /* optional: set max width for the form */ 
}
.blur {
    filter: blur(5px); /* Apply a blur effect */
    pointer-events: none; /* Prevent interactions with blurred elements */
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
    z-index: 999; /* make sure the overlay appears on top */
    display: none; /* initially hidden */
}
    </style>
</head>
<body>
<div class="main-container">
        <div class="upper-part col-md-6">
            <form action="" method="post">
                <div class="input-container">
                    <input type="text" name="search_constructionsite" id="input-box" placeholder="Constructionsite Name">
                    <button type="submit" name="search_constructionsite_button" id="search">Search</button>
                </div>
            </form>
            <button name="add_new_constructionsite" id="showFormBtn" class="btn-primary assign-btn">Add New</button>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Construction Site</th>
                    <th class="resizable">Number of Helmet</th>
                    <th class="resizable">Number of Workers</th>
                    <th class="resizable">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $row;
            $row_number = 1;
            $company_query = "SELECT * FROM company";

            // Initialize $construction_query with a default query
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
    <div class="overlay" id="overlay"></div> 
    <div class="add_new_site_form" id="add_new_site_form">
    <h2 class="text-center">Register New Construction Site</h2>
        <form action="../Backend/construction-site.php" method="post" id="register_new_construction">
            <div class="col-md-12">
            <label for="sitename">Construction Site Name:</label><br>
            <input type="text" id="name" name="sitename" required><br><br>
            </div>
            <div class="col-12 text-center">
            <input type="submit" value="Add Construction Site" name="add_site" class="btn btn-primary">
            </div>
        </form>
    </div>
    <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("register_new_construction");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/assign-helmet.js"></script>
    <script>
            const btn = document.getElementById("showFormBtn");
            const form = document.getElementById("add_new_site_form");
            const overlay = document.getElementById("overlay");
            const containers = document.querySelectorAll(".main-container, .table-container");

            btn.addEventListener('click', () => {
                if (form.style.display === "none") {
                    form.style.display = "block";
                    containers.forEach(function(container) {
                        container.classList.add("blur");
                    });
                } else {
                    form.style.display = "none";
                }
            });

            overlay.addEventListener("click", function(event) {
                if (event.target === this) {
                    form.style.display = "none";
                    containers.forEach(function(container) {
                        container.classList.remove("blur");
                    });
                }
            });
    </script>
</body>
</html>