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
                <li><a class="nav-link active" href="">Home</a></li>
                <li><a class="nav-link" href="">Products</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class="nav-link" href="wishlist.php">Wishlist</a></li>
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

    <?php
    $orderId = isset($_GET['id']) ? $_GET['id'] : null;
    $_SESSION['orderId'] = $orderId;
    
    
    try {
        require_once "includes/dbh.inc.php";

        $query = 'SELECT * FROM "order" JOIN order_item oi on "order".order_id = oi.order_id JOIN product p on p.product_id = oi.product_id WHERE "order".order_id = ?;';

        $stmt = $pdo->prepare($query);
        $stmt->execute([$orderId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    $totalprice = 0;
    foreach ($results as $row) {
        echo "<div>";
        echo "<img src='" . htmlspecialchars($row["image_path"]) . "'>";
        echo "<h4>" . htmlspecialchars($row["product_name"]) . "</h4>";
        echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
        echo "<p>Price: " . htmlspecialchars($row["price"]) . "</p>";
        echo "<p>Category: " . htmlspecialchars($row["category"]) . "</p>";
        echo "<p>Stock: " . htmlspecialchars($row["stock"]) . "</p>";
        echo "<p>Quantity : " . htmlspecialchars($row["quantity"]) . "</p>";
        echo "</div>";
        $totalprice = $totalprice + ($row['price']*$row['quantity']);
        $status = $row['status'];
    }
    echo"Total price: ".$totalprice;
    echo "<br>";
    echo"Current status: ".$status;
    ?>

    <form action="" method="post">
        <select id="status" name="status">
            <option value="" disabled selected>Select status</option>
            <option value="Placed">Placed</option>
            <option value="Ready">Ready</option>
            <option value="Picked up">Picked up</option>
        </select><br><br>
        <button type="submit" onclick="changeStatus();" name="submit">Confirm</button>
    </form>
    <script>
        function changeStatus(){
            var status = $('select[name=status]').val();
            var formData = {status: status};
            $.ajax({url: "http://localhost/MyWebsite/includes/orderstatus.inc.php", type: 'POST', data: formData});
            $('select[name=status]').val('');
        };
    </script>

</body>

</html>