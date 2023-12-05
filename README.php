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
    $schema = "test";

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password options='--search_path=$schema'";

    try {
        $pdo = new PDO($dsn);
        // Set PDO attributes if needed
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";

        $query = "INSERT INTO users (name) VALUES (:value1);";
        $stmt = $pdo->prepare($query);

        $value1 = 'TestValue1';
        $stmt->bindParam(':value1', $value1);

        $stmt->execute();
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
>>>>>>> c8c339d0919a997425c546dce3c404ab6f901914