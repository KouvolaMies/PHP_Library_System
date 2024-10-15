<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Genres</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/genres.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <form action="add_genres.php" method="post">
            <?php
                echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
            ?>
            <input type="text" name="genre">
            <input type="submit" value="add genre">
        </form>
        <button onclick="GoToDashboard()">back to dashboard</button>

        <?php
            include_once "db_connect.php";

            $id = $_POST["bookId"];
            $genre = $_POST["genre"];

            if($genre != null){
                $row = [
                    "genre" => $genre,
                    "bookid" => $id
                ];
    
                $sql = "INSERT INTO genres SET genre=:genre, bookid=:bookid";
                $pdo->prepare($sql)->execute($row);
            }
        ?>
    </body>
</html>