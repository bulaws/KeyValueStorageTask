<?php


namespace App\Models;
use App\Models\KeyValueStorageInterface;

class KeyValueStorageYaml implements KeyValueStorageInterface
{

    /**
     * Store value by key.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void
    {
        // TODO: Implement set() method.
    }

    /**
     * Gets value by key.
     *
     * @param string $key
     * @return mixed Can have any type: int, string, null, array, e.g.
     */
    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    /**
     * Check whether value is exist by key.
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        // TODO: Implement has() method.
    }

    /**
     * Removes value by key.
     *
     * @param string $key
     */
    public function remove(string $key): void
    {
        // TODO: Implement remove() method.
    }

    /**
     * Clear storage.
     */
    public function clear(): void
    {
        // TODO: Implement clear() method.
    }
}