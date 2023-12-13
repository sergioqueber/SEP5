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
        foreach ($results as $review) {
            // Build your HTML structure for each review
            $html .= '<div class="col-md-4">';
            $html .= '<div class="card mb-4 box-shadow">';
            $html .= '<div class="card-body">';
            $html .= '<p class="card-text">' . htmlspecialchars($review['review_text'], ENT_QUOTES, 'UTF-8') . '</p>';
            // Add more fields as needed
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        echo $html;
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
