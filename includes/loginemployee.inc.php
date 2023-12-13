<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $username = $_POST["username"];
    $psw = $_POST["password"];
    $_SESSION['username'] = $username;

    try {
        require_once "dbh.inc.php";

        $query = "SELECT password FROM employee WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $results = $stmt->fetchColumn();

        $query = "SELECT store_id FROM employee WHERE username = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $_SESSION['store_id'] =  $stmt->fetchColumn();

        echo $results;
        echo $psw;
        if ($results == $psw) {
            echo 'Log in successful';
            header("Location: ../orders.php");
        } else {
            header("Location: ../popups/popupLogIn.php");
        }

        die();
    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
};
