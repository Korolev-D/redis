<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$request = $_SERVER['REQUEST_URI'];
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_pop($url);
}
switch ($request) {
    case '' :
    case '/' :
        require __DIR__ . '/../views/index.php';
        break;
    case '/api/redis' :
    case '/api/redis/' . $key :
        require __DIR__ . '/../api/redis.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}