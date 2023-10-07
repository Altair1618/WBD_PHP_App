<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LearnIt!</title>

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/course/courseDetail.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <div class="page-body-container">
      <a class="back-button" href="/courses">
        <div class="back-button-image">
          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="10" viewBox="0 0 12 10" fill="none">
            <path d="M0.244045 4.41169C-0.0813484 4.73708 -0.0813484 5.26552 0.244045 5.59091L4.40908 9.75595C4.73448 10.0813 5.26292 10.0813 5.58831 9.75595C5.91371 9.43056 5.91371 8.90212 5.58831 8.57673L2.84199 5.83301H10.8285C11.2892 5.83301 11.6615 5.46076 11.6615 5C11.6615 4.53924 11.2892 4.16699 10.8285 4.16699H2.84459L5.58571 1.42327C5.9111 1.09788 5.9111 0.569439 5.58571 0.244045C5.26031 -0.0813484 4.73188 -0.0813484 4.40648 0.244045L0.241442 4.40908L0.244045 4.41169Z" fill="black"/>
          </svg>
        </div>
  
        <p class="back-button-text">
          Kembali
        </p>
      </a>

      <div class="main-body">
        <div class="main-body-header">
          <p class="main-body-title">
            <?=$params['course']['kode'] . " - " . $params['course']['nama']; ?>
          </p>

          <p class="main-body-subtitle">
            <?="Pengajar: " . $params['pengajar']; ?>
            <br>

            <?php if (isset($params['course']['deskripsi']) && $params['course']['deskripsi'] != null): ?>
              <?="Deskripsi: " . $params['course']['deskripsi']; ?>
            <?php endif; ?>
          </p>
        </div>

        <div class="main-body-content">
          <?php foreach($params['modules'] as $modul): ?>
            <div class="module-container">
              <div class="module-header">
                <p class="module-name"><?=$modul['nama']; ?></p>
                
                <?php if (isset($modul['deskripsi']) && $modul['deskripsi'] != null): ?>
                  <p class="module-description"><?=$modul['deskripsi']; ?></p>
                <?php endif; ?>
              </div>
  
              <div class="module-buttons">
                <a href="/modules/<?=$modul['id']; ?>" class="module-detail-button">
                  LIHAT
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>