<?php

session_start();
include("database.php");

if (!isLoggedIn()) {
    header('Location: register.php');
    exit;
}

$uid  = intval($_SESSION['user_id']);

$sql_fetch = "
    SELECT c.*, ml.added_at
    FROM my_list ml
    JOIN content c ON c.id = ml.content_id
    WHERE ml.user_id = $uid
    ORDER BY ml.added_at DESC
";
$result = mysqli_query($conn, $sql_fetch);
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

$showSearch = false;

include 'includes/header.php';
?>

<main class="main-content">
  <div class="page-header-inner">
    <h1 class="page-title">📋 My List</h1>
    <p class="page-subtitle"><?= count($items) ?> saved item<?= count($items) !== 1 ? 's' : '' ?></p>
  </div>

  <?php if (empty($items)): ?>
    <div class="empty-state">
      <div class="empty-icon">📋</div>
      <p>Your list is empty. Start adding movies!</p>
    </div>
  <?php else: ?>
    <div class="cards-grid">
      <?php foreach ($items as $item): ?>
        <?php include 'includes/card.php'; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>

<?php mysqli_close($conn); ?>
