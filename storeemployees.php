<?php 
        session_start();
        $storeId = $_SESSION['store_id'] ;
        try {
            require_once "includes/dbh.inc.php";
    
            $query = 'SELECT * FROM employee WHERE store_id = ?;';   
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
                <li><a class="nav-link active" href="mainpagemanager.php">Home</a></li>
                <li><a class="nav-link" href="#">About us</a></li>
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
    
    
    <div class="container mt-5">
    <div class="row">
        <h1>Employees</h1>
        <hr>
    </div>                       
    <?Php

    
    if(empty($results)){
        echo "<div>";
        echo "<p>No employees:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            ?>
            <div class="alert alert-primary col-lg-3 col-md-4 col-sm-6" role="alert">
                <a href='storeemployee.php?id=<?php echo htmlspecialchars($row["username"]); ?>' class="alert-link"><?php echo htmlspecialchars($row['f_name']). " " . htmlspecialchars($row['l_name'])?></a>
            </div>
            <?php
           
        }
    }
    
    ?>
    </div>
</body>
</html>