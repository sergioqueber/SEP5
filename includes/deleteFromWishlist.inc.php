<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productid = $_POST["productId"];
    $wishlist = $_SESSION['wishlist'];

    try {
        require_once "dbh.inc.php";

        $query = "DELETE FROM wishlist_item WHERE product_id = ? AND wishlist_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productid, $wishlist]);

        $pdo = null;
        $stmt = null;

        header("Location: ../popups/wishlistDelete.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../wishlist.php");
}