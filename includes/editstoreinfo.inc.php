<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $storeId = $_POST["storeId"];
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

        $query1 = "UPDATE address
        SET postcode = ?,
            street   = ?,
            house_no = ?
        WHERE address_id = (SELECT address_id FROM store WHERE store_id = ?) RETURNING address_id;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$postcode, $street, $house_no, $storeId]);
        $addressId = $stmt1->fetchColumn();

        $query2 = "UPDATE store 
        SET store_name = ?,
            address_id = ?,
            phone_no = ?,
            rating = ?, 
            cvr = ?, 
            active = ?
        WHERE store_id = ?;";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([$storename, $addressId, $phone_no, $rating, $cvr, $active, $storeId]);
        

        die();

    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
};