<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productid = $_POST["productId"];

    try {
        require_once "dbh.inc.php";

        $query = "UPDATE product SET is_deleted = true WHERE product_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productid]);

        $pdo = null;
        $stmt = null;

        header("Location: ../managersearch.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../README.php");
}