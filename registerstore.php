<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
</head>
<body>

<nav class="navbar navbar-custom navbar-expand-sm navbar-light fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="Images/Blocal logo.png" width="30" height="30" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="mainpagemanager.php">Home</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class="nav-link" href="managermessages.php">Messages</a></li>
                <li><a class="nav-link" href="managerorders.php">Orders</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="Images/profileorange 1.png" alt="Profile pic">
                        <?php
                            
                            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
                                
                                echo 'Hi ' . $_SESSION['username'];
                            } else {
                                echo 'Anonymus user';
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                    </div>
                </li>

               
                
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<br>
<br>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3">Register store</h3>
                <hr>
            </div>
        </div>


    
            <form action="includes/registerstore.inc.php" method="post">
            <div class="form-group mb-3">
            <input type="text" name="storename" placeholder="Name of store" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="phone_no" placeholder="Phone number" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="rating" placeholder="Rating" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="cvr" placeholder="CVR" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="city" placeholder="City" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="postcode" placeholder="Postcode" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="street" placeholder="Street name" class="form-control" />
            </div>
            <div class="form-group mb-3">
            <input type="text" name="house_no" placeholder="Building number" class="form-control" />
            </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
</body>
</html>