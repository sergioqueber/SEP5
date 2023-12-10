<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_SESSION['username'];
try {
            require_once "dbh.inc.php";
            $query = 'INSERT INTO "order"(username, date_ordered, status) VALUES (?, CURRENT_DATE, ?) RETURNING order_id;';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, 'Placed']);
            $orderId = $stmt->fetchColumn();
            
            $query = "SELECT product_id, quantity
                FROM cart_item
                        JOIN blocal.cart c ON cart_item.cart_id = c.cart_id
                WHERE username = ?;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
            $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query = "INSERT INTO order_item(product_id, order_id, quantity) VALUES (?,?,?);";
            $stmt = $pdo->prepare($query);
            
            foreach ($cartItems as $cartItem) {
                $stmt->execute([$cartItem['product_id'], $orderId,$cartItem['quantity']]);
            };

            $query = "DELETE FROM cart_item WHERE cart_id = ? ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_SESSION['cart']]);

            $pdo = null;
            $stmt = null;
            
            echo 'Order placed';
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }else{
        header("Location: ../index.php");
    };