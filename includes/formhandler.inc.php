<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $description = $_POST["description"];
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $tmpLoc = $_FILES['image']['tmp_name'];
    $storeId = $_SESSION['store_id'];


    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../Images/'; // Specify the target directory
        $targetForReading = 'Images/';
        $targetFile = $targetDir . basename($fileName);
        $targetFileDisplay = $targetForReading . basename($fileName);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($tmpLoc, $targetFile)) {
            try {
                require_once "dbh.inc.php";

                $query = "INSERT INTO product(product_name, price, stock, store_id, description,category, image_path) VALUES (?,?,?,?,?,?,?);";
                $stmt = $pdo->prepare($query);

                $stmt->execute([$productName, $price, $stock, $storeId,$description,$category, $targetFileDisplay]);

                $pdo = null;
                $stmt = null;

                header("Location: ../index.php");
                die();
            } catch (PDOException $e) {
                die("Query failed" . $e->getMessage());
            }
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    } else {
        echo 'Error: ' . $_FILES['image']['error'];
    }
} else {
    header("Location: ../index.php");
};
