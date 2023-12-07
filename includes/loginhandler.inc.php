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
        echo $results;
        echo $psw;
        if ($results == $psw) {
            echo 'Log in successful';
            header("Location: ../index.php");
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
