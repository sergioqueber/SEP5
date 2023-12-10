<?php 
        session_start();
        $username = $_SESSION['username'] ;
        try {
            require_once "includes/dbh.inc.php";
    
            $query = 'SELECT distinct "order".order_id from "order" JOIN order_item oi on "order".order_id = oi.order_id JOIN product p on p.product_id = oi.product_id JOIN store s on s.store_id = p.store_id WHERE username = ?;';   
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
    if(empty($results)){
        echo "<div>";
        echo "<p>No results:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            $query1 = 'SELECT store_name FROM store JOIN product p on store.store_id = p.store_id JOIN order_item oi on p.product_id = oi.product_id JOIN "order" o on o.order_id = oi.order_id WHERE o.order_id = ?;';
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$row['order_id']]);

            $storename = $stmt1->fetchColumn();

            echo "<div>";
            echo "<a href = 'customerorder.php?id=" .htmlspecialchars($row["order_id"]) ."' >" . htmlspecialchars($storename) . "</a><br>";
            echo "</div>";
        }
    }

   
    ?>
</body>
</html>
