<?php
session_start();
$storeId = $_SESSION['store_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $psw = $_POST['psw'];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $cpr = $_POST["cpr"];
    $date = $_POST["date_employed"];
   

    try {
        require_once "dbh.inc.php";


        $query = "INSERT INTO employee (username, password, f_name, l_name, email, cpr, date_employed, store_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $psw, $f_name, $l_name, $email, $cpr, $date, $storeId]);
        header("Location: ../storeemployees.php");
        
        die();

    } catch (PDOException $e) {
        header("Location: ../registeremployee.php");
        die("Query failed" . $e->getMessage());
    }
    
}else{
    header("Location: ../mainpagemanager.php");
};