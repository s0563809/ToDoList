<?php
session_start();
$_SESSION['user_id'] = 1;
try {

    $db = new PDO('mysql:dbname=todolist;host=localhost', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    return 'connection failed' . $e->getMessage();
}
if (!isset($_SESSION['user_id'])) {
    die('not logged in');
}
