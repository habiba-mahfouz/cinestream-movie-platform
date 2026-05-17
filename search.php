<?php
session_start();
include("database.php");

$query = trim($_GET['q'] ?? '');

$results = [];
if ($query) {
    $sql = "SELECT * FROM content WHERE title LIKE '%$query%' OR genre LIKE '%$query%' ORDER BY type, title";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $results[] = $row;
    }
}

include 'includes/header.php';
?>

<main class="main-content">

  <?php if (empty($results)): ?>

    <div class="empty-state">
      <div class="empty-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </div>
      <?php if (!$query): ?>
        <p class="empty-text-main">Search for movies </p>
        <p class="empty-text-sub">Discover your next favorite title</p>
      <?php else: ?>
        <p class="empty-text-main">No results found for "<strong><?= $query ?></strong>"</p>
        <p class="empty-text-sub">Try a different keyword or browse our categories.</p>
      <?php endif; ?>
    </div>
  <?php else: ?>

    <div class="cards-grid">
      <?php foreach ($results as $item): ?>
        <?php include 'includes/card.php'; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>

<?php mysqli_close($conn); ?>
