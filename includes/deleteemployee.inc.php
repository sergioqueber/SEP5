<?php
session_start();
$employee = $_SESSION['employee'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    

    try {
        require_once "dbh.inc.php";

        $query = "DELETE FROM employee WHERE username = ? ;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$employee]);

        $pdo = null;
        $stmt = null;

        header("Location: ../storeemployees.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../mainpagemanager.php");
}