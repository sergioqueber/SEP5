<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-custom navbar-expand-sm navbar-light fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Sergio Berdonce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"> </span></button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li><a class="nav-link active" href="">Home </a></li>
                    <li><a class="nav-link" href="My_town.html">Products </a></li>
                    <li><a class="nav-link" href="Education.html">About us</a></li>
                    <a href="login.php"><img src="Images/profileorange 1.png" alt="Profile pic"></a>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    $productId = isset($_GET['id']) ? $_GET['id'] : null;
    session_start();
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
    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $('#add').load();
            })
        })
    </script>
    <button>Add to cart</button>
    <div id="add">
        <?php
        try {
            require_once "includes/dbh.inc.php";
            $query = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES (?,?,?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_SESSION['cart'], $productId,2]);

            $pdo = null;
            $stmt = null;
        } catch (\Throwable $th) {
            //throw $th;
        }

        ?>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>

</body>

</html>