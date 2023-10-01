<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <h1> Ini Home Page </h1>
  <?php
    if (isset($_SESSION['user'])) {
      print_r($_SESSION['user']);
    }

    if (isset($_SESSION['post'])) {
      print_r($_SESSION['post']);
    }
  ?>
</body>

</html>
