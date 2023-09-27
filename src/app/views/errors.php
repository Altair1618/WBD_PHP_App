<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="errors.css" rel="stylesheet">
</head>

<body>
  <?php
  require_once __DIR__ . "/../utils/_statustext.php";
  echo '<strong id="error_code">' . http_response_code() . "</strong>\n";
  echo '<p id="error_msg">' . _statustext(http_response_code()) . "</p>\n";
  ?>
</body>

</html>
