<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
    <script src="js/jquery-3.7.1.min.js"> </script>
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
                <li><a class="nav-link active" href="mainpagecustomer.php">Home</a></li>
                <li><a class="nav-link" href="wishlist.php">Wishlist</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class="nav-link" href="messagescustomer.php">Messages</a></li>
                <li><a class="nav-link" href="customerorders.php">Orders</a></li>
                <li><a class = "nav-link" href="cart.php">
                    <img src="Images/cartbl 1.png" alt="Cart">
                </a></li>
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
                        <a class="dropdown-item" href="customerprofile.php">Profile</a>
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
            <h2 class="mb-3">My Account</h2>
            <hr>
        </div>
    </div>
    <?php
    
    
    try {
        require_once "includes/dbh.inc.php";

        $query = 'SELECT * FROM customer where username = ?;';

        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    foreach ($results as $row) {
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<h4>" . htmlspecialchars($row["username"]) . "</h4>";
        echo "<p><strong>First name:</strong> " . htmlspecialchars($row["f_name"]) . "</p>";
        echo "<p><strong>Last name:</strong> " . htmlspecialchars($row["l_name"]) . "</p>";
        echo "</div>";

        echo "<div class='col-md-6'>";
        echo "<p><strong>E-mail:</strong> " . htmlspecialchars($row["email"]) . "</p>";
        echo "<p><strong>Phone number:</strong> " . htmlspecialchars($row["phone_no"]) . "</p>";
        echo "</div>";
        echo "</div>";

    }
    ?>

    <form action="editcustomerprofile.php" method="get">
        <button class="btn btn-primary mt-3">Edit Profile Information</button>
    </form>
    </div>

</body>

</html>