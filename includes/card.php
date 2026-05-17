<?php $inList = in_array($item['id'], $userList);  ?>
<div class="content-card">
  <a href="watch.php?id=<?= $item['id'] ?>" class="card-link">
    <?php if (!empty($item['thumbnail'])): ?>
      <img src="<?= $item['thumbnail'] ?>" alt="<?= $item['title'] ?>" class="card-thumb">
    <?php endif; ?>
    <div class="card-overlay"></div>
  </a>
  <div class="card-body">
    <div class="card-title" title="<?= $item['title'] ?>"><?= $item['title'] ?></div>
    <div class="card-actions">
      <button 
        class="btn-list js-list-btn <?= $inList ? 'added' : '' ?>" 
        data-id="<?= $item['id'] ?>"
        title="<?= $inList ? 'Remove from list' : 'Add to list' ?>"
      ><?= $inList ? '✓' : '+' ?></button>
    </div>
  </div>
</div>