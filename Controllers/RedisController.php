<?php

class RedisController
{
    private $redis;

    public function __construct($host = '127.0.0.1', $port = '6379')
    {
        $this->redis = new Redis();
        $this->redis->connect($host, $port);
    }

    public function set(string $key, string $val): bool
    {
        return $this->redis->set($key, $val);
    }

    public function setex(string $key, string $time, string $val): bool
    {
        return $this->redis->setEx($key, $time, $val);
    }

    public function get(string $key): string
    {
        return $this->redis->get($key);
    }

    public function getKeys(): array
    {
        return $this->redis->keys('*');
    }

    public function getAll(): array
    {
        $items = [];
        foreach ($this->getKeys() as $item) {
            $items[$item] = $this->get($item);
        }
        return $items;
    }

    public function delete(string $key): bool
    {
        return $this->redis->del($key);
    }
}