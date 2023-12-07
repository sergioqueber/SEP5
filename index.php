<?php
            session_start();
            echo $_SESSION['username'];
            echo 'Check! ';
            if (extension_loaded('pgsql')) {
                echo 'PostgreSQL extension is loaded.';
            } else {
                echo 'PostgreSQL extension is not loaded.';
            }  
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
</head>

<body>
    
    <nav class="navbar navbar-custom navbar-expand-sm navbar-light fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Sergio Berdonce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"> </span></button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li><a class="nav-link active" href="">Home </a></li>
                    <li><a class="nav-link" href="My_town.html">Products </a></li>
                    <li><a class="nav-link" href="Education.html">About us</a></li>
                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="Images/profileorange 1.png" alt="Profile pic">
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <h1> Add a product </h1>
    

    <form action="includes/formhandler.inc.php" method="post" enctype="multipart/form-data">
        <input type="text" name="productName" placeholder="Product Name"><br><br>
        <input type="text" name="price" placeholder="Price"><br><br>
        <input type="text" name="stock" placeholder="Stock"><br><br>
        <input type="text" name="storeId" placeholder="Store Id"><br><br>
        <input type="text" name="description" placeholder="Description"><br><br>
        <select id="categories" name="categories">
            <option value="" disabled selected>Select a category</option>
            <option value="Clothes">Clothes</option>
            <option value="electronics">Electronics</option>
            <option value="clothes">Clothes</option>
            <option value="flowers">Flowers</option>
        </select><br><br>
        <input type="file" name="image"><br><br>
        <button type="submit" name="submit">Register product</button>
    </form>

    <form action="search.php" method="post">
        <label for="search">Search for products in store:</label>
        <input id="search" type="text" name="productsearch" placeholder="Store Id"><br>
        <button>Search</button>
    </form>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>