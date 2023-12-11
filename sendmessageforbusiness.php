<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="js/jquery-3.7.1.min.js"> </script>
</head>
<body>
    <div id="display">
        <br>
        <?php
        session_start();
        $store_id = $_SESSION['store_id'];
        $username = isset($_GET['id']) ? $_GET['id'] : null;
        echo $store_id;
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