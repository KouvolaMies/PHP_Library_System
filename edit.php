<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Book</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/edit.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <form action="edit.php" method="post">
            <?php
                echo "<input type='hidden' name='bookId' value='" . $_GET["id"] . "'>";
            ?>
            <input type="text" name="title">
            <input type="text" name="author">
            <input type="date" name="publish_date">
            <input type="text" name="isbn">
            <input type="submit" value="Edit Book">
        </form>
        <button onclick="GoToDashboard()">back to dashboard</button>

        <?php
            include "db_connect.php";

            $id = $_POST["bookId"];
            $title = $_POST["title"];
            $author = $_POST["author"];
            $publish_date = $_POST["publish_date"];
            $isbn = $_POST["isbn"];

            if($title != null && $author != null && $publish_date != null && $isbn != null){
                $row = [
                    "id" => $id,
                    "title" => $title,
                    "author" => $author,
                    "publish_date" => date("Y-m-d"),
                    "isbn" => $isbn
                ];
    
                $sql = "UPDATE books SET title=:title, author=:author, publish_date=:publish_date, isbn=:isbn WHERE id=:id";
                $pdo->prepare($sql)->execute($row);
            }
        ?>
    </body>
</html>