<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $cpr = $_POST["cpr"];
    $phone_no = $_POST["phone_no"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $street = $_POST["street"];
    $house_no = $_POST["house_no"];
    $flat_no = $_POST["flat_no"];
   

    try {
        require_once "dbh.inc.php";

        $query0 = "SELECT * FROM city WHERE postcode = ?;";
        $stmt0 = $pdo->prepare($query0);
        $stmt0->execute([$postcode]);

        $results = $stmt0->fetchAll(PDO::FETCH_ASSOC);

        if(empty($results)){
            $query = "INSERT INTO city (postcode, name) VALUES (?, ?) RETURNING postcode;";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$postcode, $city]);
            $postcode = $stmt->fetchColumn();
        }

        $query1 = "INSERT INTO address (postcode, street, house_no, flat_no) VALUES (?, ?, ?, ?) RETURNING address_id;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$postcode, $street, $house_no, $flat_no]);
        $addressId = $stmt1->fetchColumn();

        $query2 = "INSERT INTO owner (username, f_name, l_name, email, cpr, phone_no, address_id) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([$username, $f_name, $l_name, $email, $cpr, $phone_no, $addressId]);
        

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};