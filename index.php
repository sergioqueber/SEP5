<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
</head>

<body>
<h1></h1>
    <?php
   /*  session_start();
    if (extension_loaded('pgsql')) {
        echo 'PostgreSQL extension is loaded.';
    } else {
        echo 'PostgreSQL extension is not loaded.';
    }
 */
    ?>

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
                <li><a class="nav-link" href="wishlist.php">Wishlist</a></li>
                <li><a class = "nav-link" href="cart.php">
                    <img src="Images/cartbl 1.png" alt="Cart">
                </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="Images/profileorange 1.png" alt="Profile pic">
                        <?php
                          /*   
                            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])){
                                
                                echo 'Hi ' . $_SESSION['username'];
                            } else {
                                echo 'Anonymus user';
                            } */
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="login.php">Log-in personal</a>
                        <a class="dropdown-item" href="#">Log-in business</a>
                        <a class="dropdown-item" href="messagescustomer.php">Messages</a>
                        <a class="dropdown-item" href="loginmanager.php">Log-in business manager</a>
                        <a class="dropdown-item" href='loginemployee.php'>Log-in business employee</a>vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/loginmanager.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/loginemployee.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/includes/loginmanagerhandler.inc.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/includes/loginemployee.inc.php
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                    </div>
                </li>

               
                
            </ul>
        </div>
    </div>
</nav>


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

</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
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
                        <a class="dropdown-item" href='loginemployee.php'>Log-in business employee</a>vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/loginmanager.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/loginemployee.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/includes/loginmanagerhandler.inc.php vscode-vfs://github%2B7b2276223a312c22726566223a7b2274797065223a342c226964223a224d617263696e227d7d/sergioqueber/SEP5/includes/loginemployee.inc.php
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                    </div>
                </li>          
                
            </ul>
        </div>
    </div>
</nav>
<div class = 'container'>
    <div class = 'row mt-5'>
        <div class = 'column-md text-center'>
            <h1 id = 'slogan'>Small shops, big dreams</h1>
            <h1 id = 'slogan2'>Transforming local economies together</h1>
            <a class="btn btn-primary" href="mainpagecustomer.php">Find your product</a>
        </div>
    </div>
</div>


<div id="carousel" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active ">
        <div class = 'd-flex justify-content-center'>
            <img src="Images/rubiostus logo.png" class="d-block w-50 img-fluid" alt="Image 1">
        </div>  
    
    </div>
    <div class="carousel-item">
        <div class = 'd-flex justify-content-center'>
            <img src="Images/Logo.png" class="d-block w-50 img-fluid" alt="Image 2">
        </div>
    </div>  
      
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</body>
</html>