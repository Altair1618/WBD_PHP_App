<?php
$user_repo = new PenggunaRepository();
$user = $user_repo->getPengguna(id: (int) $params['id']);
if (isset($user['gambar_profil'])) {
  $profpic_src = "/assets/uploads/{$user['id']}-{$user['gambar_profil']}";
} else {
  $profpic_src = "/assets/images/Portrait_Placeholder.png";
}
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - Ubah Pengguna</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/admin/add_edit_user.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Ubah Pengguna </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/users/<?= $user['id'] ?>/edit" method="POST" enctype="multipart/form-data">
          <section class="profile-picture-section">
            <div class="profile-picture-box">
              <input type="file" id="profile-picture-input" name="image" accept="image/*">
              <img id="profile-picture" class="profile-picture edit" src="<?= $profpic_src ?>" alt="profile picture" />
              <?php if (isset($errors) && isset($errors['file'])) : ?>
                <p class="input-error image"> <?= $errors['file'] ?> </p>;
              <?php endif ?>
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
                <?php if (isset($errors) && isset($errors['username'])) : ?>
                  <input type="text" value="<?= $user['username'] ?>" name="username" id="username" class="form-input error" placeholder="Masukkan Username" required>
                  <p class="input-error"><?= $errors['username'] ?></p>
                <?php else : ?>
                  <input type="text" value="<?= $user['username'] ?>" name="username" id="username" class="form-input" placeholder="Masukkan Username" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="email" class="profile-label">Email</label>
                <?php if (isset($errors) && isset($errors['email'])) : ?>
                  <input type="email" value="<?= $user['email'] ?>" name="email" id="email" class="form-input error" placeholder="Masukkan Email" required>
                  <p class="input-error"><?= $errors['email'] ?></p>
                <?php else : ?>
                  <input type="email" value="<?= $user['email'] ?>" name="email" id="email" class="form-input" placeholder="Masukkan Email" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="new-password" class="profile-label">Password Baru</label>
                <input type="password" name="new-password" id="new-password" class="form-input" placeholder="Masukkan Password Baru">
              </div>

              <div class="profile-detail-container">
                <p class="profile-label">Tipe:</p>
                <div class="radio-group">
                  <?php if ($user['tipe'] == PENGGUNA_TIPE_PENGAJAR) : ?>
                    <input type="radio" name="tipe" id="radio-dosen" value="dosen" checked />
                  <?php else : ?>
                    <input type="radio" name="tipe" id="radio-dosen" value="dosen" />
                  <?php endif ?>
                  <label for="radio-dosen" class="radio-label">Dosen</label>
                  <?php if ($user['tipe'] == PENGGUNA_TIPE_MAHASISWA) : ?>
                    <input type="radio" name="tipe" id="radio-mahasiswa" value="mahasiswa" checked />
                  <?php else : ?>
                    <input type="radio" name="tipe" id="radio-mahasiswa" value="mahasiswa" />
                  <?php endif ?>
                  <label for="radio-mahasiswa" class="radio-label">Mahasiswa</label>
                </div>
              </div>

              <div class="button-form-wrapper">
                <button form="" id="button-batal" onclick="window.location='/admin/users'">BATAL</button>
                <button type="submit" id="button-simpan">SIMPAN</button>
              </div>
          </section>
        </form>
      </div>
    </main>
  </div>

  <script src="/scripts/admin/add_edit_user.js"></script>
</body>

</html>

<?php
unset($_SESSION['errors']);
?>
