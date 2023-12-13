<?php
session_start();
$username = $_SESSION['username'];
$storeId = $_SESSION['store_id'];
$storename = $_SESSION['storename'];
try {
            require_once "includes/dbh.inc.php";
            $messagesNewCount = $_POST['messagesNewCount'];
            echo '<div class="row">';

            $query = "SELECT store_id FROM store WHERE store_name = ?;";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$storename]);

            $store_id = $stmt->fetchColumn();
            $_SESSION['store_id'] = $store_id;

            $query1 = "SELECT * FROM message WHERE username = ? AND store_id = ? ORDER BY message_id DESC LIMIT $messagesNewCount;";

            $stmt1 = $pdo->prepare($query1);
            $stmt1->execute([$username, $store_id]);
    
            $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            
            if(empty($results)){
                echo "<br>";
                echo "No messages yet :(";
            }
            else{
                foreach($results as $row){
                    ?>
                     
                    <?php 
                    if($row['direction'] === TRUE){
                     ?>
                         <div class="alert alert-success col-7" role="alert">
                     <h4 class="alert-heading"><?php if($row['direction'] === TRUE){   
                                             echo $row['username']. ": ";
                                             }else{
                                             echo $storename . ": ";
                                             }
                                             ?>
                                             </h4>
                     <hr>
                                 <p class="mb-0">
                                      <?php
                                  echo htmlspecialchars($row['message']); ?></p>
                     </div>
                    <?php }else{
                     ?> 
                     <div class="alert alert-primary col-7" role="alert">
                     <h4 class="alert-heading"><?php if($row['direction'] === TRUE){   
                                             echo $row['username']. ": ";
                                             }else{
                                             echo $storename . ": ";
                                             }
                                             ?>
                                             </h4>
                     <hr>
                                 <p class="mb-0">
                                      <?php
                                  echo htmlspecialchars($row['message']); ?></p>
                     </div>
                      <?php
                    } ?>
                    
                <?php
                //     echo "<p>";
                //     if($row['direction'] == TRUE){   
                //         echo $row['username'];
                //     }else{
                //         echo $storename;
                //     }
                //     echo $username;
                //     echo "<br>";
                //     echo $row['message'];
                //     echo "<p>";
                }
            }
            echo '</div>';
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
