<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_SESSION['username'];
$orderId = $_SESSION['orderId'];
$status = $_POST['status'];
try {
            require_once "dbh.inc.php";
            $query = 'UPDATE "order" SET status = ? WHERE order_id = ?;';
            $stmt = $pdo->prepare($query);
            $stmt->execute([$status, $orderId]);
            
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }else{
        header("Location: ../index.php");
    };