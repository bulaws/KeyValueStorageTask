<?php


namespace App\Models;
use App\Models\KeyValueStorageInterface;

class KeyValueStorageJson implements KeyValueStorageInterface
{
    private $cache = [];
    private $fileName;
    private $fileStream;
    private $fileContent;

    public function __construct($fileName)
    {
        $this->fileStream = fopen($fileName, 'c+');
        $this->fileName = $fileName;
    }

    public function read()
    {
        $file = fread($this->fileStream, filesize($this->fileName));
        $fileDecode = json_decode($file, true);
        $this->fileContent = $fileDecode;
    }

    public function write()
    {
        $finalContent = array_replace($this->fileContent, $this->cache);
        ftruncate($this->fileStream, 0);
        $finalContent = json_encode($finalContent);
        fwrite($this->fileStream, !empty($finalContent) ? $finalContent : '');
    }

    public function fileClose()
    {
        fclose($this->fileStream);
    }

    public function set(string $key, $value): void
    {
        $this->cache[$key] = $value;
    }

    /**
     * Gets value by key.
     *
     * @param string $key
     * @return mixed Can have any type: int, string, null, array, e.g.
     */
    public function get(string $key)
    {
        $fullContent = array_replace($this->fileContent, $this->cache);
        if(isset($fullContent[$key])){
            return $fullContent[$key];
        }
    }

    /**
     * Check whether value is exist by key.
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return !empty($this->get($key));
    }

    /**
     * Removes value by key.
     *
     * @param string $key
     */
    public function remove(string $key): void
    {
       if (isset($this->cache[$key])) {
           unset($this->cache[$key]);
       } elseif (isset($this->fileContent[$key])) {
           unset($this->fileContent[$key]);
       }
    }

    /**
     * Clear storage.
     */
    public function clear(): void
    {
        $this->cache = [];
        $this->fileContent = [];
    }
}
