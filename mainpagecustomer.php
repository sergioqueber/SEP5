<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li><a class="nav-link active" href="">Home</a></li>
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
    <form action="storescustomer.php" method="get">
        <button>Stores</button>
    </form>

    <form action="search.php" method="post">
        <label for="search">Search for products in store:</label>
        <input id="search" type="text" name="productsearch" placeholder="Store Id"><br>
        <button>Search</button>
    </form>
    <br>
    
    <?php
        try {
            require_once "includes/dbh.inc.php";
    
            $query = "SELECT * FROM product LIMIT 20; ";
    
            $stmt = $pdo->prepare($query);
            $stmt->execute();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $pdo = null;
            $stmt = null;

           /*  if(empty($results)){
                echo "<div>";
                echo "<p>No results:(</p>";
                echo "</div>";
            }
            else{
                foreach ($results as $row){
                    echo "<div>";
                    echo "<a href = 'product.php?id=" .htmlspecialchars($row["product_id"]) ."' >" . htmlspecialchars($row["product_name"]) . "</a><br>";
                    echo "<img src='".htmlspecialchars($row["image_path"]) ."'>";
                    echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                    echo "<p>" . htmlspecialchars($row["price"]) . "</p>";
                    echo "<p>" . htmlspecialchars($row["category"]) . "</p>";
                    echo "<p>" . htmlspecialchars($row["stock"]) . "</p>";
                    echo "</div>";
                }
            } */
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        
    
    ?>

    <div class="container mt-5">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Filter options (example) -->
                    <h5 class="card-title">Filters</h5>
                    <form action="seach.php" method="post">
                        <!-- Add your filter options here (e.g., category, price range, etc.) -->
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="searchStore">Search for products in store:</label>
                            <input id="searchStore" type="text" class = "form-control" name="storeName" placeholder="Store Name"><br>
                        </div>
                        <div class = "mb-3">
                            <label for="price">Price Range</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>

                        <!-- Add more filter options as needed -->

                        <!-- Apply filters button -->
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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



    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>