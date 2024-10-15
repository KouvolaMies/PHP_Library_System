<?php
    //use get to do the qr code thingy, just put the path to the page + ?(name of get variable goes here)=(whatever value)

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    require_once('vendor/autoload.php');

    $options = new QROptions(
        [
            'eccLevel' => QRCode::ECC_L,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'version' => 5,
        ]
    );

    $qrcode = (new QRCode($options))->render("lehmä");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <a href="index.php">index</a>
        <img src="<?= $qrcode ?>" alt="qr code" width='100' height='100'>
        <button onclick="GoToEdit(1)">edit book</button>
        <button onclick="GoToAddGenres(1)">add genres</button>
        <button onclick="GoToDeleteGenre(1)">delete genre</button>
        <button onclick="GoToBorrow(1)">borrow book</button>
        <button onclick="GoToBorrowOld(2)">borrow old book</button>
        <button onclick="GoToDelete(3)">delete book</button>

        <?php
            include "db_connect.php";
            
            $bookRows = $pdo->query("SELECT * FROM books")->fetchAll();
            foreach($bookRows as $row){
                echo " - " . $row["title"] . " - " . $row["author"] . " - ";
                $genreRows = $pdo->query("SELECT * FROM genres")->fetchAll();
                foreach($genreRows as $genreRow){
                    if($row["id"] == $genreRow["bookid"]){
                        echo $genreRow["genre"] . " - ";
                    }
                }
            }

            echo $_GET["test"];
            
            $barcode = (new Picqer\Barcode\Types\TypeEan13())->getBarcode("123456789012");
            $renderer = new Picqer\Barcode\Renderers\DynamicHtmlRenderer();
            $renderer->setBackgroundColor([255, 255, 255]);

            $renderedBarcode = $renderer->render($barcode);

            echo "<div style='width: 200px; height: 50px'>$renderedBarcode</div>";
        ?>
    </body>
</html>