<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $username = $_SESSION['username'] ;
    try {
        require_once "dbh.inc.php";
        $query = 'INSERT INTO "order"(username) VALUES (?) RETURNING order_id;';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $orderId = $stmt->fetchColumn();
        
        $query = "SELECT product_id, quantity
            FROM cart_item
                    JOIN blocal.cart c ON cart_item.cart_id = c.cart_id
            WHERE username = ?;";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = "INSERT INTO order_item(product_id, order_id, quantity) VALUES (?,?,?);";
        $stmt = $pdo->prepare($query);
        
        foreach ($cartItems as $cartItem) {
            $stmt->execute([$cartItem['product_id'], $orderId,$cartItem['quantity']]);
        };

        $query = "DELETE FROM cart_item WHERE cart_id = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['cart']]);

        echo '
        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <script>
        $(document).ready(function(){
            $(#myModal").modal("show");
        });
        </script>';

        $pdo = null;
        $stmt = null;
        
    } catch (\Throwable $th) {
        die("Query failed: " . $e->getMessage());
    }
   
} else {
    header("Location: ../index.php");
};

           