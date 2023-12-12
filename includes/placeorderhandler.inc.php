<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $username = $_SESSION['username'] ;
    try {
        require_once "dbh.inc.php";
        $query = 'INSERT INTO "order"(username, date_ordered, status) VALUES (?, CURRENT_DATE, ?) RETURNING order_id;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, 'Placed']);
        $orderId = $stmt->fetchColumn();
        
        $query = "SELECT cart_item.product_id, quantity, price
        FROM cart_item
                 JOIN blocal.cart c ON cart_item.cart_id = c.cart_id
                 JOIN blocal.product p ON cart_item.product_id = p.product_id
        WHERE username = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = "INSERT INTO order_item(product_id, order_id, quantity) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        $totalprice = 0;
        foreach ($cartItems as $cartItem) {
            $stmt->execute([$cartItem['product_id'], $orderId,$cartItem['quantity']]);
            $totalprice = $totalprice + ($cartItem['price']*$cartItem['quantity']);
        };

        $query = 'UPDATE "order" SET total_price = ? WHERE order_id = ?;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$totalprice,$orderId ]);

        $query = "DELETE FROM cart_item WHERE cart_id = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['cart']]);
        header("Location: ../popup.php");

    

        $pdo = null;
        $stmt = null;
        
    } catch (\Throwable $th) {
        die("Query failed: " . $e->getMessage());
    }
   
} else {
    header("Location: ../index.php");
};