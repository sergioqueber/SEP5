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
                <li><a class="nav-link" href="messages.php">Messages</a></li>
                <li><a class="nav-link active" href="orders.php">Orders</a></li>
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
    ?>
    <br>
    <script src="js/jquery-3.7.1.min.js"> </script>

    <div class="container mt-5">
    <div class="row">
        <?php
        foreach ($results as $row) {
            $deleted = ($row["is_deleted"]) ? "Deleted Item" : "Item posted";  
            echo "<div class='col-md-6'>";
            echo "<img src='" . htmlspecialchars($row["image_path"]) . "' class='img-fluid' alt='Product Image'>";
            echo "</div>";
            echo "<p class='card-text'><b>" . htmlspecialchars($deleted) . "</b></p>";
            echo "<div class='col-md-6'>";
            echo "<h2>" . htmlspecialchars($row["product_name"]) . "</h2>";
            echo "<p>Category: " . htmlspecialchars($row["category"]) . "</p>";
            echo "<p>Price:" . htmlspecialchars($row["price"]) . "dkk</p>";
            echo "<p>Description: " . htmlspecialchars($row["description"]) . "</p>";
            echo "<p>Stock: " . htmlspecialchars($row["stock"]) . "</p>";

        }
        ?>

        </div>
        <div class = "row">
            <div class="col-md-12">
                <h3 class="mb-3">Reviews</h3>
                <hr>
            </div>
        </div>
        
    </div>
    
    <div id="reviews" class="row">
        
    </div>
</div>

<div class="modal fade " id="addedModal" tabindex="-1" role="dialog" aria-labelledby="addedModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addedModalLabel">Review added</h5>
                    <button type="button" class="close" id = "close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your review was added successfully
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close mb-3" >Back</button>
                </div>
            </div>
        </div>
</div>
    <script>
            $(".close").click(function(){
                $('#addedModal').modal('hide');
            });
        function showReviews(){
            
        };
        $(document).ready(function() {
        $.ajax({
        url: 'http://localhost/SEP5/review.php', // Path to your PHP script
        type: 'POST',
        success: function(response) {
            // Insert the HTML directly
            $('#reviews').html(response);
        },
        error: function() {
            alert('Error loading reviews.');
        }
            });
        });
         
    </script>

    <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>