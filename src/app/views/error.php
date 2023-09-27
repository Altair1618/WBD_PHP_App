<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/styles/error/error.css" rel="stylesheet">
</head>

<body>
  <?php
    require_once __DIR__ . "/../utils/_statustext.php";
    echo '<h1 id="error_code" class="error_text">' . http_response_code() . "</h1>\n";
    echo '<h3 id="error_msg" class="error_text">' . _statustext(http_response_code()) . "</h3>\n";
  ?>
</body>

</html>
