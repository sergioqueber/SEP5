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
     $storeId = isset($_GET['id']) ? $_GET['id'] : null;
     $_SESSION['store_id'] = $storeId;
     
    
    
    try {
        require_once "includes/dbh.inc.php";

        $query = 'SELECT * from store JOIN address a on a.address_id = store.address_id JOIN city c on c.postcode = a.postcode WHERE store_id = ?;';

        $stmt = $pdo->prepare($query);
        $stmt->execute([$storeId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            ?>
            <!-- Product card with Bootstrap grid classes -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">

                    <div class="card-body">
                        <!-- Product name and link to details page -->
                        <h5 class="card-title"><?php echo htmlspecialchars($row["store_name"]); ?></h5>
                        <!-- Product price -->
                        <p class="card-text">Address: <?php echo htmlspecialchars($row["street"]). " " . htmlspecialchars($row["house_no"]). ", " . htmlspecialchars($row["postcode"]). " ". htmlspecialchars($row["name"])  ?></p>
                        <!-- Additional product information (category, stock, etc.) -->
                        <p class="card-text">CVR: <?php echo htmlspecialchars($row["cvr"]); ?></p>
                        <p class="card-text">Rating: <?php echo htmlspecialchars($row["rating"]); ?></p>
                        <p class="card-text">Phone number: <?php echo htmlspecialchars($row["phone_no"]); ?></p>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="managersearch.php" method="get">
        <button class='btn btn-primary mb-4'>Products</button>
    </form>
    <form action="newProduct.php" method="post">
        <button class='btn btn-primary mb-4'>New product</button>
    </form>
    <form action="storeemployees.php" method="post">
        <button class='btn btn-primary mb-4'>Employees</button>
    </form>
    <form action="registeremployee.php" method="post">
        <button class='btn btn-primary mb-4'>Add employee</button>
    </form>
    <form action="editstoreinfo.php" method="post">
        <button class='btn btn-primary mb-4'>Edit info</button>
    </form>
                
            </div>
            <?php
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
    ?>

</div>
</div>

</body>

</html>