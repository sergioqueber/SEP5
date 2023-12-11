<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productid = $_POST["productId"];

    try {
        require_once "dbh.inc.php";

        $query = "DELETE FROM product WHERE product_id = ? ;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productid]);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../README.php");
}