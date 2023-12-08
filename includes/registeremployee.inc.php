<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $cpr = $_POST["cpr"];
    $date = $_POST["date_employed"];
    $storename = $_POST["store_name"];
   

    try {
        require_once "dbh.inc.php";

        $query0 = "SELECT store_id FROM store WHERE store_name = ?;";
        $stmt0 = $pdo->prepare($query0);
        $stmt0->execute([$storename]);

        $storeid = $stmt0->fetchColumn();

        $query = "INSERT INTO employee (username, f_name, l_name, email, cpr, date_employed, store_id) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $f_name, $l_name, $email, $cpr, $date, $storeid]);
        

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};