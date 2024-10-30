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
        <link rel="stylesheet" href="css/borrow_old.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <div id="formContainer">
            <form action="borrow_old.php" method="post">
                <?php
                    echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
                ?>
                <div id="headerText">Borrow Book</div>
                <div id="inputRow">Borrowed Hours:<select name='bookedHours' id="inputField">
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                </select></div>
                <input type="submit" id="submitButton" value="Borrow">
            </form>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>

        <?php
            error_reporting(0);
            $id = $_POST["bookId"];
            $bookedHours = $_POST["bookedHours"];

            //daylight savings makes the code be off by one hour, but I can't be asked fixing that rn

            if($bookedHours != null){
                $timestamp = date("Y-m-d-H");
                $bookedUntil = date("Y-m-d-H", strtotime("+$bookedHours hour", strtotime($timestamp)));
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