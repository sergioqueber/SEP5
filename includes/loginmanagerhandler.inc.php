<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $username = $_POST["username"];
    $psw = $_POST["password"];
    $_SESSION['username'] = $username;

    try {
        require_once "dbh.inc.php";

        $query = "SELECT password FROM owner WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $results = $stmt->fetchColumn();

        $query1 = "SELECT store_id FROM store_management WHERE username = :username;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->bindParam(':username', $username);
        $stmt1->execute();

        $storeId = $stmt1->fetchColumn();
        $_SESSION['store_id'] = $storeId;
        $storeId1 = $stmt1->fetchAll(PDO::FETCH_COLUMN);

        echo $results;
        echo $psw;
        if ($results == $psw && $storeId === FALSE && $storeId === FALSE) {
            echo 'Log in successful';
            echo $storeId;
            
            header("Location: ../registerstore.php");
        }else if($results == $psw){
            header("Location: ../index.php");
        }
         else {
            echo 'log in failed';
        }

        die();
    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
};
