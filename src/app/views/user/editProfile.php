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
        <form class="form-container" action="/profile/edit" method="POST" enctype="multipart/form-data">
          <section class="profile-picture-section">
            <div class="profile-picture-box">
              <input type="file" id="profile-picture-input" name="image" accept="image/*">
              <img id="profile-picture" class="profile-picture edit" src="<?= $profpic_src ?>" alt="profile picture" />
            </div>
          </section>
          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">
              <div class="profile-detail-container">
                <label for="name" class="profile-label">Nama</label>
                <input type="text" value="<?= $user['nama'] ?>" name="name" id="name" class="form-input" placeholder="Masukkan Nama Lengkap" required>
              </div>

              <div class="profile-detail-container">
                <label for="username" class="profile-label">Username</label>
                <input type="text" value="<?= $user['username'] ?>" name="username" id="username" class="form-input" placeholder="Masukkan Username" required>
              </div>

              <div class="profile-detail-container">
                <label for="email" class="profile-label">Email</label>
                <input type="email" value="<?= $user['email'] ?>" name="email" id="email" class="form-input" placeholder="Masukkan Email" required>
              </div>

              <div class="profile-detail-container">
                <label for="old-password" class="profile-label">Password Lama</label>
                <input type="password" name="old-password" id="old-password" class="form-input" placeholder="Masukkan Password Lama">
              </div>

              <div class="profile-detail-container">
                <label for="new-password" class="profile-label">Password Baru</label>
                <input type="password" name="new-password" id="new-password" class="form-input" placeholder="Masukkan Password Baru">
              </div>
            </div>

            <div class="button-form-wrapper">
              <button form="" id="button-batal" onclick="window.location='/profile';return true;">BATAL</button>
              <button type="submit" id="button-simpan">SIMPAN</button>
            </div>
          </section>
        </form>
      </div>
    </main>
  </div>

  <script src="/scripts/user/editProfile.js"></script>
</body>

</html>
