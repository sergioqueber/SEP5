<?php 
        session_start();
        $username = $_SESSION['username'] ;
        try {
            require_once "includes/dbh.inc.php";
    
            $query = "SELECT *
            FROM product
                     JOIN blocal.cart_item ci ON product.product_id = ci.product_id
                     JOIN cart c ON c.cart_id = ci.cart_id
                     JOIN customer c2 ON c.username = c2.username
            WHERE c.username = ? ;";   
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
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
                    <li><a class="nav-link" href="index.php">Home</a></li>
                    <li><a class="nav-link" href="">Products</a></li>
                    <li><a class="nav-link" href="">About us</a></li>
                    <li><a class = "nav-link" href="">
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
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="login.php">Log-in personal</a>
                            <a class="dropdown-item" href="#">Log-in business</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                        </div>
                    </li>

                
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <h1>Your cart</h1>

    <?Php
    if (empty($results)) {
        echo "<div class='container'>";
        echo "<p class='alert alert-warning'>No results found</p>";
        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<ul class='list-group'>";
        
        foreach ($results as $row) {
            echo "<li class='list-group-item'>";
            echo "<a href='product.php?id=" . htmlspecialchars($row["product_id"]) . "'>" . htmlspecialchars($row["product_name"]) . "</a><br>";
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' width='50' alt='Product Image'>";
            echo "<p class='mb-0'>" . htmlspecialchars($row["price"]) . "</p>";
            echo "</li>";
        }
    
        echo "</ul>";
        echo "</div>";
    }
    ?>
    <script src="js/jquery-3.5.1.min.js"></script>
    <form action="includes/placeorderhandler.inc.php" method="post">
        <button>Place Order</button>
    </form>

</body>
</html>