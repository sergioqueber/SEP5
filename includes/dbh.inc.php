<?php
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
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }