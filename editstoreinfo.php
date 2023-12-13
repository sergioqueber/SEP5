<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $storeId = $_SESSION['store_id'];
    

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM store JOIN address a on a.address_id = store.address_id JOIN city c on c.postcode = a.postcode
        WHERE store_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$storeId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: index.php");
}
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
    <section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3">Edit Info</h3>
                <hr>
            </div>
        </div>
        <?php
        foreach ($results as $row){
            echo '<form action="includes/editstoreinfo.inc.php" method="post">';
            echo '<div class="form-group mb-3">';
            echo '<label for="storename"><strong>Name of store:</strong></label>';
            echo '<input id="storename" type="text" name="storename" value="' . htmlspecialchars($row["store_name"]) . '" class="form-control bg-light" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="phone_no"><strong>Phone number:</strong></label>';
            echo '<input id="phone_no" type="text" name="phone_no" value="' . htmlspecialchars($row["phone_no"]) . '" class="form-control" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="cvr"><strong>CVR:</strong></label>';
            echo '<input id="cvr" type="text" name="cvr" value="' . htmlspecialchars($row["cvr"]) . '" class="form-control" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="street"><strong>Street:</strong></label>';
            echo '<input id="street" type="text" name="street" value="' . htmlspecialchars($row["street"]) . '" class="form-control" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="house_no"><strong>Building number:</strong></label>';
            echo '<input id="house_no" type="text" name="house_no" value="' . htmlspecialchars($row["house_no"]) . '" class="form-control" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="postcode"><strong>Postcode:</strong></label>';
            echo '<input id="postcode" type="text" name="postcode" value="' . htmlspecialchars($row["postcode"]) . '" class="form-control" />';
            echo '</div>';
            echo '<div class="form-group mb-3">';
            echo '<label for="name"><strong>Phone number:</strong></label>';
            echo '<input id="name" type="text" name="name" value="' . htmlspecialchars($row["name"]) . '" class="form-control" />';
        
        }

    ?>
    </div>
        <button type="submit" class="btn btn-primary" >Save</button>
    </form>
</div>

    <div class="modal fade " id="editSuccessModal" tabindex="-1" role="dialog" aria-labelledby="editSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSuccessModalLabel">Changes Saved</h5>
                    <button type="button" class="close" id = "close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your store has been updated.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick = history.back() >Back</button>
                </div>
            </div>
        </div>
    </div>
    
</section>
</body>

</html>