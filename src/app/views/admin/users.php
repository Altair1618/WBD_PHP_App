<?php
$user_repo = new PenggunaRepository();
$users = $user_repo->getPenggunaList();

function is_admin($user)
{
  return $user['tipe'] == PENGGUNA_TIPE_ADMIN;
}

function get_img_src($user)
{
  if (isset($user['gambar_profil'])) {
    return '/assets/uploads/' . $user['id'] . '-' . $user['gambar_profil'];
  } else {
    return '/assets/images/Portrait_Placeholder.png';
  }
}

function tipe_to_str($user)
{
  return ['Admin', 'Dosen', 'Mahasiswa'][$user['tipe']];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - User Manager</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/admin/users.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>
  <div class="body-container">
    <div class="content-container">
      <p class="page-header">Administrasi Pengguna</p>
      <main class="main-container">
        <section class="section-control">
          <h1 class="control-header">Daftar Pengguna</h1>
          <div class="filter-sort-selector">
            <label for="filter" class="selector-label">Filter:</label>
            <select class="selector" name="filter" id="filter">
              <option value="0"></option>
              <option value="1">Dosen</option>
              <option value="2">Mahasiswa</option>
            </select>
            <label for="sort" class="selector-label">Urutkan</label>
            <select class="selector" name="sort" id="sort">
              <option value="0"></option>
              <option value="1">Nama</option>
              <option value="2">Username</option>
              <option value="3">Waktu Dibuat</option>
              <option value="4">Waktu Diubah</option>
            </select>
            <select class="selector" name="sort-order" id="sort-order">
              <option value="0">A-Z</option>
              <option value="1">Z-A</option>
            </select>
            <div class="search-bar" id="search-bar">
              <input type="text" class="search-bar-input" id="search-bar-input" placeholder="Masukkan nama atau username">
              <div class="icon-container">
                <img src="/assets/icons/Search_Button.svg" class="search-button-icon" id="search-button-icon">
              </div>
            </div>
          </div>
        </section>
        <section class="section-table">
          <?php
          require_once CONTROLLERS_DIR . 'AdminUserController.php';
          $controller = new AdminUserController();
          $controller->getUsersHTML($params);
          ?>
        </section>
      </main>
    </div>
</body>

</html>
