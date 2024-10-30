<?php
    error_reporting(0);
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
            "publish_date" => $publish_date,
            "isbn" => $isbn
        ];

        $sql = "UPDATE books SET title=:title, author=:author, publish_date=:publish_date, isbn=:isbn WHERE id=:id";
        $pdo->prepare($sql)->execute($row);
    }

    header("refresh:0; url=dashboard.php");
?>