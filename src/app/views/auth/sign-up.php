<!DOCTYPE html>
<html lang="en">

<?php
$user_repo = new PenggunaRepository();
if (isset($_SESSION['post'])); {
  $post = $_SESSION['post'];
}
if (isset($_GET['error'])) {
  $error = $_GET['error'];
}
?>

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
    <form class="form-container" action="/signup" method="POST">
      <h1 class="form-title">Sign Up</h1>

      <div class="form-body-container">
        <div class="form-input-container">
          <label for="name" class="form-label">Nama</label>
          <?php
          if (isset($error) && isset($post) && isset($post['name'])) {
            $name = $post['name'];
            echo "<input value=\"$name\" type=\"text\" name=\"name\" id=\"name\" class=\"form-input\" placeholder=\"Masukkan Nama Lengkap\" required>";
          } else {
            echo '<input type="text" name="name" id="name" class="form-input" placeholder="Masukkan Nama Lengkap" required>';
          }
          ?>
        </div>

        <div class="form-input-container">
          <label for="username" class="form-label">Username</label>
          <?php
          if (isset($post) && isset($post['username'])) {
            $username = $post['username'];
            if (isset($error) && $error === "username") {
              echo "<input value=\"$username\" type=\"text\" name=\"username\" id=\"username\" class=\"form-input error\" placeholder=\"Masukkan Username\" required>";
              echo '<p class="input-error">Username sudah dipakai</p>';
            } else {
              echo "<input value=\"$username\" type=\"text\" name=\"username\" id=\"username\" class=\"form-input\" placeholder=\"Masukkan Username\" required>";
            }
          } else {
            echo '<input type="text" name="username" id="username" class="form-input" placeholder="Masukkan Username" required>';
          }
          ?>
        </div>

        <div class="form-input-container">
          <label for="email" class="form-label">Email</label>
          <?php
          if (isset($post) && isset($post['email'])) {
            $email = $post['email'];
            if (isset($error) && $error === "email" ) {
              echo "<input value=\"$email\" type=\"email\" name=\"email\" id=\"email\" class=\"form-input error\" placeholder=\"Masukkan Email\" required>";
              echo '<p class="input-error">Email sudah dipakai</p>';
            } else {
              echo "<input value=\"$email\" type=\"email\" name=\"email\" id=\"email\" class=\"form-input\" placeholder=\"Masukkan Email\" required>";
            }
          } else {
            echo '<input type="email" name="email" id="email" class="form-input" placeholder="Masukkan Email" required>';
          }
          ?>
        </div>

        <div class="form-input-container">
          <label for="password" class="form-label">Password</label>
          <?php
          if (isset($error) && isset($post) && isset($post['password'])) {
            $password = $post['password'];
            echo "<input value=\"$password\" type=\"password\" name=\"password\" id=\"password\" class=\"form-input\" placeholder=\"Masukkan Password\" required>";
          } else {
            echo '<input type="password" name="password" id="password" class="form-input" placeholder="Masukkan Password" required>';
          }
          ?>
        </div>
      </div>

      <div class="form-footer-container">
        <button type="submit" class="form-submit-button">SIGN UP</button>
        <p class="form-footer-text">Sudah memiliki akun?
          <a href="/signin" class="form-footer-link">Sign In</a>
        </p>
      </div>
    </form>
  </div>
</body>

</html>
