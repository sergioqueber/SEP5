<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_SESSION['username'];
    $message = $_POST["message"];
    $direction = TRUE;
   

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO message (message, direction, username, store_id) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$message, $direction, $username, 1]);
        

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};