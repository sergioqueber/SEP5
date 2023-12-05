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
            echo "<h4>" . htmlspecialchars($row["product_name"]) . "</h4>";
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