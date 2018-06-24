<?php

namespace App\Models;

interface KeyValueStorageInterface
{
    /**
     * Store value by key.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void;

    /**
     * Gets value by key.
     *
     * @param string $key
     * @return mixed Can have any type: int, string, null, array, e.g.
     */
    public function get(string $key);

    /**
     * Check whether value is exist by key.
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Removes value by key.
     *
     * @param string $key
     */
    public function remove(string $key): void;

    /**
     * Clear storage.
     */
    public function clear(): void;

}