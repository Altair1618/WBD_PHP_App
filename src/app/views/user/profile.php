<?php
assert(isset($_SESSION['user']));
$user = $_SESSION['user'];
if (isset($user['gambar_profil'])) {
  $profpic_src = "/assets/uploads/{$user['id']}-{$user['gambar_profil']}";
  if (!file_exists("/var/www/html" . $profpic_src)) {
    $profpic_src = "/assets/images/Portrait_Placeholder.png";
  }
} else {
  $profpic_src = "/assets/images/Portrait_Placeholder.png";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/user/profile.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Pengaturan Profil </p>
      </header>

      <div class="main-flex-container">
        <div class="inner-flex-container">
          <section class="profile-picture-section">
            <div class="profile-picture-box">
              <?=
              "<img class=\"profile-picture\" src=\"$profpic_src\" alt=\"profile picture\" />"
              ?>
            </div>
          </section>
          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">
              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Nama</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['nama']) ?>
                  </p>
                </div>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Username</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['username']) ?>
                  </p>
                </div>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Email</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['email']) ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="button-wrapper">
              <button onclick="window.location='/profile/edit'" id="button-ubah">UBAH</a>
            </div>
          </section>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
