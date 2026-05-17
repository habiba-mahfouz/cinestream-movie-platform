<?php
session_start();
include("database.php");

if (isset($_SESSION['user_id'])) {
    header('Location: movies.php');
    exit;
}
$loginEmailError  = $_GET['loginEmailError'] ?? '';
$loginPassError   = $_GET['loginPassError'] ?? '';
$signupEmailError = $_GET['signupEmailError'] ?? $_GET['emailError'] ?? '';
$signupPassError  = $_GET['signupPassError'] ?? '';
$activeTab        = $_GET['tab'] ?? 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
</head>
<body>

<div class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">CineStream</div>

    <div class="auth-tabs">
      <div class="auth-tab <?= $activeTab==='login'  ? 'active' : '' ?>" data-tab="login">Login</div>
      <div class="auth-tab <?= $activeTab==='signup' ? 'active' : '' ?>" data-tab="signup">Sign Up</div>
    </div>

    <div class="auth-form <?= $activeTab==='login' ? 'active' : '' ?>" id="form-login">

      <form action="registerproc.php" method="POST" id="login-form" novalidate>
        <input type="hidden" name="login" value="1"> 

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" id="login-email" name="email" class="form-input <?= $loginEmailError ? 'field-error-input' : '' ?>" placeholder="you@email.com" autocomplete="email" required>
          <?php if ($loginEmailError): ?>
            <div class="field-error-msg"><?= htmlspecialchars($loginEmailError) ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" id="login-password" name="password" class="form-input <?= $loginPassError ? 'field-error-input' : '' ?>" placeholder="••••••••" autocomplete="current-password" required>
          <?php if ($loginPassError): ?>
            <div class="field-error-msg"><?= htmlspecialchars($loginPassError) ?></div>
          <?php endif; ?>
        </div>
        <button type="submit" class="btn-primary">LOGIN</button>
      </form>
    </div>

    <div class="auth-form <?= $activeTab==='signup' ? 'active' : '' ?>" id="form-signup">

      <form action="registerproc.php" method="POST" id="signup-form" novalidate>
        <input type="hidden" name="register" value="1">

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" id="signup-email" name="email" class="form-input <?= $signupEmailError ? 'field-error-input' : '' ?>" placeholder="you@email.com" autocomplete="email" required>
          <?php if ($signupEmailError): ?>
            <div class="field-error-msg"><?= htmlspecialchars($signupEmailError) ?></div>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label class="form-label">Password</label>
          <input type="password" id="signup-password" name="password" class="form-input <?= $signupPassError ? 'field-error-input' : '' ?>" placeholder="••••••••" autocomplete="new-password" required>
          <?php if ($signupPassError): ?>
            <div class="field-error-msg"><?= htmlspecialchars($signupPassError) ?></div>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-primary">CREATE ACCOUNT</button>
      </form>
    </div>

    <form action="movies.php" method="GET">
      <button type="submit" class="btn-guest">Continue as Guest</button>
    </form>
  </div>
</div>

<script src="js/main.js"></script>
</body>
</html>
