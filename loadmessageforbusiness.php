<?php
session_start();
try {
            require_once "includes/dbh.inc.php";
            $messagesNewCount = $_POST['messagesNewCount'];

            $query = "SELECT * FROM message WHERE username = ? AND store_id = ? ORDER BY message_id DESC LIMIT $messagesNewCount;";

            $stmt = $pdo->prepare($query);
            $stmt->execute(['Paco', 1]);

            $query1 = "SELECT store_name FROM store WHERE store_id = ?;";

            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([1]);

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