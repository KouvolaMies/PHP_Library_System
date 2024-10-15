<?php
    include_once "db_connect.php";

    $id = $_GET["id"];

    $where = ['id' => $id];

    $pdo->prepare("DELETE FROM books WHERE id=:id")->execute($where);
    
    header("refresh:0; url=dashboard.php");
?>