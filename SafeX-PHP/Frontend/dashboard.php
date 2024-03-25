<?php 
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : "" ;

function showNewDataBox1($connection, $sqlQuery, $columnName, $redirectPage, $button,$columnName1) {
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
          echo '<p class="small">'.$row[$columnName1].'</p>'; // Add small description
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
  } else {
      echo 'No Data Found';
  }
}
function showNewDataBox2($connection,$sqlQuery,$columnName,$imagePath){
$sql = $sqlQuery;
$result = mysqli_query($connection, $sql);
if($result && mysqli_num_rows($result)>0){
  while ($row = mysqli_fetch_assoc($result)) {
    if(isset($_SESSION['Company_ID'])){
      $imgPath ='../Backend/'.$row[$imagePath];
    }
    echo '<div class="row justify-content-center">
    <div class="col-lg-10 mb-2 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="'.$imgPath.'" class="rounded-circle img-fluid" alt="'.$row[$columnName].'">
                    </div>
                    <div class="col-md-8 text-center text-md-start  mt-4 mt-md-0">
                        <h5>'.$row[$columnName].'</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>';
}

}else{
  echo 'No Data Found';
}
}

function showNewDataBox3($connection,$sqlQuery,$columnName,$columnName1){
  $sql = $sqlQuery;
  $result = mysqli_query($connection, $sql);
  if($result && mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="row justify-content-center">
      <div class="col-lg-10 mb-2 mb-lg-0">
          <div class="card">
              <div class="card-body alerts">
                  <h5 class="card-title">'.$row[$columnName].'</h5>
                  <p class="card-text">'.$row[$columnName1].'</p>
              </div>
          </div>
      </div>
  </div><br>';
  }
  
  }else{
    echo 'No Data Found';
  }
  }

$dashboard_content = "";
switch ($user_role){
    case 'admin':
        $titletext = " Welcome To SafeX";
        $dashboard_content = "SafeX|Admin Dashboard"; 
        $titlebox1 = "NEW REGISTERED COMPANY"; 
        $titlebox2 = "";
        $titlebox3 = "INQUIRIES" ;
        break;
    case 'company':
        $companyID = $_SESSION['Company_ID'];
        $companyselectSql = "SELECT Company_Name FROM company WHERE Company_ID ='$companyID'";
        $result = mysqli_query($database_connection, $companyselectSql);
        if ($result) {
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              $companyName = $row['Company_Name'];
              $titletext ="Welcome to Safex <br> $companyName!";
          } else {
              $titletext ="Welcome to Safex!";
          }
        } else {
          $titletext ="Error fetching company information.";
        }
        $dashboard_content = "SafeX|Company Dashboard"; 
        $titlebox1 = "REQUESTED ITEMS"; 
        $titlebox2 = "NEWLY REGISTERED EMPLOYEES";
        $titlebox3 = "NEW MESSAGES";
        break;
    case 'employee':
        $employeeID = $_SESSION['Employee_ID'];
        $employeeselectSql = "SELECT Name FROM employee WHERE Employee_ID ='$employeeID'";
        $result = mysqli_query($database_connection, $employeeselectSql);
        if ($result) {
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              $employeeName = $row['Name'];
              $titletext ="Welcome to Safex<br> $employeeName!";
          } else {
              $titletext ="Welcome to Safex!";
          }
          } else {
            $titletext ="Error fetching company information.";
          }
        $dashboard_content = "SafeX|Employee Dashboard";
        $titlebox1 = "NEW MESSAGES"; 
        $titlebox2 = "WORKERS ON LEAVE";
        $titlebox3 = "ALERT HISTORY" ;
        break;
    default:
        $dashboard_content = "SafeX|Dashboard"; 
}

?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $dashboard_content; ?></title>
    <link rel="icon" href="img/helmet.png" type="image/x-icon">
    <style>
        .title-text {
      text-align: center;
      margin-top: 20px;
      font-size: 24px;
    }
    
  
  /* Content Styles */
  body {
    margin-left: 200px;
background-size: cover;
background-position: center;
  }
  @media (max-width: 768px) {
  body {
    margin-left: 0;
  }
  .title-text{
    font-size: 20px;
  }
}



.materials{
background-color:white; 
border-radius: 10px;
transition: all 0.3s ease-in-out;

}
.materials:hover{
  color: #17a2b8;
}

.box{
background-color: #ffffff;


}

