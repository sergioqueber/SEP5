

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productsearch = $_POST["productsearch"];
    

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM product WHERE store_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productsearch]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../README.php");
}
?>

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
    
    <section>
    <h3>Search results</h3>

    <?php
    if(empty($results)){
        echo "<div>";
        echo "<p>No results:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            echo "<div>";
            echo "<a href = 'product.php?id=" .htmlspecialchars($row["product_id"]) ."' >" . htmlspecialchars($row["product_name"]) . "</a><br>";
            echo "<img src='".htmlspecialchars($row["image_path"]) ."'>";
            echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["price"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["category"]) . "</p>";
            echo "<p>" . htmlspecialchars($row["stock"]) . "</p>";
            echo "</div>";
        }
    }
    ?>
</section>
</body>

</html>