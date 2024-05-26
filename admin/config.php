<?php
// HTTP
define('HTTP_SERVER', 'http://focused-joliot.65-109-55-151.plesk.page/admin/');
define('HTTP_CATALOG', 'http://focused-joliot.65-109-55-151.plesk.page/');

// HTTPS
define('HTTPS_SERVER', 'https://focused-joliot.65-109-55-151.plesk.page/admin/');
define('HTTPS_CATALOG', 'https://focused-joliot.65-109-55-151.plesk.page/');

// DIR
define('DIR_APPLICATION', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/admin/');
define('DIR_SYSTEM', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/system/');
define('DIR_IMAGE', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/image/');
define('DIR_STORAGE', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/storage/');
define('DIR_CATALOG', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/catalog/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'admin11');
define('DB_PASSWORD', 'j7Z4J$1Nth');
define('DB_DATABASE', 'admin_1');
define('DB_PORT', '3306');
define('DB_PREFIX', 'oc_');

// OpenCart API
define('OPENCART_SERVER', 'https://www.opencart.com/');
define('OPENCARTFORUM_SERVER', 'https://opencartforum.com/');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
