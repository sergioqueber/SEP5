<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_SESSION['username'];
    $productId = $_SESSION['product_id'];
    $review = $_POST['review'];
    $rate = $_POST['rate'];
   

    try {
        require_once "dbh.inc.php";
        $query = 'SELECT * FROM order_item JOIN product on order_item.product_id = product.product_id JOIN "order" o on o.order_id = order_item.order_id WHERE username LIKE ? AND product.product_id = ?;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $productId]);
        $results = $stmt->fetchAll(PDO::FETCH_COLUMN);

        
        $stmt = null;
        if(empty($results)){
            
            $error = "You didn't buy this product";
            var_dump($error);
        }else{
            $query1 = 'INSERT INTO review(comment, stars, product_id, username) VALUES (?, ?, ?, ?);';
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$review, $rate, $productId, $username]);
            $error = "essa";
        }
        $pdo = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};