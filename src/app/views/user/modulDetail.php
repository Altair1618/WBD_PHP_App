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
            Pengajar: <?=$params['pengajar']['nama']; ?>
          </p>
        </div>

        <div class="main-body-content">
          <div class="main-body-title-container">
            <p class="main-body-title"><?=$params['modul']['nama']; ?></p>

            <?php if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR): ?>
              <a href="/courses/<?=$params['course-id'];?>/modules/<?=$params['modul-id']?>/create" class="create-materi-button">
                BUAT MATERI
              </a>
            <?php endif; ?>
          </div>

          <?php if (isset($params['materi_kelas']) && $params['materi_kelas'] != null): ?>
            <?php foreach ($params['materi_kelas'] as $materi): ?>
              <div class="materi-container">
                <div class="accordion-button">
                  <p class="materi-name">
                    <?=$materi['judul_topik']; ?>
                  </p>

                  <div class="accordion-subbuttons">
                    <?php if ($_SESSION['user']['tipe'] == PENGGUNA_TIPE_PENGAJAR): ?>
                      <a aria-label='module-edit-button' href="/courses/<?=$params['course-id'];?>/modules/<?=$params['modul-id'];?>/<?=$materi['id']?>/edit">
                        <svg width='16' height='15' viewBox='0 0 16 15' fill='none' xmlns='http://www.w3.org/2000/svg'>
                          <path d='M14.3977 0.48621C13.7495 -0.16207 12.7015 -0.16207 12.0533 0.48621L11.1623 1.37427L14.0603 4.27229L14.9513 3.38127C15.5996 2.73299 15.5996 1.68509 14.9513 1.0368L14.3977 0.48621ZM5.54086 6.99862C5.36029 7.17919 5.22116 7.4012 5.14123 7.6469L4.26502 10.2755C4.17917 10.5301 4.24726 10.8113 4.43671 11.0037C4.62616 11.1962 4.90738 11.2613 5.16492 11.1754L7.79356 10.2992C8.0363 10.2193 8.25831 10.0802 8.44184 9.8996L13.3942 4.94425L10.4933 2.04327L5.54086 6.99862ZM3.27928 1.73837C1.71038 1.73837 0.4375 3.01125 0.4375 4.58015V12.1582C0.4375 13.7271 1.71038 15 3.27928 15H10.8574C12.4263 15 13.6991 13.7271 13.6991 12.1582V9.31644C13.6991 8.79249 13.2758 8.36918 12.7519 8.36918C12.2279 8.36918 11.8046 8.79249 11.8046 9.31644V12.1582C11.8046 12.6822 11.3813 13.1055 10.8574 13.1055H3.27928C2.75533 13.1055 2.33202 12.6822 2.33202 12.1582V4.58015C2.33202 4.05619 2.75533 3.63289 3.27928 3.63289H6.12106C6.64501 3.63289 7.06832 3.20958 7.06832 2.68563C7.06832 2.16168 6.64501 1.73837 6.12106 1.73837H3.27928Z' fill='black'/>
                        </svg>
                      </a>
    
                      <form class='delete-button-wrapper' action="/api/materi/<?=$materi['id'];?>/delete?kode=<?=$params['course-id'];?>&modul-id=<?=$params['modul-id']?>" method='POST'>
                        <button aria-label='module-delete-button' type='submit'>
                          <svg width='14' height='15' viewBox='0 0 14 15' fill='none' xmlns='http://www.w3.org/2000/svg'>
                            <g clip-path='url(#clip0_155_780)'>
                              <path d='M4.39844 0.518555L4.1875 0.9375H1.375C0.856445 0.9375 0.4375 1.35645 0.4375 1.875C0.4375 2.39355 0.856445 2.8125 1.375 2.8125H12.625C13.1436 2.8125 13.5625 2.39355 13.5625 1.875C13.5625 1.35645 13.1436 0.9375 12.625 0.9375H9.8125L9.60156 0.518555C9.44336 0.199219 9.11816 0 8.76367 0H5.23633C4.88184 0 4.55664 0.199219 4.39844 0.518555ZM12.625 3.75H1.375L1.99609 13.6816C2.04297 14.4229 2.6582 15 3.39941 15H10.6006C11.3418 15 11.957 14.4229 12.0039 13.6816L12.625 3.75Z' fill='black'/>
                            </g>
    
                            <defs>
                              <clipPath id='clip0_155_780'>
                                <rect width='13.125' height='15' fill='white' transform='translate(0.4375)'/>
                              </clipPath>
                            </defs>
                          </svg>
                        </button>
                      </form>
                    <?php endif; ?>
    
                    <svg class="accordion-arrow" width="49" height="26" viewBox="0 0 49 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M24.1831 15.3169C24.4272 15.561 24.8236 15.561 25.0677 15.3169L28.8169 11.5677C29.061 11.3236 29.061 10.9272 28.8169 10.6831C28.5728 10.439 28.1764 10.439 27.9323 10.6831L24.6244 13.991L21.3164 10.685C21.0723 10.4409 20.6759 10.4409 20.4318 10.685C20.1878 10.9291 20.1878 11.3255 20.4318 11.5696L24.1811 15.3189L24.1831 15.3169Z" fill="black"/>
                    </svg>
                  </div>
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