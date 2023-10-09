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
  <link href="/styles/lecturer/crudMateri.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Tambah Materi </p>
      </header>

      <div class="main-flex-container">
        <form class="form-container" action="/api/materi/<?=$params['materi-id']?>/edit" method="POST" enctype="multipart/form-data">
          <section class="materi-detail-section">
            <div class="materi-detail-wrapper">
                <div class="materi-detail-container">
                <label for="id" class="materi-label">Id</label>
                <input type="text" value="<?=$params['materi-id']?>" name="id" id="id" class="form-input" readonly>
              </div>

              <div class="materi-detail-container">
                <label for="idModul" class="materi-label">Id Modul</label>
                <input type="text" value="<?=$params['modul-id']?>" name="idModul" id="idModul" class="form-input" readonly>
              </div>

              <div class="materi-detail-container">
                <label for="judulTopik" class="materi-label">Judul Topik</label>
                <input type="text" value="<?=$materi['judul_topik']?>" name="judulTopik" id="judulTopik" class="form-input" placeholder="Masukkan Judul Topik Materi" required>
              </div>

              <div class="materi-detail-container">
                <label for="video" class="materi-label">File Materi</label>
                <?php
                  if (isset($errors) && isset($errors['video'])) {
                    $class = "form-input error";
                    $error = '<p class="input-error">' . $errors['video'] . '</p>';
                  } else {
                    $class = "form-input";
                    $error = "";
                  }
                ?>
                <input type="file" name="video" id="video" accept="video/*" class="form-input">
                <?=$error?>
              </div>
            </div>

            <?php unset($_SESSION['errors']); ?>

            <div class="button-form-wrapper">
              <button form="" id="button-batal" onclick='window.location="/courses/<?=$params["course-id"]?>/modules/<?=$params["modul-id"]?>";return true;''>BATAL</button>
              <button type="submit" id="button-simpan">SIMPAN</button>
            </div>
          </section>
        </form>
      </div>
    </main>
  </div>
</body>

</html>
