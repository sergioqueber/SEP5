<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $productId = $_POST["productId"];
    $cartId = $_SESSION["cart"];
    try {
        require_once "dbh.inc.php";
        $query = "SELECT quantity FROM cart_item WHERE product_id = ? and cart_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId, $cartId]);
        $quantity = $stmt->fetchColumn();


        $query = "DELETE FROM cart_item WHERE product_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);

        $query = "UPDATE product SET stock = stock + ? WHERE product_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$quantity,$productId]);

        $pdo = null;
        $stmt = null;

        header("Location: ../cart.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../cart.php");
}