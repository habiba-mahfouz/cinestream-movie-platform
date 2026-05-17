<?php

session_start();
include("database.php");

$sections = [
    'Animation' => "SELECT * FROM content WHERE genre='Animation' AND type='movie' LIMIT 10",
    'Comedy'    => "SELECT * FROM content WHERE genre='Comedy' AND type='movie' LIMIT 10",
    'Drama'     => "SELECT * FROM content WHERE genre='Drama' AND type='movie' LIMIT 10",
    'Action'    => "SELECT * FROM content WHERE genre='Action' AND type='movie' LIMIT 10"
];

include 'includes/header.php';
?>

  <section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="hero-title">CineStream</h1>
      <div class="hero-meta">
        <span class="hero-date"><?= date('l, F j, Y | g:i A') ?></span>
      </div>
      <p class="hero-description">
        Sit back, relax, and enjoy unlimited movies.
      </p>
    </div>
  </section>

<main class="main-content">

  <?php foreach ($sections as $genre => $sql): 
    $items_res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($items_res) > 0):
  ?>
    <section class="content-section" id="<?= strtolower(str_replace(' ','-', $genre)) ?>">
      <h2 class="section-title"><?= $genre ?></h2>
      <div class="cards-row">
        <?php while ($item = mysqli_fetch_assoc($items_res)): ?>
          <?php include 'includes/card.php'; ?>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endif; endforeach; ?>

</main>

<?php include 'includes/footer.php'; ?>

<?php $conn->close(); ?>
