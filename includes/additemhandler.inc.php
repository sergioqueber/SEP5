<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $productID = $_POST["productId"];
    echo $productID;
    try {
        require_once "dbh.inc.php";
        $query = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['cart'], $productID ,1]);
        
        header("Location: ../popupCart.php");
    
        $pdo = null;
        $stmt = null;
    } catch (\Throwable $th) {
        echo $productID;

        $query = "UPDATE cart_item SET quantity = quantity+1 WHERE product_id = ? AND cart_id = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$productID, $_SESSION['cart']]);

        $pdo = null;
        $stmt = null;
        header("Location: ../popupCart.php");

    }
   
} else {
    header("Location: ../index.php");
};
