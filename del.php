<?php

require_once 'init.php';
global $db;

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $pStmt = $db->prepare("
        delete from task
        where id = :id;
    ");

   $pStmt->execute(['id' => $id]);
}
header('Location: index.php');

