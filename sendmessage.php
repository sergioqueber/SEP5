<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.7.1.min.js"> </script>
    <script>
        $(document).ready(function(){
            var messagesCount = 2;
            $("#moreMessages").click(function(){
                messagesCount = messagesCount + 2;
                $('#display').load("load-message.php", 
                {messagesNewCount: messagesCount});
            })

            $('#send').click(function(){
                $('#display').load("load-message.php", 
                {messagesNewCount: messagesCount});
            })
        });
    </script>
</head>
<body>
    <div id="display">
        <br>
        <?php
        /*session_start();
        $username = $_SESSION['username'];
        //echo $_SESSION['username'];
        try {
            require_once "includes/dbh.inc.php";

            $query = "SELECT * FROM message WHERE username = ? ORDER BY message_id DESC LIMIT 2;
            ;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                echo "<br>";
                echo "No messages yet :(";
            }
            else{
                foreach($results as $row){
                    echo "<p>";
                    echo $username;
                    echo "<br>";
                    echo $row['message'];
                    echo "<p>";
                }
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }*/

        
        ?>
    </div>
    <br>
    <button id="moreMessages">Show more messages</button>
    <div id="message">
    <form action="includes/sendmessage.inc.php" method="post">
        <input id="message" type="text" name="message" placeholder="Write your message here"><br>
        <button id="send">Send</button>
    </form>
    </div>
    
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            var messagesCount = 2;
            $("#show").click(function(){
                messagesCount = messagesCount + 2;
                $('#display').load("load-message.php", 
                {messagesNewCount: messagesCount});
            })
            
        });
    </script>
</head>
<body>
    <div id="display">
        <br>
        <?php
        session_start();
        $username = $_SESSION['username'];
        echo $_SESSION['username'];
        try {
            require_once "includes/dbh.inc.php";

            $query = "SELECT * FROM message WHERE username = ? LIMIT 2;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username]);
    
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($results)){
                echo "<br>";
                echo "No messages yet :(";
            }
            else{
                foreach($results as $row){
                    echo "<p>";
                    echo $username;
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
        function submitForm(){
            var message = $('input[name=message]').val();
            var formData = {message: message};
            $.ajax({url: "http://localhost/MyWebsite/includes/sendmessage.inc.php", type: 'POST', data: formData, success: function(){}})
            $('input[name=message]').val('');
        };
    </script>
      
    
</body>
</html>