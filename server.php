<?php
    include_once "db_connect.php";

    $currentDate = date("Y-m-d-H");

    $bookRows = $pdo->query("SELECT id, booked_until FROM books");
    foreach($bookRows as $row){
        if($row["booked_until"] != null && $row["booked_until"] < $currentDate){
            $data = [
                "id" => $row["id"],
                "stat" => "available",
                "booked_until" => null
            ];
            $sql = "UPDATE books SET stat=:stat, booked_until=:booked_until WHERE id=:id";
            $pdo->prepare($sql)->execute($data);
        }
    }
    
    header("refresh:10; url=server.php");
?>