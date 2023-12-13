<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $username = $_POST["username"];
    $psw = $_POST["password"];
    $_SESSION['username'] = $username;

    try {
        require_once "dbh.inc.php";

        $query = "SELECT password FROM customer WHERE username = :username;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $results = $stmt->fetchColumn();

        $query = "SELECT cart_id
        FROM cart
                 JOIN customer c ON cart.username = c.username
        WHERE c.username = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $_SESSION['cart'] =  $stmt->fetchColumn();

        $query1 = "SELECT wishlist_id
        FROM wishlist
                 JOIN customer c ON wishlist.username = c.username
        WHERE c.username = ?;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->execute([$username]);
        $_SESSION['wishlist'] =  $stmt1->fetchColumn();

        if ($results == $psw) {
            echo 'Log in successful';
            header("Location: ../mainpagecustomer.php");
        } else {
            echo  '<div class="modal fade " id="logInFailed" tabindex="-1" role="dialog" aria-labelledby="loginlabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSuccessModalLabel">Usernmae or password</h5>
                        <button type="button" class="close" id = "close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Check the fields again
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick = history.back() >Back</button>
                    </div>
                </div>
            </div>
        </div>'
        }

        die();
    } catch (PDOException $e) {
        die("Query failed" . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
};
