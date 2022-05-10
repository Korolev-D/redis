<?php

class MemcacheController
{
    private $memcache;

    public function __construct($host = '127.0.0.1', $port = '11211')
    {
        $this->memcache = new Memcache();
        $this->memcache->connect($host, $port);
    }

    public function set(string $key, string $val, string $flag, string $expire): bool
    {
        return $this->memcache->set($key, $val, $flag, $expire);
    }

    public function delete(string $key): bool
    {
        return $this->memcache->del($key);
    }

    public function get(string $key): string
    {
        return $this->memcache->get($key);
    }

    public function getStats()
    {
        return $this->memcache->getStats();
    }
}