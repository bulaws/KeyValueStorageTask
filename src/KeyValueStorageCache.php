<?php


namespace App\Storage;

use App\Storage\KeyValueStorageInterface;

class KeyValueStorageCache implements KeyValueStorageInterface
{
    private $cache = [];

    public function set(string $key, $value) : void
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key)
    {
       if (isset($this->cache[$key])) {
           return $this->cache[$key];
       }
    }

    public function has(string $key) : bool
    {
        return isset($this->cache[$key]);
    }

    public function remove(string $key) : void
    {
        if (isset($this->cache[$key])) {
            unset($this->cache[$key]);
        }
    }

    public function clear() : void
    {
        $this->cache = [];
    }
}