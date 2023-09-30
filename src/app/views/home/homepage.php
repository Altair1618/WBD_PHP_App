<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="errors.css" rel="stylesheet">
</head>

<body>
  <h1> Ini Home Page </h1>
  <?php
    if (isset($_GET['nama'])) {
        echo "<h1> Hello " . $_GET['nama'] . "</h1>";
    }
  ?>
</body>

</html>
