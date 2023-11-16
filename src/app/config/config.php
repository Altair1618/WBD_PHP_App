<?php

// Ports
define('HTTP_PORT', 8008);
define('DB_PORT', 5432);

// URL
define('BASE_URL', 'http://localhost:' . HTTP_PORT . '/');
define('REST_URL', $_ENV['REST_SERVICE'] . '/');
define('SOAP_URL', $_ENV['SOAP_SERVICE'] . '/');

// API Key
define('SOAP_API_KEY', $_ENV['SOAP_SERVICE_API_KEY']);

// Directory
define('APP_DIR', __DIR__ . '/../');

define('API_CONTROLLERS_DIR', APP_DIR . 'api_controllers/');
define('COMPONENTS_DIR', APP_DIR . 'components/');
define('CONTROLLERS_DIR', APP_DIR . 'controllers/');
define('MIDDLEWARES_DIR', APP_DIR . 'middlewares/');
define('MODELS_DIR', APP_DIR . 'models/');
define('VIEWS_DIR', APP_DIR . 'views/');
define('UPLOADS_DIR', "/var/www/html/assets/uploads/");

// Log File
define("LOG_FILE", APP_DIR . 'logs.log');

// Database Configuration
define('DB_HOST', $_ENV['POSTGRES_HOST']);
define('DB_NAME', $_ENV['POSTGRES_DB']);
define('DB_USER', $_ENV['POSTGRES_USER']);
define('DB_PASS', $_ENV['POSTGRES_PASSWORD']);

// Pagination Configuration
define('ITEMS_PER_PAGE', 10);

// File Upload Configuration
define('MAX_FILE_SIZE', 100 * 1024 * 1024); // 100 MB

// Debounce Configuration
define('DEBOUNCE_TIME', 500); // 500 ms

// Some enums
define("PENGGUNA_TIPE_ADMIN", 0);
define("PENGGUNA_TIPE_PENGAJAR", 1);
define("PENGGUNA_TIPE_MAHASISWA", 2);

// File Types
define("ALLOWED_FILE_TYPES", array("image/avif", "image/bmp", "image/gif", "image/vnd.microsoft.icon", "image/jpeg", "image/png", "image/svg+xml", "image/webp"));
