<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/buttons.js"></script>
    </head>
    <body>
        <h1 style="padding: 10px; margin-left: 2vw">Welcome to the Library</h1>
        <form action="dashboard.php" method="post" style="display: inline; margin-left: 2.5vw">
            <input type="text" name="search" placeholder="search">
            <input type="submit" value="search">
        </form>
        <button onclick="GoToIndex()" style="padding: 5px; margin-left: 1vw">Back to Index</button>

        <?php
            error_reporting(0);
            include_once "db_connect.php";
            include_once "qr_generate.php";
            include_once "barcode_generate.php";

            if($_SESSION["usertype"] == "admin"){
                echo "<button onclick='GoToAdd()' style='padding: 5px; margin-left: 1vw'>Add Books</button>";
            }

            $bookRows = $pdo->query("SELECT * FROM books");
            foreach($bookRows as $row){
                $id = $row["id"];
                $title = $row["title"];
                $author = $row["author"];
                $publish_date = $row["publish_date"];
                $status = $row["stat"];
                $booked_until = $row["booked_until"];
                GenerateQrCode($row["qr"]);
                GenerateBarcode($row["isbn"]);
                
                if($_POST["search"] == null){
                    echo "
                        <div id='bookDiv'>
                            <h3 id='bookText'>$title</h3>
                            <p id='bookText'>Author: $author</p>
                            <p id='bookText'>Genres: ";
                            $genreRows = $pdo->query("SELECT * FROM genres");
                            foreach($genreRows as $genreRow){
                                if($id == $genreRow["bookid"]){
                                    if($_SESSION["usertype"] == "admin"){
                                        echo "<button onclick='GoToDeleteGenre(" . $genreRow["id"] . ")'>" . $genreRow["genre"] . "</button>, ";
                                    }
                                    else{
                                        echo $genreRow["genre"] . ", ";
                                    }
                                }
                            }
                    echo "
                            </p>
                            <p id='bookText'>Published: $publish_date</p>
                            <p id='bookText'>Status: $status</p>
                            <p id='bookText'>Booked until: $booked_until</p>
                            <img src='$qrcode' alt='qr code' width='100' height='100'>
                            <div style='width: 200px; height: 50px; padding: 10px'>$renderedBarcode</div>";
                            
                            if($status == "available"){
                                $now = new dateTime(date("Y-m-d"));
                                $pubDate = new dateTime($row["publish_date"]);
                                $age = $pubDate->diff($now);
                                if($age->format("%Y") >= 50){
                                    echo "<button onclick='GoToBorrowOld($id)' id='bookButton'>Borrow Book</button>";
                                }
                                else{
                                    echo "<button onclick='GoToBorrow($id)' id='bookButton'>Borrow Book</button>";
                                }
                            }

                            if($_SESSION["usertype"] == "admin"){
                                echo "
                                    <button onclick='GoToEdit($id)' id='bookButton'>Edit Book</button>
                                    <button onclick='GoToAddGenres($id)' id='bookButton'>Add Genres</button>
                                    <button onclick='GoToDelete($id)' id='bookButton'>Remove Book</button>
                                ";
                            }

                    echo "
                        </div>
                    ";
                }
                else{
                    if(str_contains($title, $_POST["search"])){
                        echo "
                            <div id='bookDiv'>
                                <h3 id='bookText'>$title</h3>
                                <p id='bookText'>Author: $author</p>
                                <p id='bookText'>Genres: ";
                                $genreRows = $pdo->query("SELECT * FROM genres");
                                foreach($genreRows as $genreRow){
                                    if($id == $genreRow["bookid"]){
                                        if($_SESSION["usertype"] == "admin"){
                                            echo "<button onclick='GoToDeleteGenre(" . $genreRow["id"] . ")'>" . $genreRow["genre"] . "</button>, ";
                                        }
                                        else{
                                            echo $genreRow["genre"] . ", ";
                                        }
                                    }
                                }
                        echo "
                                </p>
                                <p id='bookText'>Published: $publish_date</p>
                                <p id='bookText'>Status: $status</p>
                                <p id='bookText'>Booked until: $booked_until</p>
                                <img src='$qrcode' alt='qr code' width='100' height='100'>
                                <div style='width: 200px; height: 50px; padding: 10px'>$renderedBarcode</div>";
                                
                                if($status == "available"){
                                    $now = new dateTime(date("Y-m-d"));
                                    $pubDate = new dateTime($row["publish_date"]);
                                    $age = $pubDate->diff($now);
                                    if($age->format("%Y") >= 50){
                                        echo "<button onclick='GoToBorrowOld($id)' id='bookButton'>Borrow Book</button>";
                                    }
                                    else{
                                        echo "<button onclick='GoToBorrow($id)' id='bookButton'>Borrow Book</button>";
                                    }
                                }

                                if($_SESSION["usertype"] == "admin"){
                                    echo "
                                        <button onclick='GoToEdit($id)' id='bookButton'>Edit Book</button>
                                        <button onclick='GoToAddGenres($id)' id='bookButton'>Add Genres</button>
                                        <button onclick='GoToDelete($id)' id='bookButton'>Remove Book</button>
                                    ";
                                }

                        echo "
                            </div>
                        ";
                    }
                    elseif(str_contains($author, $_POST["search"])){
                        echo "
                            <div id='bookDiv'>
                                <h3 id='bookText'>$title</h3>
                                <p id='bookText'>Author: $author</p>
                                <p id='bookText'>Genres: ";
                                $genreRows = $pdo->query("SELECT * FROM genres");
                                foreach($genreRows as $genreRow){
                                    if($id == $genreRow["bookid"]){
                                        if($_SESSION["usertype"] == "admin"){
                                            echo "<button onclick='GoToDeleteGenre(" . $genreRow["id"] . ")'>" . $genreRow["genre"] . "</button>, ";
                                        }
                                        else{
                                            echo $genreRow["genre"] . ", ";
                                        }
                                    }
                                }
                        echo "
                                </p>
                                <p id='bookText'>Published: $publish_date</p>
                                <p id='bookText'>Status: $status</p>
                                <p id='bookText'>Booked until: $booked_until</p>
                                <img src='$qrcode' alt='qr code' width='100' height='100'>
                                <div style='width: 200px; height: 50px; padding: 10px'>$renderedBarcode</div>";
                                
                                if($status == "available"){
                                    $now = new dateTime(date("Y-m-d"));
                                    $pubDate = new dateTime($row["publish_date"]);
                                    $age = $pubDate->diff($now);
                                    if($age->format("%Y") >= 50){
                                        echo "<button onclick='GoToBorrowOld($id)' id='bookButton'>Borrow Book</button>";
                                    }
                                    else{
                                        echo "<button onclick='GoToBorrow($id)' id='bookButton'>Borrow Book</button>";
                                    }
                                }

                                if($_SESSION["usertype"] == "admin"){
                                    echo "
                                        <button onclick='GoToEdit($id)' id='bookButton'>Edit Book</button>
                                        <button onclick='GoToAddGenres($id)' id='bookButton'>Add Genres</button>
                                        <button onclick='GoToDelete($id)' id='bookButton'>Remove Book</button>
                                    ";
                                }

                        echo "
                            </div>
                        ";
                    }
                    else{
                        $genreRows = $pdo->query("SELECT * FROM genres");
                        foreach($genreRows as $genreRow){
                            if($id == $genreRow["bookid"]){
                                if(str_contains($genreRow["genre"], $_POST["search"])){
                                    echo "
                                        <div id='bookDiv'>
                                            <h3 id='bookText'>$title</h3>
                                            <p id='bookText'>Author: $author</p>
                                            <p id='bookText'>Genres: ";
                                            $genreRows = $pdo->query("SELECT * FROM genres");
                                            foreach($genreRows as $genreRow){
                                                if($id == $genreRow["bookid"]){
                                                    if($_SESSION["usertype"] == "admin"){
                                                        echo "<button onclick='GoToDeleteGenre(" . $genreRow["id"] . ")'>" . $genreRow["genre"] . "</button>, ";
                                                    }
                                                    else{
                                                        echo $genreRow["genre"] . ", ";
                                                    }
                                                }
                                            }
                                    echo "
                                            </p>
                                            <p id='bookText'>Published: $publish_date</p>
                                            <p id='bookText'>Status: $status</p>
                                            <p id='bookText'>Booked until: $booked_until</p>
                                            <img src='$qrcode' alt='qr code' width='100' height='100'>
                                            <div style='width: 200px; height: 50px; padding: 10px'>$renderedBarcode</div>";
                                            
                                            if($status == "available"){
                                                $now = new dateTime(date("Y-m-d"));
                                                $pubDate = new dateTime($row["publish_date"]);
                                                $age = $pubDate->diff($now);
                                                if($age->format("%Y") >= 50){
                                                    echo "<button onclick='GoToBorrowOld($id)' id='bookButton'>Borrow Book</button>";
                                                }
                                                else{
                                                    echo "<button onclick='GoToBorrow($id)' id='bookButton'>Borrow Book</button>";
                                                }
                                            }

                                            if($_SESSION["usertype"] == "admin"){
                                                echo "
                                                    <button onclick='GoToEdit($id)' id='bookButton'>Edit Book</button>
                                                    <button onclick='GoToAddGenres($id)' id='bookButton'>Add Genres</button>
                                                    <button onclick='GoToDelete($id)' id='bookButton'>Remove Book</button>
                                                ";
                                            }

                                    echo "
                                        </div>
                                    ";
                                }
                            }
                        }
                    }
                }
            }
        ?>
    </body>
</html>