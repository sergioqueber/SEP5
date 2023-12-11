<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productname = $_POST["productName"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $storeId = $_POST["storeId"];

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO product (product_name, price, stock, store_id) VALUES (?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productname, $price, $stock, $storeId]);

        $pdo = null;
        $stmt = null;

        header("Location: ../README.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../mainpagemanager.php");
}