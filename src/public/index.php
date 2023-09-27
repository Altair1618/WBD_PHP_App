<?php

require_once __DIR__ . '/../app/config/bootstrap.php';

$uri = $_SERVER["REQUEST_URI"];

switch ($uri) {
  case "":
  case "/":
    break;
  default:
    http_response_code(404);
    require __DIR__ . '/../app/views/errors.php';
    die();
}

// Test DB Connection
try {
  $db = new Database();
  print_r($db->fetchAll("SELECT kode_fakultas FROM program_studi"));
  echo "Database connection successful!";
} catch (Exception $e) {
  echo "Database connection failed: " . $e->getMessage();
  exit;
}
