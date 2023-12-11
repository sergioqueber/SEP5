<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
    <script src="js/jquery-3.7.1.min.js"> </script>
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
                <li><a class="nav-link active" href="mainpagemanager.php">Home</a></li>
                <li><a class="nav-link" href="">About us</a></li>
                <li><a class="nav-link" href="managermessages.php">Messages</a></li>
                <li><a class="nav-link" href="managerorders.php">Orders</a></li>
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
                        <a class="dropdown-item" href="includes/logout.inc.php">Log-out</a>
                    </div>
                </li>

               
                
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<br>
<br>    
    <div id="display">
        <br>
        <?php
        session_start();
        $store_id = $_SESSION['store_id'];
        $username = isset($_GET['id']) ? $_GET['id'] : null;
        $_SESSION['customer'] = isset($_GET['id']) ? $_GET['id'] : null;
        try {
            require_once "includes/dbh.inc.php";

            $query = "SELECT * FROM message WHERE username = ? AND store_id = ? ORDER BY message_id DESC LIMIT 2;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $store_id]);

            $query1 = "SELECT store_name FROM store WHERE store_id = ?;";

            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$store_id]);

            $storename = $stmt1->fetchColumn();
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                echo "<br>";
                echo "No messages yet :(";
            }
            else{
                foreach($results as $row){
                    echo "<p>";
                    if($row['direction'] == TRUE){   
                        echo $row['username'];
                    }else{
                        echo $storename;
                    }
                    echo "<br>";
                    echo $row['message'];
                    echo "<p>";
                }
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }

        
        ?>
    </div>
    <br>
    <button id="show">Show more messages</button>
    <form action="" method="post">
        <input type="text" name="message" value="" placeholder="Write your message here"/>
        <input type="button" onclick="submitForm();" name="send_message" value="send"/>
    </form>
    <script>
        var messagesCount = 2;
        function submitForm(){
            var message = $('input[name=message]').val();
            var formData = {message: message};
            $.ajax({url: "http://localhost/MyWebsite/includes/sendmessageforbusiness.inc.php", type: 'POST', data: formData})
            $('input[name=message]').val('');
            messagesCount = messagesCount + 1;
            $('#display').load("loadmessageforbusiness.php", 
            {messagesNewCount: messagesCount});
        };
        $(document).ready(function(){
            $("#show").click(function(){
                messagesCount = messagesCount + 2;
                $('#display').load("loadmessageforbusiness.php", 
                {messagesNewCount: messagesCount});
            })
            
        });
    </script>
      
    
</body>
</html>