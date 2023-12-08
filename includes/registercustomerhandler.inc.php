<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $psw = $_POST["password"];
    $pswCheck = $_POST["checkPassword"];
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $emai = $_POST["email"];
    $phoneNo = $_POST["phoneNo"];
   

    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO customer(username, password, f_name, l_name, email, phone_no) VALUES (?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username,$psw,$fName,$lName,$emai,$phoneNo]);

        $query = "INSERT INTO cart(username) VALUES (?) RETURNING cart_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $cartId = $stmt->fetchColumn();
        $_SESSION['cart'] = $cartId;
        header("Location: ../index.php");
        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};