h6{
color: #ffffff;
}

.card-title{
  font-family: "Comfortaa", sans-serif;
  font-optical-sizing: auto;
  font-weight: 300;
  font-style: normal;
  font-size: 18px;
  color: black;

}


h1{
font-family: "Caveat", cursive;
position:relative;
color: #ffffff;
padding: auto;

}
.title-text{
  text-align: center;
  margin-top: 20px;
  font-size: 40px;
  font-family: "Delius", cursive;
  font-weight: 400;
  font-style: normal;
}
    </style>
  </head>

  <body>

  <div class="title-text"><?php echo  $titletext; ?></div>
  
  <div class="content text-center mt-5">
    <div class="container">
      
      <div class="row">


        <div class="col-12 col-md-4 mb-4 mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title"><?php echo $titlebox1;?></h5><br>
              <?php
                switch($user_role){
                    case 'admin':
                        echo $big =  showNewDataBox1($database_connection,"SELECT * FROM company ORDER BY Join_Date DESC LIMIT 6", 'Company_Name','Company.php',"View" ,'Join_Date');
                        break;
                    case 'company':
                        $companyID = $_SESSION['Company_ID'];
                        echo $big =  showNewDataBox1($database_connection, "SELECT item_request.*, construction_site.Site_Name 
                        FROM item_request 
                        INNER JOIN construction_site ON item_request.Site_ID = construction_site.site_id 
                        WHERE item_request.Company_ID = $companyID 
                        ORDER BY item_request.Request_Date DESC 
                        LIMIT 6", 'Request_Item_Name', 'Send_Item.php', "View",'Site_Name');
                        break;
                    case 'employee':
                      $sql = "SELECT m.Sender_Company_ID, c.Company_Name, m.Message_Body
                                      FROM messaging m
                                      JOIN company c ON m.Sender_Company_ID = c.Company_ID
                                      LIMIT 6";
                        echo $big = showNewDataBox1($database_connection,$sql,'Company_Name','Message_Body','message.php',"View");
                        break;
                } 
              ?>


            </div>
          </div>
        </div>
      
        <!--alert content-->

        <div class="col-4 mb-4  mt-5col-12 col-md-4 mb-4 mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title"><?php echo $titlebox2;?></h5><br>
                  <?php
                                  switch($user_role){
                                    case 'admin':
                                        
                                        break;
                                    case 'company':
                                        echo $big = showNewDataBox2($database_connection,"SELECT * FROM employee ORDER BY Join_Date DESC LIMIT 6","Name","Employee_Pic");
                                        break;
                                    case 'employee':
                                        $sql = "SELECT lr.Employee_ID, e.Name, e.Employee_Pic
                                        FROM leave_reporting lr
                                        JOIN employee e ON lr.Employee_ID = e.Employee_ID ORDER BY Leave_Start_Date DESC LIMIT 6";
                                        echo $big = showNewDataBox2($database_connection,$sql,'Name','Employee_Pic','leave.php',"View");
                                        break;
                                } 
                  ?>

              

            </div>
          </div>
        </div>

        <!--leave content-->
        <div class="col-12 col-md-4 mb-4 mt-5">
          <div class="card">
            <div class="card-body box">
              <h5 class="card-title"><?php echo $titlebox3;?></h5><br>
              <?php
                                  switch($user_role){
                                    case 'admin':
                                        echo $big = showNewDataBox3($database_connection,"SELECT * FROM issue_reporting ORDER BY Report_Date DESC LIMIT 4",'Report_Date','Description');
                                        break;
                                    case 'company':
                                        $companyID = $_SESSION['Company_ID'];
                                        echo $big = showNewDataBox3($database_connection,"SELECT messaging.*,employee.Name FROM messaging JOIN employee ON messaging.Sender_Employee_ID = employee.Employee_ID WHERE Receiver_Company_ID ='$companyID' ORDER BY messaging.Timestamp DESC LIMIT 4 ","Name","Message_Body");
                                        break;
                                    case 'employee':
                                      
                                      $sql = "SELECT * FROM falldetection_event ORDER BY time_stamp LIMIT 4";
                                      echo $big = showNewDataBox3($database_connection, $sql,"Fall_Detected","time_stamp");
                                        break;
                                } 
                  ?>
                                <a href="message.php">
                <button type="button" class="btn btn-primary">View All</button>
              </a>
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