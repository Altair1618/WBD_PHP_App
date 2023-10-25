<?php
$repo = new FakultasRepository();
$fakul = $repo->getFakultas($params['kode']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - Ubah Fakultas</title>
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
        <p class="page-title"> Ubah Fakultas </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/fakultas/<?= $fakul['kode'] ?>/edit" method="POST" enctype="multipart/form-data">

          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">

              <div class="profile-detail-container">
                <label for="kode" class="profile-label">kode</label>
                <input type="text" value="<?= $fakul['kode'] ?>" name="kode" id="kode" class="form-input" disabled>
              </div>

              <div class="profile-detail-container">
                <label for="name" class="profile-label">Nama</label>
                <input type="text" value="<?= $fakul['nama'] ?>" name="name" id="name" class="form-input" placeholder="Masukkan Nama Fakultas" required>
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
