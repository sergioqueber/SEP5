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
    <br>
    <form action="includes/deleteproduct.inc.php" method="post">
        <input type="text" name="productId" placeholder="Product id"><br>
        <button>Delete product</button>
    </form>
    <br>
    <form action="search.php" method="post">
        <label for="search">Search for products in store:</label>
        <input id="search" type="text" name="productsearch" placeholder="Store Id"><br>
        <button>Search</button>
    </form>

    <form action="editstoreinfo.php" method="post">
        <label for="edit">Edit information about store:</label>
        <input id="edit" type="text" name="editinfo" placeholder="Store Id"><br>
        <button id>Edit</button>
    </form>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>