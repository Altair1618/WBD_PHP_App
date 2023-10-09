<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt! - Fakultas Manager</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/admin/fakultas.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>
  <div class="body-container">
    <div class="content-container">
      <p class="page-header">Administrasi Fakultas</p>
      <main class="main-container">
        <section class="section-control">
          <h1 class="control-header">Daftar Fakultas</h1>
          <div class="filter-sort-selector">
            <label for="sort" class="selector-label">Urutkan</label>
            <select class="selector" name="sort" id="sort">
              <option value="kode">Kode</option>
              <option value="nama">Nama</option>
              <option value="created_at">Waktu Dibuat</option>
              <option value="updated_at">Waktu Diubah</option>
            </select>
            <select class="selector" name="sort-order" id="sort-order">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>
            <div class="search-bar" id="search-bar">
              <input type="text" class="search-bar-input" id="search-bar-input" placeholder="Masukkan kode atau nama">
              <button class="search-button" id="search-button" aria-label="search button">
                <img src="/assets/icons/Search_Button.svg" alt="search button" class="search-button-icon" id="search-button-icon">
              </button>
            </div>
          </div>
        </section>
        <section class="section-table" id="table">
          <?php
          require_once CONTROLLERS_DIR . 'AdminFakultasController.php';
          $controller = new AdminFakultasController();
          $controller->getFakultasHTML($params);
          ?>
        </section>
      </main>
    </div>
    <script src="/scripts/admin/fakultas.js"></script>
</body>

</html>
