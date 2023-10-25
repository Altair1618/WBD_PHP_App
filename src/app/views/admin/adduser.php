<?php
if (isset($_SESSION['errors']) && isset($_SESSION['post'])) {
  $errors = $_SESSION['errors'];
  $post = $_SESSION['post'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - Tambah Pengguna</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/admin/form.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Tambah Pengguna </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/users/create" method="POST" enctype="multipart/form-data">
          <section class="profile-picture-section">
            <div class="profile-picture-box">
              <input type="file" id="profile-picture-input" name="image" accept="image/*">
              <img id="profile-picture" class="profile-picture edit" src="/assets/images/Portrait_Placeholder.png" alt="profile picture" />
              <?php if (isset($errors) && isset($errors['file'])) : ?>
                <p class="input-error image"> <?= $errors['file'] ?> </p>;
              <?php endif ?>
            </div>
          </section>
          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">
              <div class="profile-detail-container">
                <label for="name" class="profile-label">Nama</label>
                <?php if (isset($errors)) : ?>
                  <input type="text" value="<?= $post['name'] ?>" name="name" id="name" class="form-input" placeholder="Masukkan Nama Lengkap" required>
                <?php else : ?>
                  <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan Nama Lengkap" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="username" class="profile-label">Username</label>
                <?php if (isset($errors) && isset($errors['username'])) : ?>
                  <input type="text" value="<?= $post['username'] ?>" name="username" id="username" class="form-input error" placeholder="Masukkan Username" required>
                  <p class="input-error"><?= $errors['username'] ?></p>
                <?php else : ?>
                  <input type="text" name="username" id="username" class="form-input" placeholder="Masukkan Username" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="email" class="profile-label">Email</label>
                <?php if (isset($errors) && isset($errors['email'])) : ?>
                  <input type="email" value="<?= $post['email'] ?>" name="email" id="email" class="form-input error" placeholder="Masukkan Email" required>
                  <p class="input-error"><?= $errors['email'] ?></p>
                <?php else : ?>
                  <input type="email" name="email" id="email" class="form-input" placeholder="Masukkan Email" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="password" class="profile-label">Password</label>
                <?php if (isset($errors) && isset($errors['password'])) : ?>
                  <input type="password" name="password" id="password" class="form-input error" placeholder="Masukkan Password" required>
                  <p class="input-error"><?= $errors['password'] ?></p>
                <?php else : ?>
                  <input type="password" name="password" id="password" class="form-input" placeholder="Masukkan Password">
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label">Tipe:</p>
                <div class="radio-group">
                  <input type="radio" name="tipe" id="radio-dosen" value="dosen" checked />
                  <label for="radio-dosen" class="radio-label">Dosen</label>
                  <input type="radio" name="tipe" id="radio-mahasiswa" value="mahasiswa" />
                  <label for="radio-mahasiswa" class="radio-label">Mahasiswa</label>
                </div>
              </div>

              <div class="button-form-wrapper">
                <a class="button-link-wrapper" href="/users">
                  <button form="" id="button-batal">BATAL</button>
                </a>
                <button type="submit" id="button-simpan">SIMPAN</button>
              </div>
          </section>
        </form>
      </div>
    </main>
  </div>

  <script src="/scripts/admin/form.js"></script>
</body>

</html>

<?php
unset($_SESSION['errors']);
?>
