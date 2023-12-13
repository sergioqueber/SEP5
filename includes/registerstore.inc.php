<?php
session_start();
$username = $_SESSION['username'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $storename = $_POST["storename"];
    $phone_no = $_POST["phone_no"];
    $rating = $_POST["rating"];
    $cvr = $_POST["cvr"];
    $city = $_POST["city"];
    $postcode = $_POST["postcode"];
    $street = $_POST["street"];
    $house_no = $_POST["house_no"];
    $active = TRUE;
   

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

        $query1 = "INSERT INTO address (postcode, street, house_no) VALUES (?, ?, ?) RETURNING address_id;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$postcode, $street, $house_no]);
        $addressId = $stmt1->fetchColumn();

        $query2 = "INSERT INTO store (store_name, address_id, phone_no, rating, cvr, active) VALUES (?, ?, ?, ?, ?, ?) RETURNING store_id;";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([$storename, $addressId, $phone_no, $rating, $cvr, $active]);
        $storeId = $stmt2->fetchColumn();

        $query3 = "INSERT INTO store_management (store_id, username) VALUES (?, ?);";
        $stmt3 = $pdo->prepare($query3);
        $stmt3->execute([$storeId, $username]);
        
        $query4 = "SELECT store_id FROM store_management WHERE username = ?;";
        $stmt4 = $pdo->prepare($query4);
        $stmt4->execute([$username]);

        $storeId1 = $stmt4->fetchColumn();
        $_SESSION['store_id'] = $storeId1;

        header('Location: ../mainpagemanager.php');

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../mainpagemanager.php");
};