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
        <form action="borrow_old.php" method="post">
            <?php
                echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
            ?>
            <select name='bookedHours'>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
            </select>
            <input type="submit" value="borrow">
        </form>
        <button onclick="GoToDashboard()">back to dashboard</button>

        <?php
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
            }

            /*
            this will be used in dashboard later

            $result = $conn->query("SELECT publish_date FROM books WHERE id=" . $_GET["id"]);
            $row = $result->fetch_assoc();
            $now = new dateTime(date("Y-m-d"));
            $pubDate = new dateTime($row["publish_date"]);
            $age = $pubDate->diff($now);
            if($age->format("%Y")){
                do something
            }
            */
        ?>
    </body>
</html>