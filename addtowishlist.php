<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_SESSION['username'];
$productId = $_POST['id'];
$wishlist = $_SESSION['wishlist'];
try {
            require_once "includes/dbh.inc.php";
            $query1 = "SELECT * FROM wishlist_item WHERE wishlist_id = ? AND product_id = ?;";
            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$wishlist, $productId]);
            $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                $query = "INSERT INTO wishlist_item(wishlist_id, product_id) VALUES (?,?);";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$wishlist, $productId]);
                header("Location: popups/popupWishlist.php");
            }else{
                header("Location: popups/popupWishlist2.php");
            }
            
            

            $pdo = null;
            $stmt = null;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }else{
        header("Location: ../index.php");
    };