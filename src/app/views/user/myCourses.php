<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/styles/global.css" rel="stylesheet">
  <link href="/styles/navbar/navbar.css" rel="stylesheet">
  <link href="/styles/course/myCourses.css" rel="stylesheet">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php require_once COMPONENTS_DIR . 'navbar.php'; ?>

  <div class="body-container">
    <div class="body-header">
      <p class="page-title"> Mata Kuliah Saya </p>

      <div class="search-bar">
        <input type="text" class="search-input" placeholder="Ketikkan kode/nama mata kuliah">

        <button type="submit" class="search-button" >
          <img class="search-button" src="/assets/icons/Search_Button.svg" alt="search">
        </button>
      </div>
    </div>

    <?php if (!isset($params['courses']) || count($params['courses']) == 0): ?>
      <p class='empty-message'> Anda belum mengambil mata kuliah apapun </p>
    <?php else: ?>
      <div class="body-main">
        <?php
          foreach ($params['courses'] as $course) {
            if (!isset($course['image'])) {
              $course['image'] = '/assets/images/Course_Default.svg';
            }
            
            echo "
            <div class='course-card'>
              <img class='course-image' src='{$course['image']}' alt='course-image'>

              <div class='course-info'>
                <p class='course-code'> {$course['kode']} </p>
                <p class='course-name'> {$course['nama']} </p>
                <p class='course-lecturer'> {$course['pengajar']} </p>
                
                <div class='course-button-container'>
                  <a class='course-detail-button' href='/courses/{$course['kode']}'>Lihat</a>
                </div>
              </div>
            </div>
            ";
          }
        ?>
      </div>
      
      <div class="body-footer">
        <?php if ($params['page'] > 1) {
          $target = $params['page'] - 1;
          echo "<a class='page-button' href='/courses?page={$target}'>
            PREV
          </a>";
        } ?>

        <a class='current-page-button' href='#'>
          <?=$params['page']?>
        </a>

        <?php if ($params['page'] < $params['page_count']) {
          $target = $params['page'] + 1;
          echo "<a class='page-button' href='/courses?page={$target}'>
          NEXT
          </a>";
        } ?>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>
