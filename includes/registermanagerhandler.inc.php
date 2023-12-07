<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $street = $_POST["street"];
    $houseNo = $_POST["houseNo"];
    $flatNo = $_POST["flatNo"];
    $username = $_POST["username"];
    $fName = $_POST["fName"];
    $lName = $_POST["lName"];
    $emai = $_POST["email"];
    $cpr = $_POST["cpr"];
    $phoneNo = $_POST["phoneNo"];
   

    try {
        require_once "dbh.inc.php";
        
        $query = "SELECT * FROM city WHERE postcode = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$postcode]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($results)){
            $query = "INSERT INTO city(postcode, name) VALUES (?,?); ";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$postcode,$city]);
            echo 'City added';
        }
        
        $query = "INSERT INTO address(postcode, street, house_no, flat_no) VALUES (?,?,?,?) RETURNING address_id;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$postcode,$street,$houseNo,$flatNo]);

        echo 'address added';
        $address_id = $stmt->fetchColumn();

        $query = "INSERT INTO owner(username, f_name, l_name, email, cpr, phone_no, address_id) VALUES (?,?,?,?,?,?,?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username,$fName,$lName,$emai,$cpr,$phoneNo,$address_id]);


    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};