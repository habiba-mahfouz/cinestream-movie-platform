<?php

session_start();
include("database.php");

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'guest' => true]);
    exit;
}

$uid       = intval($_SESSION['user_id']);
$action    = $_POST['action'] ?? '';
$contentId = intval($_POST['content_id'] ?? 0);

if (!$contentId) {
    echo json_encode(['success' => false, 'error' => 'Invalid content ID']);
    exit;
}

if ($action === 'add') {

    $sql = "INSERT IGNORE INTO my_list (user_id, content_id) VALUES ($uid, $contentId)";
    $ok = mysqli_query($conn, $sql);
    echo json_encode(['success' => $ok]);

} elseif ($action === 'remove') {

    $sql = "DELETE FROM my_list WHERE user_id=$uid AND content_id=$contentId";
    $ok = mysqli_query($conn, $sql);
    echo json_encode(['success' => $ok]);

} else {
    echo json_encode(['success' => false, 'error' => 'Unknown action']);
}

mysqli_close($conn);
