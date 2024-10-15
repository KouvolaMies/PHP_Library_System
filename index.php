<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>index</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="indexBox">
            <button onclick="GoToLogin()" id="loginButton">Login</button>
            <button onclick="GoToRegister()" id="registerButton">Register</button>
            <?php
                if(isset($_SESSION["login"])){
                    echo "<button onclick=" . '"' . "GoToDashboard()" . '"' . " id='dashboardButton'>Dashboard</button>";
                }
            ?>
        </div>
        <a href="test.php">testing site</a>
        <?php
            error_reporting(0);
            if(isset($_SESSION["login"])){
                echo "<div style='position:absolute; right:20px; bottom:20px;'>logeed in as " . $_SESSION["login"] . "</div>";
            }
        ?>
    </body>
</html>