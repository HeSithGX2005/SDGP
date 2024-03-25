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
    <link rel="stylesheet" href="css/company.css">
    <title>SafeX|Add New Company</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
.add_new_company_form {
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
                    <input type="text" name="search_company" id="input-box" placeholder="Company Name">
                    <button type="submit" name="search_company_button" id="search">Search</button>


                </div>
            </form>
            <button name="add_new_company" id="showFormBtn">Add New</button>
        </div>
    </div>
    <div class="table-container table-responsive">
        <table class="data-table" id="resizeMe">
            <thead>
                <tr>
                    <th class="resizable">#</th>
                    <th class="resizable">Company Name</th>
                    <th class="resizable">No Of Helmet</th>
                    <th class="resizable">Cloud Renwal Date</th>
                    <th class="resizable">Register Date</th>
                    <th class="resizable">Action</th>
                </tr>
                <script src="js/api.js"></script>
            </thead>
            <tbody>
                <?php
                $row;
                $row_number=1;
                $company_query="SELECT * FROM company";
                if (isset($_POST['search_company_button']) && !empty($_POST['search_company'])) {
                    $search_company = $_POST['search_company'];
                    $company_query = "SELECT * FROM company WHERE Company_Name LIKE '%$search_company%'";
                }
                $company_result=mysqli_query($database_connection,$company_query);
                if($company_result->num_rows>0){
                    while($row=$company_result->fetch_assoc()){
                        echo '<tr>
                        <td>' . $row_number . '</td>
                        <td>' . $row['Company_Name'] . '</td>
                        <td>' . $row['No_of_Helmet'] . '</td>
                        <td>' . $row['Cloud_Storage_Renew_Date'] . '</td>
                        <td>' . $row['Join_Date'] . '</td>
                        <td>
                        <a href="#" data-company-id="' . $row['Company_ID'] . '" class="deleteBtn">
                        <button class="btn btn-danger " type="button">Delete</button>
                        </a>
                        </td>
                        </tr>';
                        $row_number++;
                    }
                }
                ?>
               <script>
$(document).ready(function() {
    $('.deleteBtn').click(function() {
        var companyID = $(this).data('company-id');
        
        // Display SweetAlert confirmation dialog
        Swal.fire({
            title: 'Delete Company',
            text: 'Are you sure you want to delete this company?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../Backend/delete-employee.php', // Update the URL to your backend script
                    method: 'POST',
                    data: { Company_ID: companyID }, // Make sure the field name matches what your backend expects
                    success: function(response) {
                        response = response.trim(); // Trim leading and trailing whitespace
                        var data = JSON.parse(response);
                        if (data.status === 'success') {
                            // Optionally, you can reload the page or update the UI
                            location.reload(); // Reload the page
                        } else {
                            // Handle error
                            Swal.fire('Error!', data.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error
                        Swal.fire('Error!', 'An error occurred while deleting the company.', 'error');
                    }
                });
            }
        });
    });
});
</script>

            </tbody>
        </table>
    </div>
    <div class="overlay" id="overlay"></div>      
    <div class="add_new_company_form" id="add_new_company_form">
    <h2 class="text-center">Register New Company</h2>
    <form action="../Backend/add-new-company.php" method="post" id="register_new_company" class="row">
        <div class="col-md-6">
            <label for="company_name">Company Name:</label><br>
            <input type="text" id="company_name" name="company_name" class="form-control"><br>
        </div>
        <div class="col-md-6">
            <label for="no_of_helmet">Number of Helmets:</label><br>
            <input type="number" id="no_of_helmet" name="no_of_helmet" class="form-control"><br>
        </div>
        <div class="col-md-6">
            <label for="cloud_storage_renew_date">Cloud Storage Renew Date:</label><br>
            <input type="date" id="cloud_storage_renew_date" name="cloud_storage_renew_date" class="form-control"><br>
        </div>
        <div class="col-md-6">
            <label for="email_address">Email Address:</label><br>
            <input type="email" id="email_address" name="email_address" class="form-control"><br>
        </div>
        <div class="col-12 text-center"> <!-- Center the button -->
            <input type="submit" value="Register" class="btn btn-primary">
        </div>
    </form>
</div>
 <script>

</script>
    <script src="js/notification-panel.js"></script>
    <script>
        handleFormSubmit("register_new_company");
    </script>
    <script src="js/table-resize-script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
            const btn = document.getElementById("showFormBtn");
            const form = document.getElementById("add_new_company_form");
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


