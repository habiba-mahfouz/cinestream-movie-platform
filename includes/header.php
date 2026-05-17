<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$showSearch  = $showSearch  ?? true;
$showHome    = $showHome    ?? (basename($_SERVER['PHP_SELF']) !== 'movies.php');
$showTheme   = $showTheme   ?? (basename($_SERVER['PHP_SELF']) !== 'search.php');
$showProfile = $showProfile ?? (basename($_SERVER['PHP_SELF']) !== 'search.php');


$user = null;
if (isset($_SESSION['user_id'])) {
    $uid  = intval($_SESSION['user_id']);
    $sql  = "SELECT * FROM users WHERE id = $uid";
    $res  = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineStream</title>
  <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎬</text></svg>">
</head>
<body>


<header class="header">
  
  <div class="header-left">
    <?php if ($showHome): ?>
    <a href="movies.php" class="home-btn" title="Home" style="color: var(--text-secondary);">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
    </a>
    <?php endif; ?>

    
  </div>

  <div class="header-center">
    <?php if ($showSearch): ?>
    <form class="search-form" action="search.php" method="GET">
      <span class="search-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
      </span>
      <input
        type="text"
        name="q"
        id="main-search"
        class="search-input js-live-search"
        placeholder="Search for movies..."
        value="<?= $_GET['q'] ?? '' ?>"
        autocomplete="off"
      >
    </form>
    <?php endif; ?>
  </div>

  <div class="header-right">

  <?php if ($showTheme): ?>
    <button class="theme-toggle js-theme-toggle" id="theme-toggle" title="Toggle theme">
      <span class="default-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
      </span>
    </button>
    <?php endif; ?>

    <?php if ($showProfile): ?>
    <div class="profile-wrapper">
      <?php if ($user): ?>
        <button class="profile-btn js-profile-btn" title="Profile">
          <span class="default-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </span>
        </button>

        <div class="profile-dropdown" id="profile-dropdown">
          <div class="dropdown-user">
            <div class="dropdown-avatar">
              <span class="default-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              </span>
            </div>
            <div class="dropdown-user-info">
              <span><?= $user['email'] ?></span>
            </div>
          </div>
          <div class="dropdown-links">
            <a href="mylist.php" class="dropdown-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-svg-icon"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
              My List
            </a>
            <a href="history.php" class="dropdown-link">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-svg-icon"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              History
            </a>
            <a href="registerproc.php?action=logout" class="dropdown-link logout">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dropdown-svg-icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
              Logout
            </a>
          </div>
        </div>
      <?php else: ?>
        <a href="register.php" class="profile-btn" title="Login / Sign Up">
          <span class="default-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </span>
        </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
</header>
