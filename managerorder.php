<?php
session_start();
$username = $_SESSION['username'];
$orderId = isset($_GET['id']) ? $_GET['id'] : null;
$_SESSION['orderId'] = $orderId;
    
    
    try {
        require_once "includes/dbh.inc.php";

        $query = 'SELECT * FROM "order" JOIN order_item oi on "order".order_id = oi.order_id JOIN product p on p.product_id = oi.product_id WHERE "order".order_id = ?;';

        $stmt = $pdo->prepare($query);
        $stmt->execute([$orderId]);

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
<div class="container">
    <div class="row">
<table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if(empty($results)){
                echo "<tr>";
                echo "<td colspan='3'>No results:(</td>";
                echo "</tr>";
            }
            else{
                $totalprice = 0;
                foreach ($results as $row){
                    echo "<tr>";
                    echo "<td><a href='product.php?id=" . htmlspecialchars($row["product_id"]) . "'>" . htmlspecialchars($row["product_name"]) . "</a></td>";
                    echo "<td><img src='" . htmlspecialchars($row["image_path"]) . "' width='50px' alt='Product Image'></td>";
                    echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
                    echo "</tr>";
                    $totalprice = $totalprice + ($row['price']*$row['quantity']);
                    $orderstatus = $row['status'];
                }
                echo "<tr>";
                echo "<td colspan='2'>" . "Total: " . htmlspecialchars($totalprice) . "dkk</td>";
                echo "<td colspan='2'>" . "Status: " . htmlspecialchars($orderstatus) . "</td>";
                echo "</tr>";
            }
            ?>
            
        </tbody>
    </table>
    </div>
</div>
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-3 mx-auto">
            <form action="" class="row" method="post">
                <select id="status" class="form-select" name="status">
                    <option value="" disabled selected>Select status</option>
                    <option value="Placed">Placed</option>
                    <option value="Ready">Ready</option>
                    <option value="Picked-up">Picked up</option>
                </select>
                <button type="submit" onclick="changeStatus();" class="btn btn-primary mt-1 mx-auto col-4" name="submit">Confirm</button>
            </form>
        </div>
    </div>
    <script>
        function changeStatus(){
            var status = $('select[name=status]').val();
            var formData = {status: status};
            $.ajax({url: "http://localhost/MyWebsite/includes/orderstatus.inc.php", type: 'POST', data: formData});
            $('select[name=status]').val('');
        };
    </script>
</body>

</html>