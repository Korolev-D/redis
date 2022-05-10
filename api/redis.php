<?php

require_once(__DIR__ . '/../Controllers/RedisController.php');
require_once(__DIR__ . '/../Controllers/MemcacheController.php');

$redis = new RedisController();
$memcache = new MemcacheController();
$dataStore = $redis;

$response = [
    'status' => 'false',
];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = $dataStore === $redis ? $redis->getAll() : $memcache->getStats();
    $response = [
        'status' => 'true',
        'data'   => $data
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'])) {
    $data = $dataStore === $redis ? $redis->get($_POST['key']) : $memcache->get($_POST['key']);
    $response = [
        'status' => 'true',
        'data'   => [
            $_POST['key'] => $data
        ]
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $url = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_pop($url);
    $dataStore = $redis ? $redis->delete($key) : $memcache->delete($key);
    $response = [
        'status' => 'true',
        'data'   => []
    ];
}

echo $json = json_encode($response);