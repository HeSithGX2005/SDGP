<?php 
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : "" ;

function showNewDataBox1($connection,$sqlQuery,$columnName,$redirectPage,$button){
$sql = $sqlQuery;
$result = mysqli_query($connection, $sql);
$count = 0;
if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result)) {
        if ($count % 2 == 0 && $count != 0) { 
            echo '</div><br>'; 
            echo '<div class="row">'; 
        }
        echo '<div class="col-sm-6 mb-3 mb-sm-0">';  
        echo '<div class="card">';
        echo '<div class="card-body materials">';
        echo '<h6 class="card-title">'.$row[$columnName].'</h6>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $count++; 
    }
    echo '</div>';
    echo '<br>'; 
    echo '<div class="row justify-content-center">';
    echo'<div class="col-sm-6 mb-3 mb-sm-0">';
    echo '<a href="'.$redirectPage.'" class="btn btn-primary">'.$button.'</a>';
    echo'</div>';
    echo'</div>';
}else{
    echo 'No Data Found';}
}

$dashboard_content = "";
switch ($user_role){
    case 'admin':
        $titletext = "Admin  Welcome To SafeX";
        $dashboard_content = "SafeX|Admin Dashboard"; 
        $titlebox1 = "Newly Registered Companies"; 
        $titlebox2 = "" ;   
        break;
    case 'company':
        $companyID = $_SESSION['Company_ID'];
        $companyselectSql = "SELECT Company_Name FROM company WHERE Company_ID ='$companyID'";
        $result = mysqli_query($database_connection, $companyselectSql);
        if ($result) {
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              $companyName = $row['Company_Name'];
              $titletext ="Welcome to Safex, $companyName!";
          } else {
              $titletext ="Welcome to Safex!";
          }
        } else {
          $titletext ="Error fetching company information.";
        }
        $dashboard_content = "SafeX|Company Dashboard"; 
        $titlebox1 = "Newly Registered Employees"; 
        break;
    case 'employee':
        $employeeID = $_SESSION['Employee_ID'];
        $employeeselectSql = "SELECT Name FROM employee WHERE Employee_ID ='$employeeID'";
        $result = mysqli_query($database_connection, $employeeselectSql);
        if ($result) {
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              $employeeName = $row['Name'];
              $titletext ="Welcome to Safex, $employeeName!";
          } else {
              $titletext ="Welcome to Safex!";
          }
          } else {
            $titletext ="Error fetching company information.";
          }
        $dashboard_content = "SafeX|Employee Dashboard"; break;
        $titlebox1 = "Items To Request";  
        break;
    default:
        $dashboard_content = "SafeX|Dashboard"; break;
}

?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $dashboard_content; ?></title>
    <link rel="icon" href="img/helmet.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <style>
        body{
            margin-left: 200px;
        }
        .title-text {
      text-align: center;
      margin-top: 20px;
      font-size: 24px;
    }
    </style>
  </head>

  <body>

  <div class="title-text"><?php echo $titletext; ?></div>
  
  <div class="content text-center mt-5">
    <div class="container">
      
      <div class="row row-cols-1 row-cols-md-3">

        <!--material content-->

        <div class="col-4 mb-4  mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title"><?php echo $titlebox1;?></h5><br>
              <?php
                switch($user_role){
                    case 'admin':
                        echo $big = showNewDataBox1($database_connection,"SELECT * FROM company ORDER BY Join_Date DESC LIMIT 6",'Company_Name','Company.php',"View");
                        break;
                    case 'company':
                        echo $big = showNewDataBox1($database_connection,"SELECT * FROM employee ORDER BY Join_Date DESC LIMIT 6",'Name','Employee.php',"View");
                        break;
                    case 'employee':
                        echo $big = showNewDataBox1($database_connection,'company','Join_Date','Company_Name','Company.php',"View");
                        break;
                } 
              ?>


            </div>
          </div>
        </div>
      
        <!--alert content-->

        <div class="col-4 mb-4  mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title">Alert History</h5><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->  
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>

              <a href="alert.html">
                <button type="button" class="btn btn-primary">View All</button>
              </a>
              

            </div>
          </div>
        </div>

        <!--leave content-->
        <div class="col-4 mb-4  mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title">Worker on Leave</h5><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->  
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->  
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->
                    </div>
                  </div>
                </div>
              </div><br>
              <div class="row justify-content-center">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="card">
                    <div class="card-body alerts">
                      <!--get from database-->  
                    </div>
                  </div>
                </div>
              </div><br>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  

    <!--bootstrap javascript links-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>