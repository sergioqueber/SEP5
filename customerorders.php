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
<div class = "container mt-5">    
    
    <div class = "row">
        <h1>Your orders</h1>
    </div>
    
    
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

            $query2 = 'SELECT * FROM "order" WHERE order_id = ?;';
            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([$row['order_id']]);

            $results1 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <!-- Product card with Bootstrap grid classes -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">

                        <div class="card-body orderCard">
                            <!-- Product name and link to details page -->
                            <h5 class="card-title"><a href="customerorder.php?id=<?php echo htmlspecialchars($row["order_id"]); ?>"><?php echo htmlspecialchars($storename); ?></a></h5>
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
                        

                        <!-- Add to cart button or other actions -->
                        <div class="card-footer">
                       <!-- <form action='includes/additemhandler.inc.php' method='post'>
                            <input type='hidden' name='productId' value='<?php echo htmlspecialchars($row["product_id"]); ?>'>
                            <button type='submit' class='btn btn-primary'>Add to Cart</button>
                        </form> -->
                        </div>
                    </div>
                </div>
                <?php
        }
    }
    ?>
    </div>
    <script>
        $(document).ready(function () {
        // Loop through each element with class "status"
        $(".status").each(function () {
            // Get the status value for each element
            var status = $(this).data('customString');
            console.log("Status:", status);

            // Set the background color based on the status for each element
            switch (status) {
                case "Placed":
                    console.log('Setting background color to orange');
                    $(this).closest('.orderCard').addClass('bg-warning');
                    break;
                case 'Pending':
                    $(this).closest('.orderCard').css('background-color', 'yellow');
                    break;
                case 'Ready':
                    $(this).closest('.orderCard').css('background-color', 'green');
                    break;
                case 'Picked-up':
                    $(this).closest('.orderCard').css('background-color', 'red');
                    break;
                // Add more cases as needed
                default:
                    // Default color or no change
                    break;
            }
        });
    });
    </script>
</body>
</html>
