<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
    <link href="CSS/boostrap/bootstrap.min.css" type="text/css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"> </script>
    <title>Document</title>
</head>
<body>
<script src="js/jquery-3.5.1.min.js"></script>
<div class="modal" id="successModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Your order has been placed, yay!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your operation was successful!
                    <p>
                        <a href="index.php" class="btn btn-primary">Go Back to Home Page</a>
                    </p>
                </div>
            </div>
        </div>
        </div>
    <script>
        $(document).ready(function(){
            $("#successModal").modal("show");
        });
    </script>
</body>
</html>