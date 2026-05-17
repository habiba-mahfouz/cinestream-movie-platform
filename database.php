<?php
date_default_timezone_set('Asia/Riyadh');

$host = "localhost";
$user = "root";
$pass = "";
$db   = "cinestream";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userList = [];
if (isset($_SESSION['user_id'])) {
    $uid_global = $_SESSION['user_id'];
    $res_ul = mysqli_query($conn, "SELECT content_id FROM my_list WHERE user_id=$uid_global");
    if ($res_ul) {
        while ($r_ul = mysqli_fetch_assoc($res_ul)) {
            $userList[] = $r_ul['content_id'];
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>