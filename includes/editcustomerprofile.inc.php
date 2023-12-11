<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
   

    try {
        require_once "dbh.inc.php";

        $query0 = "UPDATE customer SET f_name = ?,
                                     l_name = ?, 
                                     email = ?, 
                                     phone_no = ? WHERE username = ? ;";
        $stmt0 = $pdo->prepare($query0);
        $stmt0->execute([$f_name, $l_name, $email, $phone_no, $username]);

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../customerprofile.php");
};