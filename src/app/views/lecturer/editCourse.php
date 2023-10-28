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
  <link href="/styles/lecturer/crudCourse.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Ubah Mata Kuliah </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/courses/<?=$params['course-id']?>/modules/<?=$params['modul-id']?>/edit" method="POST" enctype="multipart/form-data">
          <section class="course-detail-section">
            <div class="course-detail-wrapper">
              <div class="course-detail-container">
                <label for="kode" class="course-label">Kode</label>
                <input type="text" value="<?=$course['kode']?>" name="kode" id="kode" class="form-input" placeholder="Masukkan Kode Mata Kuliah" readonly>
              </div>

              <div class="course-detail-container">
                <label for="name" class="course-label">Nama</label>
                <input type="text" value="<?=$course['nama']?>" name="name" id="name" class="form-input" placeholder="Masukkan Nama Mata Kuliah" required>
              </div>

              <div class="course-detail-container">
                <label for="deskripsi" class="course-label">Deskripsi</label>
                <input type="text" value="<?=$course['deskripsi']?>" name="deskripsi" id="deskripsi" class="form-input" placeholder="Masukkan Deskripsi Mata Kuliah">
              </div>

              <div class="course-detail-container">
                <label for="kodeProdi" class="course-label">Program Studi</label>
                <?php
                if (isset($errors) && isset($errors['kodeProdi'])) {
                  $class = "form-input error";
                  $error = '<p class="input-error">' . $errors['kodeProdi'] . '</p>';
                } else {
                  $class = "form-input";
                  $error = "";
                }
                ?>
                <input type="text" value="<?=$course['kode_program_studi']?>" name="kodeProdi" id="kodeProdi" class="<?= $class ?>" placeholder="Masukkan Kode Program Studi" required>
                <?= $error ?>
              </div>
            </div>
            <?php unset($_SESSION['errors']); ?>

            <div class="button-form-wrapper">
              <button form="" id="button-batal" onclick="window.location='/courses';return true;">BATAL</button>
              <button type="submit" id="button-simpan">SIMPAN</button>
            </div>
          </section>
        </form>
      </div>
    </main>
  </div>

  <script src="/scripts/lecturer/createCourse.js"></script>
</body>

</html>
