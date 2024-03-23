<?php include "css/css-links.php";
    include ("../Backend/login.php");
?>
<!doctype html>
<html lang="en">
    
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SafeX|Login</title>
    <!--css links-->
    <link rel="stylesheet" href="css/login1.css">
    <link rel="icon" href="img/helmet.png" type="image/x-icon">

    
    
  </head>
  
    <body>

        <!--Hero section-->
        <div id="hero" class="col-12 min-vh-100 text-center d-flex justify-content-center align-items-center">
            <!--login box-->
            <div class="col-lg-3 col-md-4 col-sm-4 shadow-lg p-3 mb-1 login-container">
                <!--logo section-->
                <div class="container p-2">
                    <figure class="logo col-sm-8 mt-2 mb-2 mx-auto text-center">
                        <img src="../Frontend/img/logo2.PNG" class="img-fluid" alt="Logo">
                    </figure>  
                </div>
                <?php include_once "../Backend/Error-Handling/login-error.php"?>
                <!--login form-->
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <form id="login-form" action="" method="post">    
                            <div class="input-box mt-3 mb-4">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="input-box mb-4">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="text-center mb-3">
                                <a href="dashboard.html">
                                    <button type="submit" class="btn btn-rounded" data-mdb-ripple-init>Login</button>
                                </a>
                            </div>
                            <div class="forgot-password text-center"><!--admin email-->
                                <p>Forgot Password ? <a href="mailto:">Contact Admin</a></p>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>   
        </div>
                

                <footer>
                    <div class="footerBottom mt-3">
                        <p>&copy; All Rights Reserved </p>
                    </div>
                </footer>

            </div>
        </div>

        <!--bootstrap javascript links-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
