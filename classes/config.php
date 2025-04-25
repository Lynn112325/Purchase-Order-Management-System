<?php
// Uses protocol-relative URLs (//) to automatically support both HTTP and HTTPS.、
define('URL_PROTOCOL', '//');
define('APP_TITLE', 'Procurement System');
// Defines the default controller to load when no controller is specified.
define('DEFAULT_CONTROLLER', 'index');define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER); // /localhost/appfolder/

define('URL_DOMAIN', filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL)); // localhost
define('URL_PUBLIC_FOLDER', 'public'); // public
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));

// Defines debug mode. If set to true, detailed error messages will be displayed.
define('DEBUG', true);
// Sets the character encoding (supports emojis and special characters).
define('DB_CHARSET', 'utf8mb4');
if (DEBUG) {
    // If DEBUG is true, show all errors.

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    // If DEBUG is false, suppress errors and log them to tmp/logs/errors.log.
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}
