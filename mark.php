<?php
require_once 'init.php';
global $db;

if (isset($_GET['as'], $_GET['id'])) {
    $as     = $_GET['as'];
    $id  = $_GET['id'];

    switch ($as) {
        case 'done':
            $pStmt = $db->prepare("
                update task
                set status = 1
                where id = :id
                and user = :user
            ");
            $pStmt->execute([
                'id' => $id,
                'user' => $_SESSION['user_id']
            ]);
            break;
        case 'notdone':
            $pStmt = $db->prepare("
                update task
                set status = 0
                where id = :id
                and user = :user
            ");
            $pStmt->execute([
                'id' => $id,
                'user' => $_SESSION['user_id']
            ]);
            break;

    }
}
if(!isset($_GET['sort'])) {
    header('Location: index.php');
}else {
    header('Location: sorted.php');
}
