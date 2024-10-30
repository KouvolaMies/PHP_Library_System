<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recipt</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/recipt.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="container">
            <?php
                include_once "db_connect.php";

                $result = $conn->query("SELECT * FROM books WHERE id=" . $_GET["id"]);
                $row = $result->fetch_assoc();
                $msg = "<div id='message'>Thank you for borrowing " . $row["title"] . ". You must return it before " . $row["booked_until"] . ".</div>";
                echo ($msg);

                $result = $conn->query("SELECT email FROM users WHERE id=" . $_SESSION["id"]);
                $row = $result->fetch_assoc();

                //I won't be sending any emails, as this isn't connected to any email servers, but the code below is how I would do it
                //mail("library.recpits@gmail.com", $row["email"], $msg);
            ?>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>
    </body>
</html>