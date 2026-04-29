<?php
// Router for PHP built-in server to forward requests to Laravel's front controller
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$publicPath = __DIR__ . '/public' . $uri;

// If the request targets a real file in `public/`, let the server serve it directly
if ($uri !== '/' && file_exists($publicPath)) {
    return false;
}

// Otherwise forward the request to Laravel's front controller
require_once __DIR__ . '/public/index.php';
