<?php
    include_once "db_connect.php";

    $id = $_GET["id"];

    $data = ['id' => $id];

    $pdo->prepare("DELETE FROM genres WHERE id=:id")->execute($data);
    
    header("refresh:0; url=dashboard.php");
?>