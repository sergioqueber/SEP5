<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Register employee</h1>

    <form action="includes/registeremployee.inc.php" method="post">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="text" name="f_name" placeholder="First name"><br><br>
        <input type="text" name="l_name" placeholder="Last name"><br><br>
        <input type="text" name="email" placeholder="E-mail"><br><br>
        <input type="text" name="cpr" placeholder="CPR"><br><br>
        <label for="date">Date of employment:</label><br>
        <input id="date" type="date" name="date_employed"><br><br>
        <input type="text" name="store_name" placeholder="Name of the store"><br><br>
        <br><br>
        <button>Register</button>
    </form>
</body>
</html>