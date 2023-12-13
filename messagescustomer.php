<?php

session_start();
$username = $_SESSION['username'];

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT store_name FROM store JOIN message m on store.store_id = m.store_id WHERE username = ? group by store_name order by max(message_id) desc;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

       
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                <li><a class="nav-link" href="mainpagecustomer.php">Home</a></li>
                <li><a class="nav-link" href="wishlist.php">Wishlist</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class="nav-link active" href="messagescustomer.php">Messages</a></li>
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
                        <a class="dropdown-item" href="customerprofile.php">Profile</a>
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

    <section>
    <h3>Messages</h3>

    <?php
    if(empty($results)){
        echo "<div>";
        echo "<p>No messages:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            $query1 = "SELECT store_id FROM store WHERE store_name = ?;";

            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$row['store_name']]);
            $storeid = $stmt1->fetchColumn();

            $query2 = "SELECT * FROM message WHERE store_id = ? AND username = ? ORDER BY message_id DESC LIMIT 1;";

            $stmt2 = $pdo->prepare($query2);
            $stmt2->execute([$storeid, $username]);
            $results1 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="alert alert-success col-lg-6 col-md-6 col-sm-8" role="alert">
                <h4 class="alert-heading"><a href="sendmessage.php?id=<?php echo htmlspecialchars($row["store_name"]); ?>"><?php echo htmlspecialchars($row['store_name']); ?></a></h4>
                <hr>
                <?php 
                foreach($results1 as $row1){ ?>
                            <p class="mb-0">
                                 <?php if($row1['direction'] === TRUE){   
                                        echo $row1['username']. ": ";
                                        }else{
                                        echo $row['store_name'] . ": ";
                                        }
                             echo htmlspecialchars($row1['message']); ?></p>
                             <?php } ?>
                </div>
            <!-- Product card with Bootstrap grid classes -->
                <?php
        }
    }
    
    ?>
</section>



</body>

</html>
