<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Register</h1>

    <form action="includes/registercustomerhandler.inc.php" method="post">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="checkPassword" placeholder="Repeat Password"><br><br>
        <input type="text" name="email" placeholder="Email"><br><br>
        <input type="text" name="fName" placeholder="First name"><br><br>
        <input type="text" name="lName" placeholder="Last name"><br><br>
        <input type="text" name="phoneNo" placeholder="Phone No"><br><br>
        <button>Register</button>
    </form>
</body>

</html>