<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
</head>

<body>
    
<nav class="navbar navbar-custom navbar-expand-sm navbar-light fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="Images/Blocal logo.png" width="30" height="30" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="">Home</a></li>
                <li><a class="nav-link" href="">Products</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class = "nav-link" href="cart.php">
                    <img src="Images/cartbl 1.png" alt="Cart">
                </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="Images/profileorange 1.png" alt="Profile pic">
                        <?php
                            
                            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
                                
                                echo 'Hi ' . $_SESSION['username'];
                            } else {
                                echo 'Anonymus user';
                            }
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="login.php">Log-in personal</a>
                        <a class="dropdown-item" href="loginmanager.php">Log-in business manager</a>
                        <a class="dropdown-item" href='loginemployee.php'>Log-in business employee</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                    </div>
                </li>

               
                
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
    <form action="includes/deleteproduct.inc.php" method="post">
        <input type="text" name="productId" placeholder="Product id"><br>
        <button>Delete product</button>
    </form>
    <br>
    <form action="editstoreinfo.php" method="post">
        <label for="edit">Edit information about store:</label>
        <input id="edit" type="text" name="editinfo" placeholder="Store Id"><br>
        <button id>Edit</button>
    </form>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>