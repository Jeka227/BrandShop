<?php
// HTTP
define('HTTP_SERVER', 'https://focused-joliot.65-109-55-151.plesk.page/');

// HTTPS
define('HTTPS_SERVER', 'https://focused-joliot.65-109-55-151.plesk.page/');

// DIR
define('DIR_APPLICATION', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/catalog/');
define('DIR_SYSTEM', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/system/');
define('DIR_IMAGE', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/image/');
define('DIR_STORAGE', '/var/www/vhosts/focused-joliot.65-109-55-151.plesk.page/httpdocs/storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
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