<?php
if (isset($_SESSION['post'])) {
  $post = $_SESSION['post'];
}
if (isset($_GET['error'])) {
  $error = $_GET['error'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt!</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/auth/auth.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <h1 class="app-title">LearnIt!</h1>

  <div class="form-wrapper">
    <form class="form-container" action="/signin" method="POST">
      <h1 class="form-title">Sign In</h1>

      <div class="form-body-container">
        <div class="form-input-container">
          <label for="credentials" class="form-label">Username/Email</label>
          <?php
          if (isset($error) && isset($post) && isset($post['credentials'])) {
            echo "<input value=\"{$post['credentials']}\"type=\"text\" name=\"credentials\" id=\"credentials\" class=\"form-input error\" placeholder=\"Masukkan Username atau Email\" required>";
          } else {
            echo '<input type="text" name="credentials" id="credentials" class="form-input" placeholder="Masukkan Username atau Email" required>';
          }
          ?>
        </div>

        <div class="form-input-container">
          <label for="password" class="form-label">Password</label>
          <?php
          if (isset($error) && isset($post) && isset($post['password'])) {
            echo "<input value=\"{$post['password']}\"type=\"password\" name=\"password\" id=\"password\" class=\"form-input error\" placeholder=\"Masukkan Password\" required>";
            echo '<p class="input-error">Username, email, atau password salah</p>';
          } else {
            echo '<input type="password" name="password" id="password" class="form-input" placeholder="Masukkan Password" required>';
          }
          ?>
        </div>
      </div>

      <div class="form-footer-container">
        <button type="submit" class="form-submit-button">SIGN IN</button>
        <p class="form-footer-text">Belum memiliki akun?
          <a href="/signup" class="form-footer-link">Sign Up</a>
        </p>
    </form>
  </div>

</body>

</html>
