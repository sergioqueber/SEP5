<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $username = $_POST["username"];
    $psw = $_POST["password"];
    $_SESSION['username'] = $username;

    try {
        require_once "dbh.inc.php";

        $query = "SELECT password FROM customer WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $results = $stmt->fetchColumn();

        $query = "SELECT cart_id
        FROM cart
                 JOIN customer c ON cart.username = c.username
        WHERE c.username = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $_SESSION['cart'] =  $stmt->fetchColumn();

        $query1 = "SELECT wishlist_id
        FROM wishlist
                 JOIN customer c ON wishlist.username = c.username
        WHERE c.username = ?;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$username]);
        $_SESSION['wishlist'] =  $stmt1->fetchColumn();

        echo $results;
        echo $psw;
        if ($results == $psw) {
            echo 'Log in successful';
            header("Location: ../mainpagecustomer.php");
        } else {
            echo 'log in failed';
        }

        die();
    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
};
