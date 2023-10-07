<!DOCTYPE html>
<html lang="en">

<head>
  <title>LearnIt!</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/course/courseCatalog.css" rel="stylesheet">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <div class="body-header">
      <p class="page-title"> Katalog Mata Kuliah </p>

      <div class="search-bar">
        <input type="text" id="search-input" class="search-input" placeholder="Ketikkan kode/nama mata kuliah">

        <button type="submit" id="search-button" class="search-button" >
          <img class="search-button" src="/assets/icons/Search_Button.svg" alt="search">
        </button>
      </div>

      <div class="filter-sort-bar">
        <div class="filter-bar">
          <label class="selector-label" for="fakultas-selector">Fakultas:</label>
          <select id="fakultas-selector" class="selector">
            <option value="all"></option>
            <?php foreach ($params['fakultas'] as $fakultas): ?>
              <option value="<?=$fakultas['kode']; ?>"><?=$fakultas['kode']; ?></option>
            <?php endforeach; ?>
          </select>
          
          <label class="selector-label" for="prodi-selector">Prodi:</label>
          <select id="prodi-selector" class="selector">
            <option value="all"></option>
            <?php foreach ($params['program_studi'] as $program_studi): ?>
              <option value="<?=$program_studi['kode']; ?>"><?=$program_studi['kode'] . ' - ' . $program_studi['nama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="sort-bar">
          <label class="selector-label" for="sort-selector">Urut Berdasarkan:</label>
          <select id="sort-selector" class="selector">
            <option value="nama">Nama</option>
            <option value="kode">Kode</option>
          </select>
          
          <label class="selector-label" for="order-selector">Mode Urutan:</label>
          <select id="order-selector" class="selector">
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
          </select>
        </div>
      </div>
    </div>

    <div id="body-main-container" class="body-main-container">
      <?php
        $controller = new CourseController();
        $controller->getCatalogHTML($params);
      ?>
    </div>
  </div>

  <script src="/scripts/course/courseCatalog.js"></script>
</body>

</html>
