<?php
  if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt!</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/lecturer/crudModul.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Ubah Modul </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/modules/<?=$params['modul-id']?>/edit" method="POST" enctype="multipart/form-data">
          <section class="modul-detail-section">
            <div class="modul-detail-wrapper">
              <div class="modul-detail-container">
                <label for="id" class="modul-label">Id Modul</label>
                <input type="text" value="<?=$modul['id']?>" name="id" id="id" class="form-input" readonly>
              </div>
              <div class="modul-detail-container">
                <label for="kode" class="modul-label">Kode Mata Kuliah</label>
                <input type="text" value="<?=$modul['kode_mata_kuliah']?>" name="kode" id="kode" class="form-input" readonly>
              </div>

              <div class="modul-detail-container">
                <label for="name" class="modul-label">Nama</label>
                <input type="text" value="<?=$modul['nama']?>" name="name" id="name" class="form-input" placeholder="Masukkan Nama Modul" required>
              </div>

              <div class="modul-detail-container">
                <label for="deskripsi" class="modul-label">Deskripsi</label>
                <input type="text" value="<?=$modul['deskripsi']?>" name="deskripsi" id="deskripsi" class="form-input" placeholder="Masukkan Deskripsi Modul">
              </div>
            </div>

            <div class="button-form-wrapper">
              <button form="" id="button-batal" onclick='window.location="/courses/<?=$params["course-id"]?>";return true;''>BATAL</button>
              <button type="submit" id="button-simpan">SIMPAN</button>
            </div>
          </section>
        </form>
      </div>
    </main>
  </div>

  <script src="/scripts/lecturer/createmodul.js"></script>
</body>

</html>
