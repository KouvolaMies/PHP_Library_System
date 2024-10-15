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
        <link rel="stylesheet" href="css/edit.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <form action="borrow.php" method="post">
            <?php
                echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
            ?>
            <input type='date' name='bookedUntil'>
            <input type="submit" value="borrow">
        </form>
        <button onclick="GoToDashboard()">back to dashboard</button>

        <?php
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
            }
        ?>
    </body>
</html>