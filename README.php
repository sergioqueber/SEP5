<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<h1></h1>
    <?php
    echo 'Hello';
    if (extension_loaded('pgsql')) {
        echo 'PostgreSQL extension is loaded.';
    } else {
        echo 'PostgreSQL extension is not loaded.';
    }
    $host = "balarama.db.elephantsql.com";
    $port = "5432";
    $dbname = "osmxbusz";
    $user = "osmxbusz";
    $password = "m5YUAz0vMtIcjX3bmybJc7Kaz2STNoQ-";
    $schema = "blocal";

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password options='--search_path=$schema'";

    try {
        $pdo = new PDO($dsn);
        // Set PDO attributes if needed
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

        $query = "INSERT INTO product(product_name, price, stock, store_id) VALUES (?,?,?,?);";
        $stmt = $pdo->prepare($query);
        
        $value1 = 'TestValue1';
        $price = 12;
        $stock = 2;
        $store_id = 1;
        //$stmt->bindParam(':value1', $value1);

        $stmt->execute([$value1,$price,$stock,$store_id]);
        echo "Record inserted successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }


    ?>

    <form action="includes/formhandler.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <button>SingUp</button>
    </form>

</body>

</html>