<!DOCTYPE html>
<html lang="en">

<head>
  <title>Pengaturan Profil</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/admin/userDetail.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <main id="body-main-container" class="body-main-container">
      <header class="body-header">
        <p class="page-title"> Pengaturan Profil </p>
      </header>

      <div class="main-flex-container">
        <div class="inner-flex-container">
          <section class="profile-picture-section">
            <div class="profile-picture-box">
              <img class="profile-picture" src="<?= get_img_src($user) ?>" alt="profile picture" />
            </div>
          </section>
          <section class="profile-detail-section">
            <div class="profile-detail-wrapper">
              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Nama</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['nama']) ?>
                  </p>
                </div>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Username</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['username']) ?>
                  </p>
                </div>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Email</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= htmlspecialchars($user['email']) ?>
                  </p>
                </div>
              </div>

              <div class="profile-detail-container">
                <p class="profile-label" id="profile-label-name">Tipe</p>
                <div class="profile-value-container">
                  <p class="profile-value" id="profile-value-name">
                    <?= tipe_to_str($user) ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="button-wrapper">
              <a class="button-link-wrapper" href="/users/<?= $user['id'] ?>/edit">
                <button id="button-ubah">UBAH</button>
              </a>
              <form action="/api/users/<?= $user['id'] ?>/delete" method="POST">
                <button id="button-hapus">HAPUS</button>
              </form>
            </div>
          </section>
        </div>
      </div>
    </main>
  </div>
</body>

</html>

<?php unset($_SESSION['errors']); ?>
