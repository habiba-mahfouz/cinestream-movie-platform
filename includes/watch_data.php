<?php

session_start();
include("database.php");

$id = $_GET['id'];

$sql  = "SELECT * FROM content WHERE id = $id";
$res  = mysqli_query($conn, $sql);
$item = mysqli_fetch_assoc($res);


if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];

    $check_sql = "SELECT id FROM history WHERE user_id = $uid AND content_id = $id";
    $check_res = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_res) > 0) {
        
        $update_sql = "UPDATE history SET watched_at = CURRENT_TIMESTAMP 
                      WHERE user_id = $uid AND content_id = $id";
        mysqli_query($conn, $update_sql);
    } else {
        $sql_hist = "INSERT INTO history (user_id, content_id) VALUES ($uid, $id)";
        mysqli_query($conn, $sql_hist);
    }
}


$inList = false;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $sql_list = "SELECT id FROM my_list WHERE user_id=$uid AND content_id=$id";
    $res_list = mysqli_query($conn, $sql_list);
    $inList   = mysqli_num_rows($res_list) > 0;
}

$showSearch = false;


$genre        = $item['genre'];
$sql_rel      = "SELECT * FROM content WHERE genre='$genre' AND id != $id LIMIT 4";
$res_rel      = mysqli_query($conn, $sql_rel);
$relatedItems = [];
while ($r = mysqli_fetch_assoc($res_rel)) {
    $relatedItems[] = $r;
}