<?php

session_start();
include("database.php");


if (!isLoggedIn()) {
    header('Location: register.php');
    exit;
}

$uid = intval($_SESSION['user_id']);

$sql = "
    SELECT c.*, MAX(h.watched_at) as latest_watched
    FROM history h
    JOIN content c ON c.id = h.content_id
    WHERE h.user_id = $uid
    GROUP BY h.content_id
    ORDER BY latest_watched DESC
";
$result = mysqli_query($conn, $sql);
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

$showSearch = false;

include 'includes/header.php';
?>

<main class="main-content">
  <div class="page-header-inner">
    <h1 class="page-title">🕐 Watch History</h1>
    <p class="page-subtitle"><?= count($items) ?> movies watched</p>
  </div>

  <?php if (empty($items)): ?>
    <div class="empty-state">
      <div class="empty-icon">🕐</div>
      <p>No watch history yet. Start watching something!</p>
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
