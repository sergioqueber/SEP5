<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $stock = $_POST["stock"]
   $productId = $_POST["productId"]

    try {
        require_once "dbh.inc.php";

        $query0 = "UPDATE product SET stock = ? WHERE product_id = ?;";
        $stmt0 = $pdo->prepare($query0);
        $stmt0->execute([$stock,$productId]);
        
        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../managerproduct.php");
};