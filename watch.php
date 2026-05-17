<?php
include 'includes/watch_data.php';
include 'includes/header.php';
?>

<main class="main-content">
  <div class="watch-container">

    <div class="video-player-wrapper">
      <video class="video-player" controls autoplay>
        <source src="<?= $item['video_path'] ?>" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

    <div class="watch-info">
      <h1 class="watch-title"><?= $item['title'] ?></h1>
      <div class="watch-meta">
        <span>📅 <?= $item['release_year'] ?></span>
        <span>🎭 <?= $item['genre'] ?></span>
        <span>📂 <?= ucfirst($item['type']) ?></span>
      </div>
      <p class="watch-desc"><?= $item['description'] ?></p>
    </div>

    <div class="watch-divider">
      <button
        class="btn-list btn-list-large js-list-btn <?= $inList ? 'added' : '' ?>"
        data-id="<?= $item['id'] ?>"
        data-type="large"
      >
        <?= $inList ? '✓ In My List' : '+ Add to My List' ?>
      </button>
    </div>

    <?php if (!empty($relatedItems)): ?>
    <div class="related-section">
      <h2 class="related-title">You Might Also Like</h2>
      <div class="cards-grid">
        <?php foreach ($relatedItems as $item): ?>
          <?php include 'includes/card.php'; ?>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>

  </div>
</main>

<?php include 'includes/footer.php'; ?>

<?php mysqli_close($conn); ?>