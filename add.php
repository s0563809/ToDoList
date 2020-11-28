<?php
require_once 'init.php';
global $db;
$sql = "insert into task (text, duedate, status, user)
        values (?, ?, 0, ?)";

if(isset($_POST['inputTask'])){
    $text = trim($_POST['inputTask']);
    $duedate = trim($_POST['inputDate']);

    if(!empty($text)){
        $pStmt = $db->prepare($sql);
        $pStmt->execute([$text, $duedate, $_SESSION['user_id']]);
    }
}
if(!isset($_POST['sort'])) {
    header('Location: index.php');
}else {
    header('Location: sorted.php');
}
