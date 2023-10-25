<?php
if (isset($_SESSION['errors']) && isset($_SESSION['post'])) {
  $errors = $_SESSION['errors'];
  $post = $_SESSION['post'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - Tambah Fakultas</title>
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
        <p class="page-title"> Tambah Fakultas </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/fakultas/create" method="POST" enctype="multipart/form-data">

          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">

              <div class="profile-detail-container">
                <label for="kode" class="profile-label">Kode Fakultas</label>
                <?php if (isset($errors)) : ?>
                  <input type="text" value="<?= $post['kode'] ?>" name="kode" id="kode" class="form-input error" placeholder="Masukkan Kode Fakultas" required>
                  <p class="input-error"><?= $errors['kode'] ?></p>
                <?php else : ?>
                  <input type="text" name="kode" id="kode" class="form-input" placeholder="Masukkan Kode Fakultas" required>
                <?php endif ?>
              </div>

              <div class="profile-detail-container">
                <label for="name" class="profile-label">Nama</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Masukkan Nama Fakultas" required>
              </div>

              <div class="button-form-wrapper">
                <a class="button-link-wrapper" href="/admin/fakultas">
                  <button form="" id="button-batal">BATAL</button>
                </a>
                <button type="submit" id="button-simpan">SIMPAN</button>
              </div>
          </section>
        </form>
      </div>
    </main>
  </div>
</body>

</html>

<?php
unset($_SESSION['errors']);
?>
