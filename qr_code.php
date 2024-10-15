<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/qr.css">
    </head>
    <body>
        <?php
            include_once "db_connect.php";
            include_once "qr_generate.php";
            include_once "barcode_generate.php";

            $bookRows = $pdo->query("SELECT * FROM books")->fetchAll();
            foreach($bookRows as $row){
                if($_GET["id"] == $row["id"]){
                    echo " - " . $row["title"] . " - " . $row["author"] . " - " . $row["status"] . " - ";
                    $genreRows = $pdo->query("SELECT * FROM genres")->fetchAll();
                    foreach($genreRows as $genreRow){
                        if($row["id"] == $genreRow["bookid"]){
                            echo $genreRow["genre"] . " - ";
                        }
                    }
                }
            }
        ?>
    </body>
</html>