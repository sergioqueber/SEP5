<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $storeId = $_POST["storeId"];

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO product(product_name, price, stock, store_id) VALUES (?,?,?,?);";
        $stmt = $pdo->prepare($query);

        $stmt->execute([$value1,$price,$stock,$store_id]);
        echo "Record inserted successfully";

        $stmt->execute([$productName, $price, $stock, $store_id]);

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};