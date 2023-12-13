<?php 
        session_start();
        $storeId = $_SESSION['store_id'] ;
        try {
            require_once "includes/dbh.inc.php";
    
            $query = 'SELECT distinct "order".order_id from "order" JOIN order_item oi on "order".order_id = oi.order_id JOIN product p on p.product_id = oi.product_id JOIN store s on s.store_id = p.store_id WHERE s.store_id = ?;';   
            $stmt = $pdo->prepare($query);
            $stmt->execute([$storeId]);
    
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
                <li><a class="nav-link" href="messages.php">Messages</a></li>
                <li><a class="nav-link Active" href="orders.php">Orders</a></li>
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
                        <a class="dropdown-item" href="#.php">Profile</a>
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
<div class = "container mt-5">
    <div class = "row">
        <h1>Orders</h1>
        <hr>
    </div>

    <?Php
    if(empty($results)){
        echo "<div>";
        echo "<p>No results:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            $query1 = 'SELECT username FROM "order" WHERE order_id = ?';
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$row['order_id']]);

            $username = $stmt1->fetchColumn();

            $query2 = 'SELECT * FROM "order" WHERE order_id = ?;';
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([$row['order_id']]);

            $results1 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">

                        <div class="card-body">
                            <!-- Product name and link to details page -->
                            <h5 class="card-title"><a href="order.php?id=<?php echo htmlspecialchars($row["order_id"]); ?>"><?php echo htmlspecialchars($username); ?></a></h5>
                            <!-- Product price -->
                            <?php
                            foreach($results1 as $row1) : ?>
                            <p class="card-text">Date of placing order: <?php echo htmlspecialchars($row1["date_ordered"]); ?></p>
                            <!-- Additional product information (category, stock, etc.) -->
                            <p class="card-text">Total price: <?php echo htmlspecialchars($row1["total_price"]); ?></p>
                            <span class="status" data-custom-string="<?php echo htmlspecialchars($row1["status"]); ?> "><p class="card-text">Status: <?php echo htmlspecialchars($row1['status']); ?></p></span>
                            <?php 
                            endforeach;  
                            ?>
                        </div>
                    </div>
            </div>
            <?php
        }
    }
    ?>
    </div>
</body>
</html>