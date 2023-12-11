<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png">
  <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"> </script>
</head>
<body style="margin: 0; background: #ffffff;">

  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="Images/Blocal logo.png" width="30" height="30" alt="logo" class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="mainpagecustomer.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="wishlist.php">Wishlist</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
          <li class="nav-item"><a class="nav-link" href="messagescustomer.php">Messages</a></li>
          <li class="nav-item"><a class="nav-link" href="customerorders.php">Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php"><img src="Images/cartbl 1.png" alt="Cart"></a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="Images/profileorange 1.png" alt="Profile pic">
              <?php
              if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['username'])) {
                echo 'Hi ' . $_SESSION['username'];
              } else {
                echo 'Anonymous user';
              }
              ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="text-center mt-5">
            <h1 class="title-5xOTHh valign-text-middle" data-id="67:790">Welcome</h1>
            <p class="nice-to-see-you-again-5xOTHh valign-text-middle" data-id="67:791">Nice to see you again.</p>
          </div>
          <form action="includes/loginhandler.inc.php" method="post" class="mt-4">
            <div class="form-group">
              <input class="form-control" name="username" placeholder="Username" type="text" required>
            </div>
            <div class="form-group">
              <input class="form-control" name="password" placeholder="Password" type="password" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </form>
        </div>
      <div class="col-md-6">
      <img id="blocallogo" src="Images/Blocal logo.png" alt="blocal logo" width="80%" class="justify-content-center"></div></div>
    </div>
      <!-- Sign-up section -->
      <div class="text-center mt-3">
            <p>Don't have an account?</p>
            <a href="signup.php" class="btn btn-outline-secondary">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</body>
</html>
