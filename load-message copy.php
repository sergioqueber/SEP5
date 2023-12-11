<?php
session_start();
$username = $_SESSION['username'];
try {
            require_once "includes/dbh.inc.php";
            $messagesNewCount = $_POST['messagesNewCount'];

            $query = "SELECT * FROM message WHERE username = ? AND store_id = ? ORDER BY message_id DESC LIMIT $messagesNewCount;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, 1]);
    
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