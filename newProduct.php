<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>