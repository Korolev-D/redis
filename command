#!/usr/bin/php

<?php
require_once(__DIR__ . '/Helpers/DefaultHelper.php');
require_once(__DIR__ . '/Controllers/RedisController.php');
require_once(__DIR__ . '/Controllers/MemcacheController.php');

$name = $argv[1] === 'redis';
$action = $argv[2];
$key = $argv[3];
$value = $argv[4];

if (!$name) {
    echo DefaultHelper::$message['unknown_command'];
    exit();
}
if (!$action) {
    echo DefaultHelper::$message['empty_command'];
    exit();
}
if (!$key) {
    echo DefaultHelper::$message['empty_parametrs'];
    exit();
}
if ($action === 'add' && empty($value)) {
    echo DefaultHelper::$message['empty_parametrs'];
    exit();
}

$redis = new RedisController();
$memcache = new MemcacheController();

$dataStore = $redis ?: die ("Could not connect");

if ($action === 'add') {
    $dataStore == $redis ? $redis->setex($key, 3600, $value): $memcache->set($key, $value, 0, 3600);
    echo "set $key: $value \n";
} elseif ($action === 'del') {
    $dataStore == $redis ? $redis->delete($key): $memcache->delete($key);
    echo "delete $key \n";
} else {
    echo DefaultHelper::$message['wrong_command'];
    exit();
}

