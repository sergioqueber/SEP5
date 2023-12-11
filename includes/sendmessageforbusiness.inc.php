<?php
session_start();
if(isset($_POST['message'])){
    $message = $_POST['message'];
    $store_id = $_SESSION['store_id'];
    $direction = false;
    $username = $_SESSION['customer'];
   

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO message (message, direction, username, store_id) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$message,((int) $direction) , $username, $store_id]);
        
        die();
        
       


    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};