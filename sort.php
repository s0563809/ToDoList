<?php
include 'init.php';
global $db;
global $rs;
$pStmt = $db->prepare("
    select id, text, duedate, status
    from task 
    where user = :user
    order by duedate;
");

$pStmt->execute([
    'user' => 1
]);

$rs = $pStmt->rowCount() ? $pStmt : [];

header("Location: index.php");

