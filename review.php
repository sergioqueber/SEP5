<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $productId = $_SESSION["product_id"];
    

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM review WHERE product_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$productId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $html = '';
        if (empty($results)) {
            echo "<div class='review-container'>";
            echo "<p>No reviews :(</p>";
            echo "</div>";
        } else {
            foreach ($results as $row) {
                echo "<div class='review'>";
                echo "<p><strong>Username:</strong> " . htmlspecialchars($row["username"]) . "</p>";
                echo "<p><strong>Comment:</strong> " . htmlspecialchars($row["comment"]) . "</p>";
                echo "<p><strong>Rating:</strong> " . htmlspecialchars($row["stars"]) . " / 5</p>";
                echo "</div>";
            }
        }

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: ../README.php");
}
?>
