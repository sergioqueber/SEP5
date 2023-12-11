<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"> </script>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action = "includes/formhandler.inc.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Product name</label>
                    <input type="text" class="form-control" id="productName" name="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Store id</label>
                    <input type="text" class="form-control" id="storeId" name="password" placeholder="Store ID">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>



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