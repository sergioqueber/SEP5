<?php
session_start();
$username = $_SESSION['username'];
$storeId = $_SESSION['store_id'];
try {
            require_once "includes/dbh.inc.php";
            $messagesNewCount = $_POST['messagesNewCount'];

            $query = "SELECT * from message JOIN store s on s.store_id = message.store_id WHERE username = ? AND message.store_id = ? ORDER BY message_id DESC LIMIT $messagesNewCount;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $storeId]);
    
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
                        echo $row['store_name'];
                    }
                    echo "<br>";
                    echo $row['message'];
                    echo "<p>";
                }
            }
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }