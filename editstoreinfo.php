<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $storeId = $_SESSION["store_id"]
    

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM store JOIN address a on a.address_id = store.address_id JOIN city c on c.postcode = a.postcode
        WHERE store_id = ?;";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$storeId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <section>
    <h3>Search results</h3>

    <?php
    if(empty($results)){
        echo "<div>";
        echo "<p>No results:(</p>";
        echo "</div>";
    }
    else{
        foreach ($results as $row){
            echo'<form action="includes/editstoreinfo.inc.php" method="post">';
            echo'<input id="storeId" type="text" name="storeId" value="'.htmlspecialchars($row["store_id"]).'" readonly /><br>';
            echo'<label for="storename">Name of store:</label><br>';
            echo'<input id="storename" type="text" name="storename" value="'.htmlspecialchars($row["store_name"]).'" /><br>';
            echo'<label for="phone_no">Phone number:</label><br>';
            echo'<input id="phone_no" type="text" name="phone_no" value="'.htmlspecialchars($row["phone_no"]).'" /><br>';
            echo'<label for="rating">Rating:</label><br>';
            echo'<input id="rating" type="text" name="rating" value="'.htmlspecialchars($row["rating"]).'" /><br>';
            echo'<label for="cvr">CVR:</label><br>';
            echo'<input id="cvr" type="text" name="cvr" value="'.htmlspecialchars($row["cvr"]).'" /><br>';
            echo'<label for="street">Street name:</label><br>';
            echo'<input id="street" type="text" name="street" value="'.htmlspecialchars($row["street"]).'" /><br>';
            echo'<label for="house_no">Building number:</label><br>';
            echo'<input id="house_no" type="text" name="house_no" value="'.htmlspecialchars($row["house_no"]).'" /><br>';
            echo'<label for="postcode">Postcode:</label><br>';
            echo'<input id="postcode" type="text" name="postcode" value="'.htmlspecialchars($row["postcode"]).'" /><br>';
            echo'<label for="name">City:</label><br>';
            echo'<input id="name" type="text" name="city" value="'.htmlspecialchars($row["name"]).'" /><br>';
            echo'<button>Edit</button>';
            echo "</form>";
        }
    }
    ?>
</section>
</body>

</html>