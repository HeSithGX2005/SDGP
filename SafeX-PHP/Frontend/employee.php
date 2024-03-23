<?php
require("../Backend/database.php");
include("css/css-links.php");
require ("sidepanel.php");
require("../Backend/Other-Script/employee-details.php");

$user_role = $_SESSION["user_role"];
$searchQuery = "";

// Check if session variable is set to company_id or employee_id
if(isset($_SESSION['company_id']) && $user_role === 'company') {
    $company_id = $_SESSION['company_id'];
    $query = "SELECT * FROM employee WHERE Company_ID = $company_id";
} elseif (isset($_SESSION['Employee_ID']) && $user_role === 'employee') {
    $employeeID = $_SESSION["Employee_ID"];
    $query = "SELECT * FROM employee WHERE Employee_ID IN (SELECT Employee_ID FROM site_assigend_wokers WHERE Site_ID = (SELECT Site_ID FROM site_assigend_wokers WHERE Employee_ID = $employeeID))";
} else {
    $query = "SELECT * FROM employee";
}
$employees = $database_connection->query($query);

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee|SafeX</title>
    <style>

        body {
            margin-left: 250px;
            background-size: cover;
            background-position: center;
        }

        /* Center the search bar */
        .search-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Custom styling for the search bar */
        .input-group {
            max-width: 500px; /* Adjust as needed */
        }
        
        /* Additional styling for the search button */
        .btn-primary {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .content{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
        }
        .add_new_employee{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid gray; 
            border-radius: 10px;
            padding: 20px; 
            z-index: 1000; 
            background-color: #fff; 
            display: none; 
            max-width: 80%; 
        }
        .selected-employee{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid gray; 
            border-radius: 10px;
            padding: 20px; 
            z-index: 1000; 
            background-color: #fff; 
            display: none; 
            max-width: 80%; 
        }
        .overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 999; 
    display: none; 
}

.blur {
    filter: blur(5px); /* Adjust the blur radius as needed */
}
    </style>
  </head>

  <body>
    <div class="content text-center mt-5">
        
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search">
                    <button class="btn btn-primary" type="submit" id="searchButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <?php
        if (isset($user_role) && $user_role == 'company') {
            echo '<div class="col-md-6 mt-5">';
            echo '<button class="btn btn-primary" type="button" id="showFormBtn">Add Employee</button>';
            echo '</div>';
        }
        ?>
    </div>
</div>

    <?php
                    if(isset($_POST['search'])) {
                        $searchQuery = $_POST['search']; // Retrieve search query from form submission
                    }

                    if(empty($searchQuery)) {
                        $employees = fetchAllEmployeeDetails($database_connection);
                    } else {
                        $employees = fetchSearchEmployeeDetails($searchQuery,$database_connection);
                    }
                ?>
        <br>


        <div class="row text-center">
          <?php
           foreach($employees as $employee): ?>
            <div class="col-xl-3 col-sm-6 mb-5">
                <div class="bg-white rounded shadow-sm py-5 px-4">
                    <img src="<?php echo '../Backend/'.$employee['Employee_Pic'];?>" alt="<?php echo $employee['Name'];?>" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm"><!--employee image-->
                    <h5 class="mb-0"><?php echo $employee['Name'];?></h5><br>
                    <div class="defaultbutton">
                    <?php
                        if(isset($user_role) && $user_role == 'employee'){
                                echo' <a href="live-default.php">';
                                    echo '<button class="btn btn-primary" type="button" value="Live" id="livebutton">Live</button>';
                                echo'</a>';   
                        }if(isset($user_role) && $user_role == 'company'){
                            echo '<a href="#" data-employee-id="' . $employee['Employee_ID'] . '" class="deleteBtn">';
                            echo '<button class="btn btn-danger " type="button">Delete</button>';
                            echo '</a>';
                        }
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                        <script>
                        $(document).ready(function() {
                            $('.deleteBtn').click(function() {
                                var employeeID = $(this).data('employee-id');
                                
                                // Display SweetAlert confirmation dialog
                                Swal.fire({
                                    title: 'Delete Employee',
                                    text: 'Are you sure you want to delete this employee?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        $.ajax({
                                            url: '../Backend/delete-employee.php',
                                            method: 'POST',
                                            data: { employeeID: employeeID },
                                            success: function(response) {
                                                console.log(response);
                                            },
                                            error: function(xhr, status, error) {
                                                console.error(xhr.responseText);
                                            }
                                        });
                                    }
                                });
                            });
                        });
                        </script>
                        <a href="employee.php?id=<?php echo $employee['Employee_ID']; ?>">
                            <button class="btn btn-primary" type="button" value="View" id="viewbutton">View</button>
                        </a>     
                    </div>
                    
                </div>
            </div>
            <?php endforeach; ?>
          </div>
    </div>
    <div class="overlay" id="overlay"></div>
