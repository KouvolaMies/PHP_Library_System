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
        <div id="formContainer">
            <form action="add_books.php" method="post">
                <div id="headerText">Add a Book</div>
                <div id="inputRow">Title:<input type="text" id="inputField" name="title"></div>
                <div id="inputRow">Author:<input type="text" id="inputField" name="author"></div>
                <div id="inputRow">Publish Date:<input type="date" id="inputField" name="publish_date"></div>
                <div id="inputRow">ISBN<input type="text" id="inputField" name="isbn"></div>
                <input type="submit" id="submitButton" value="Add Book">
            </form>
            <button onclick="GoToDashboard()" id="indexButton">Back to Dashboard</button>
        </div>

        <?php
            error_reporting(0);
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