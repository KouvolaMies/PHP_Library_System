<?php
    include_once "db_connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>borrow Book</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/borrow.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="formContainer">
            <form action="borrow.php" method="post">
                <?php
                    echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
                ?>
                <div id="headerText">Borrow Book</div>
                <div id="inputRow">Borrow Until:<input type='date' id="inputField" name='bookedUntil'></div>
                <input type="submit" id="submitButton" value="Borrow">
            </form>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>

        <?php
            error_reporting(0);
            $id = $_POST["bookId"];
            $bookedUntil = $_POST["bookedUntil"];

            if($bookedUntil != null){
                $row = [
                    "id" => $id,
                    "stat" => "borrowed",
                    "booked_until" => $bookedUntil
                ];
    
                $sql = "UPDATE books SET stat=:stat, booked_until=:booked_until WHERE id=:id";
                $pdo->prepare($sql)->execute($row);

                header("refresh:0; url=recipt.php?id=" . $id);
            }
        ?>
    </body>
</html>