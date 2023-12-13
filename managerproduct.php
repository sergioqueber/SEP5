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
                        <a class="dropdown-item" href="#">Profile</a>
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
    <?php
    $productId = isset($_GET['id']) ? $_GET['id'] : null;
    $_SESSION['product_id'] = $productId;
    
    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM product WHERE product_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

    foreach ($results as $row) {
            $deleted = ($row["is_deleted"]) ? "Deleted Item" : "Item posted";    
            echo "<div class='col-md-6'>";
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' class='img-fluid' alt='Product Image'>";
            echo "</div>";
            echo "<div class='col-md-6'>";
            echo "<h2>" . htmlspecialchars($row["product_name"]) . "</h2>";
            echo "<p class='card-text'><b>" . htmlspecialchars($deleted) . "</b></p>";
            echo "<p>Category: " . htmlspecialchars($row["category"]) . "</p>";
            echo "<p>Price: $" . htmlspecialchars($row["price"]) . "</p>";
            echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
            echo "<p>Stock: " . htmlspecialchars($row["stock"]) . "</p>";
    }
    ?>
        <form action='includes/deleteproduct.inc.php' method='post'>
            <input type='hidden' name='productId' value='<?php echo $productId; ?>'>
            <button type='submit' class='btn btn-primary mb-3'>Delete Product</button>
        </form>
        <form action='includes/activateProduct.inc.php' method='post'>
            <input type='hidden' name='productId' value='<?php echo $productId; ?>'>
            <button type='submit' class='btn btn-primary mb-3'>Activate</button>
        </form>
        <form action="managerreview.php" method="post">
            <button type='submit' class='btn btn-primary mb-3'>See reviews</button>
        </form>
        <form action="" method="post">
            <input type='hidden' name='productId' value='<?php echo $productId; ?>'>
            <input type="text" class = "form-control mb-3" name ="stock" Required> 
            <button type='submit' class='btn btn-primary mb-3'>Save</button>
        </form>
    </div>
    </div>
</div>
    <script src="js/jquery-3.7.1.min.js"> </script>
    <script>
        function stock(){
            var stock = $('input[name=stock]').val();
            var storeId = $('input[name=productId]').val();
            var formData = {
                stock: stock
            };
            $.ajax({
                url: "http://localhost/SEP5/includes/stockUpdate.inc.php",
                type: 'POST',
                data: formData,
            });
        }
    </script>

</body>

</html>