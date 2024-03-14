<?php
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
require("../Backend/Other-Script/employee-details.php");
$user_role = $_SESSION["user_role"];
$searchQuery = "";
?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee|SafeX</title>
    <link rel="stylesheet" href="css/employee.css">
    <style>
        body {margin-left: 250px;}
    </style>
  </head>

  <body>
    <div class="content text-center mt-5">
        
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6  mt-5">
                <form method="post">
                <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="search" value="<?php echo $searchQuery; ?>">
                  <button class="btn btn-primary" type="submit" id="searchButton">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                  </button>
                </div>
                </form>
                <?php
                    if(isset($_POST['search'])) {
                        $searchQuery = $_POST['search']; // Retrieve search query from form submission
                    }

                    if(empty($searchQuery)) {
                        $employees = fetchAllEmployeeetails($database_connection);
                    } else {
                        $employees = fetchSearchEmployeeDetails($searchQuery,$database_connection);
                    }
                ?>
                </div>
                        <?php
                        if(isset($user_role) && $user_role == 'company'){
                            echo'<div class="col-md-6  mt-5">';
                                echo'<a href="addemployee.html">';
                                    echo '<button class="btn btn-primary" type="button" id="addbutton">Add Employee</button>';
                                echo'</a>';   
                            echo'</div>';
                        }
                        ?>

                     
            </div>
    </div>
        <br>


        <div class="row text-center">
          <?php
           foreach($employees as $employee): ?>
            <div class="col-xl-3 col-sm-6 mb-5">
                <div class="bg-white rounded shadow-sm py-5 px-4">
                    <img src="<?php echo $employee['Employee_Pic'];?>" alt="<?php echo $employee['Name'];?>" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"><!--employee image-->
                    <h5 class="mb-0"><?php echo $employee['Name'];?></h5>
                    <div class="defaultbutton">
                        <a href="livedefault.html">
                            <button class="btn btn-primary" type="button" value="Live" id="livebutton">Live</button>
                        </a>
                        <a href="viewdefault.html">
                            <button class="btn btn-primary" type="button" value="View" id="viewbutton">View</button>
                        </a>     
                    </div>
                    
                </div>
            </div>
            <?php endforeach; ?>
          </div>
    </div>
    </div>

    <div class="add_new_employee">
        
    </div>
 

</body>
</html>

