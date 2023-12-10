<?php
session_start();
if(isset($_POST['quantity'])){
$username = $_SESSION['username'];
$productId = $_SESSION['product_id'];
$quantityNew = $_POST['quantity'];
try {
            require_once "includes/dbh.inc.php";
            $query1 = "SELECT quantity FROM cart_item WHERE cart_id = ? AND product_id = ?;";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$_SESSION['cart'], $productId]);
            $quantity = $stmt1->fetchColumn();
            if($quantity === False || $quantity === NULL){
                $query = "INSERT INTO cart_item(cart_id, product_id, quantity) VALUES (?,?,?);";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$_SESSION['cart'], $productId, $quantityNew]);
            }else{
                $query = "UPDATE cart_item SET quantity = ? WHERE cart_id = ? AND product_id = ?;";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$quantityNew + $quantity, $_SESSION['cart'], $productId]);
            }
            
            

            $pdo = null;
            $stmt = null;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }else{
        header("Location: ../index.php");
    };