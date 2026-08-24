<?php
/**
 * Router for PHP built-in server (WordPress pretty permalinks).
 */
$root = __DIR__ . '/vipclinik.com';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists($root . $uri) && !is_dir($root . $uri)) {
    return false;
}

chdir($root);
require $root . '/index.php';
