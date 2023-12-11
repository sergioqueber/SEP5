<?php
    session_start();
    $username = $_SESSION['username'];

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM customer WHERE username = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
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
    <section>
    <h3>Edit info</h3>

    <?php
        foreach ($results as $row){
            echo'<form action="customerprofile.php" method="post">';
            echo'<label for="username">Username:</label><br>';
            echo'<input id="username" type="text" name="username" value="'.htmlspecialchars($row["username"]).'" readonly /><br>';
            echo'<label for="f_name">First name:</label><br>';
            echo'<input id="f_name" type="text" name="f_name" value="'.htmlspecialchars($row["f_name"]).'" /><br>';
            echo'<label for="l_name">Last name:</label><br>';
            echo'<input id="l_name" type="text" name="l_name" value="'.htmlspecialchars($row["l_name"]).'" /><br>';
            echo'<label for="email">E-mail:</label><br>';
            echo'<input id="email" type="text" name="email" value="'.htmlspecialchars($row["email"]).'" /><br>';
            echo'<label for="phone_no">Phone number:</label><br>';
            echo'<input id="phone_no" type="text" name="phone_no" value="'.htmlspecialchars($row["phone_no"]).'" /><br>';
            echo'<button onclick="editProfile();" >Edit</button>';
            echo "</form>";
        }

    ?>
    <script>
        function editProfile(){
            var username = $('input[name=username]').val();
            var f_name = $('input[name=f_name]').val();
            var l_name = $('input[name=l_name]').val();
            var email = $('input[name=email]').val();
            var phone_no = $('input[name=phone_no]').val();
            var formData = {username: username,
                            f_name: f_name,
                            l_name: l_name,
                            email: email,
                            phone_no: phone_no};
            $.ajax({url: "http://localhost/MyWebsite/includes/editcustomerprofile.inc.php", type: 'POST', data: formData})
        };
    </script>
</section>
</body>

</html>