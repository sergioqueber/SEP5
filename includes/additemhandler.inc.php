<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    echo $productId;
   /*  try {
        require_once "includes/dbh.inc.php";
        $query = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['cart'], ,2]);
        
        echo 'Added to cart';
    
        $pdo = null;
        $stmt = null;
    } catch (\Throwable $th) {
        $query = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES (?,?,?);";
    } */
   
} else {
    header("Location: ../index.php");
};

