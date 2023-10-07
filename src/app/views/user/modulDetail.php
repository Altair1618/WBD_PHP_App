<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LearnIt!</title>
  
  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/modul/modulDetail.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <div class="page-body-container">
      <a class="back-button" href="/courses/<?=$params['course-id']; ?>">
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
          <p class="main-body-header-text">
            <?=$params['course']['kode']; ?> - <?=$params['course']['nama']; ?> <br>
            Pengajar: <?=$params['pengajar']; ?>
          </p>
        </div>

        <div class="main-body-content">
          <p class="main-body-title"><?=$params['modul']['nama']; ?></p>

          <?php if (isset($params['materi_kelas']) && $params['materi_kelas'] != null): ?>
            <?php foreach ($params['materi_kelas'] as $materi): ?>
              <div class="materi-container">
                <div class="accordion-button">
                  <p class="materi-name">
                    <?=$materi['judul_topik']; ?>
                  </p>
                  <svg class="accordion-arrow" width="49" height="26" viewBox="0 0 49 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24.1831 15.3169C24.4272 15.561 24.8236 15.561 25.0677 15.3169L28.8169 11.5677C29.061 11.3236 29.061 10.9272 28.8169 10.6831C28.5728 10.439 28.1764 10.439 27.9323 10.6831L24.6244 13.991L21.3164 10.685C21.0723 10.4409 20.6759 10.4409 20.4318 10.685C20.1878 10.9291 20.1878 11.3255 20.4318 11.5696L24.1811 15.3189L24.1831 15.3169Z" fill="black"/>
                  </svg>
                </div>

                <div class="accordion-content">
                  <video class="materi" controls>
                    <source src="/assets/videos/materi/<?=$materi['nama_file']; ?>" type="video/mp4">
                  </video>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="main-body-subtitle">Belum Ada Materi Untuk Modul Ini.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script src="/scripts/modul/modulDetail.js"></script>
</body>
</html>