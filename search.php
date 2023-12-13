

<?php

session_start();
$storeId = $_SESSION['storeId'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $storeName = '%';
    $category = '%';
    $maxPrice = 100000000;
    echo empty($_POST['maxPrice']);

    if(isset($_POST['storeName']) && !empty($_POST['storeName'])){
        $storeName = $_POST["storeName"];  
    }
    if(isset($_POST['category']) && !empty($_POST['category'])){
        $category = $_POST["category"];
    }
    if(isset($_POST['maxPrice']) && !empty($_POST['maxPrice'])){
        $maxPrice = $_POST["maxPrice"];
        echo $maxPrice;
    }
    echo $storeName;
    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT *
        FROM product
                 JOIN store s ON product.store_id = s.store_id
        WHERE store_name ILIKE ? and category ILIKE ? AND price < ? AND is_deleted = false;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$storeName, $category, $maxPrice]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
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

    <script src="js/jquery-3.7.1.min.js"></script>

    <div class = "container mt-5">
    <div class="row">
        
        <?php
        if (empty($results)) {
            echo "<div class='col-12'>";
            echo "<p>No results:(</p>";
            echo "</div>";
        } else {
            foreach ($results as $row) {
                ?>
                <!-- Product card with Bootstrap grid classes -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img src="<?php echo htmlspecialchars($row["image_path"]); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row["product_name"]); ?>">

                        <div class="card-body">
                            <!-- Product name and link to details page -->
                            <h5 class="card-title"><a href="product.php?id=<?php echo htmlspecialchars($row["product_id"]); ?>"><?php echo htmlspecialchars($row["product_name"]); ?></a></h5>
                            <!-- Product price -->
                            <p class="card-text"><?php echo htmlspecialchars($row["price"]); ?>dkk</p>
                            <!-- Additional product information (category, stock, etc.) -->
                            <p class="card-text"><?php echo htmlspecialchars($row["category"]); ?></p>
                            <p class="card-text">Stock: <?php echo htmlspecialchars($row["stock"]); ?></p>
                        </div>

                        <!-- Add to cart button or other actions -->
                        <div class="card-footer">
                            <button class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>

    </div>
</div>
    </div>


</body>

</html>