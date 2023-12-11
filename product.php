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

    <?php
    $productId = isset($_GET['id']) ? $_GET['id'] : null;
    $_SESSION['product_id'] = $productId;
    
    echo $_SESSION['cart'];
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
        echo "<div>";
        echo "<img src='" . htmlspecialchars($row["image_path"]) . "'>";
        echo "<h4>" . htmlspecialchars($row["product_name"]) . "</h4>";
        echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["price"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["category"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["stock"]) . "</p>";
        echo "</div>";
    }
    ?>
    <form action="" method="post">
        <input type="text" name="quantity" value="" placeholder="Quantity"/>
        <input type="button" onclick="addToCart();" name="add" value="Add to cart"/>
    </form>
    <script>
        function addToCart(){
            var quantity = $('input[name=quantity]').val();
            var formData = {quantity: quantity};
            $.ajax({url: "http://localhost/MyWebsite/addproducttocart.php", type: 'POST', data: formData});
            $('input[name=quantity]').val('');
        };
    </script>
    <br>
    <form action="" method="post">
        <label for="review">Leave your review below:</label>
        <input id="review" type="text" name="review" placeholder="Review"><br>
        <label for="rate">Leave your rate below (1-5):</label>
        <input id="rate" type="text" name="rate" placeholder="Rate"><br>
        <input type="button" onclick="addReview();" name="add" value="Add review"/>
    </form>



    <script>
        function addReview(){
            var review = $('input[name=review]').val();
            var rate = $('input[name=rate]').val();
            var formData = {review: review,
                            rate: rate};
            $.ajax({url: "http://localhost/MyWebsite/includes/reviewhandler.inc.php", type: 'POST', data: formData});
            $('input[name=review]').val('');
            $('input[name=rate]').val('');
        };
    </script>
    <form action="review.php" method="post">
        <button>See reviews</button>
    </form>
    <form action="" method="post">
        <input type="button" onclick="addToWishlist();" name="add" value="Add to wishlist"/>
    </form>
    <script>
        function addToWishlist(){
            $.ajax({url: "http://localhost/MyWebsite/addtowishlist.php", type: 'POST'});
        };
    </script>
    
    <script src="js/jquery-3.7.1.min.js"> </script>
    


</body>

</html>