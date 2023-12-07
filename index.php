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
    echo 'Check! ';
    if (extension_loaded('pgsql')) {
        echo 'PostgreSQL extension is loaded.';
    } else {
        echo 'PostgreSQL extension is not loaded.';
    }

    ?>

    <form action="includes/formhandler.inc.php" method="post">
        <input type="text" name="productName" placeholder="Product Name"><br>
        <input type="text" name="price" placeholder="Price"><br>
        <input type="text" name="stock" placeholder="Stock"><br>
        <input type="text" name="storeId" placeholder="Store Id"><br>
        <button>Register product</button>
    </form>

</body>

</html>