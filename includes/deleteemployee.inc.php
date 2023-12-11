<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $employee = $_SESSION['employee'];

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