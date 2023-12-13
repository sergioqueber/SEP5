<?php
session_start();
if(isset($_POST['message'])){
    $username = $_SESSION['username'];
    $message = $_POST['message'];
    $direction = TRUE;
    $storeId = $_SESSION['store_id'];
   

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO message (message, direction, username, store_id) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$message, $direction, $username, $storeId]);
        

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};