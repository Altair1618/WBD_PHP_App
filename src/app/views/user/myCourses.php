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
        <input type="text" id="search-input" class="search-input" placeholder="Ketikkan kode/nama mata kuliah">

        <button type="submit" id="search-button" class="search-button" >
          <img class="search-button" src="/assets/icons/Search_Button.svg" alt="search">
        </button>
      </div>
    </div>

    <div id="body-main-container" class="body-main-container">
      <?php
        $controller = new CourseController();
        $controller->getCoursesHTML($params);
      ?>
    </div>
  </div>

  <script src="/scripts/course/myCourses.js"></script>
</body>

</html>
