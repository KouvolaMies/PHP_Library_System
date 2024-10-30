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
        <div id="formContainer">
            <form action="add_genres.php" method="post">
                <?php
                    echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
                ?>
                <div id="headerText">Add Genres</div>
                <div id="inputRow">Genre:<input type="text" id="inputField" name="genre"></div>
                <input type="submit" id="submitButton" value="Add Genre">
            </form>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>

        <?php
            error_reporting(0);
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