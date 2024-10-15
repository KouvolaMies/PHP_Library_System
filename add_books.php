<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Books</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/add.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <form action="add_books.php" method="post">
            <input type="text" name="title">
            <input type="text" name="author">
            <input type="date" name="publish_date">
            <input type="text" name="isbn">
            <input type="submit" value="add book">
        </form>
        <button onclick="GoToDashboard()">back to dashboard</button>

        <?php
            include_once "db_connect.php";

            $title = $_POST["title"];
            $author = $_POST["author"];
            $publish_date = $_POST["publish_date"];
            $isbn = $_POST["isbn"];

            if($title != null && $author != null && $publish_date != null && $isbn != null){
                $row = [
                    "title" => $title,
                    "author" => $author,
                    "publish_date" => date("Y-m-d"),
                    "isbn" => $isbn
                ];
    
                $sql = "INSERT INTO books SET title=:title, author=:author, publish_date=:publish_date, isbn=:isbn";
                $pdo->prepare($sql)->execute($row);
                
                $id = $pdo->lastInsertId();
                $qr = "qr_code.php?id=$id";
                $row = [
                    "id" => $id,
                    "qr" => $qr
                ];
                $sql = "UPDATE books SET qr=:qr WHERE id=:id";
                $pdo->prepare($sql)->execute($row);
            }
        ?>
    </body>
</html>