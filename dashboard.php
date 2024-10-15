<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <h1>home</h1>
        <button onclick="GoToIndex()">Back to Index</button>
        <a href="qr_code.php?id=1">qr test</a>

        <?php
            include_once "db_connect.php";
            include_once "qr_generate.php";
            include_once "barcode_generate.php";

            GenerateQrCode("qr_code.php?id=1");

            echo "<img src='$qrcode' alt='qr code' width='100' height='100'>";

            GenerateQrCode("hello");

            echo "<img src='$qrcode' alt='qr code' width='100' height='100'>";

            GenerateBarcode("123456789012");

            echo "<div style='width: 200px; height: 50px'>$renderedBarcode</div>";

            if($_SESSION["usertype"] == "admin"){
                echo "<button onclick=" . '"' . "GoToAdd()" . '"' . ">Add Books</button>";
            }
        ?>
    </body>
</html>