<div class="add_new_employee" id="add_new_employee">
    <h2 class="text-center">Add Employee</h2>
    <form id="employeeForm" action="../Backend/employee.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="position" class="form-label">Position:</label>
                <select id="position" name="position" class="form-select" required>
                    <option value="">Select Position</option>
                    <option value="worker">Worker</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="management">Management</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telephone" class="form-label">Telephone Number:</label>
                <input type="text" id="telephone" name="telephone" class="form-control" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="employeePic" class="form-label">Employee Picture:</label>
                <input type="file" id="employeePic" name="employeePic" class="form-control" accept="image/*">
                <div id="preview"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("employeeForm");
        var data = { employeeID: employeeID };
        handleButtonClicked('../Backend/delete_employee.php', 'POST', data);
    </script>
<script>
    document.getElementById('employeePic').addEventListener('change', function(event) {
    var preview = document.getElementById('preview');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;
        img.style.maxWidth = '200px'; 
        preview.innerHTML = ''; 
        preview.appendChild(img);
    };

    reader.readAsDataURL(file);
});
</script>
<?php
// Retrieve the Employee_ID from the URL parameter
if(isset($_GET['id'])) {
    $employeeID = $_GET['id'];
    
    // Fetch the details of the selected employee based on the Employee_ID
    $selectEmployeeSQL = "SELECT * FROM employee WHERE Employee_ID = $employeeID";
    $result = $database_connection->query($selectEmployeeSQL);
    
    // Check if employee details are found
    if ($result && $result->num_rows > 0) {
        $employee = $result->fetch_assoc();
?>
<script>
    // Preload employee details into a JavaScript variable
    const employeeDetails = <?php echo json_encode($employee); ?>;
</script>

<!-- Display the employee details -->
<div class="selected-employee" id="selected-employee">
    </div>
<?php
    } else {
        echo "Employee details not found!";
    }
}
?>
 <script>
document.addEventListener("DOMContentLoaded", function() {
    const viewBtn = document.getElementById("viewbutton");
    const btn = document.getElementById("showFormBtn");
    const form = document.getElementById("add_new_employee");
    const displaydetails = document.getElementById("selected-employee");
    const overlay = document.getElementById("overlay");
    const containers = document.querySelectorAll(".content");

    btn.addEventListener('click', () => {
        if (form.style.display === "none") {
            form.style.display = "block"; 
            overlay.style.display = "block";
            containers.forEach(function(container) {
                container.classList.add("blur");
            });
        } else {
            form.style.display = "none";
            overlay.style.display = "none";
            containers.forEach(function(container) {
                container.classList.remove("blur");
            });
        }
    });
    viewBtn.addEventListener('click', () => {
        if (displaydetails.style.display === "none") {
            displaydetails.style.display = "block";
            overlay.style.display = "block";
            containers.forEach(function(container) {
                container.classList.add("blur");
            });

            // Populate the employee details using the preloaded variable
            const employeeDetailsHTML = `
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 mt-5">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <!-- Employee image -->
                                        <img src="../Backend/${employeeDetails['Employee_Pic']}" alt="${employeeDetails['Name']}" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">Employee Details</h5><br>
                                            <p class="card-text">Employee Id: ${employeeDetails['Employee_ID']}</p>
                                            <p class="card-text">Employee Name: ${employeeDetails['Name']}</p>
                                            <p class="card-text">Position: ${employeeDetails['Position']}</p>
                                            <p class="card-text">Contact No: ${employeeDetails['Telephone_No']}</p>
                                            <p class="card-text">Email: ${employeeDetails['Email_Address']}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            displaydetails.innerHTML = employeeDetailsHTML;
        } else {
            displaydetails.style.display = "none";
            overlay.style.display = "none";
            containers.forEach(function(container) {
                container.classList.remove("blur");
            });
        }
    });

    overlay.addEventListener("click", function(event) {
        if (event.target === this) {
            form.style.display = "none";
            displaydetails.style.display = "none";
            overlay.style.display = "none";
            containers.forEach(function(container) {
                container.classList.remove("blur");
            });
        }
    });
});
</script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

