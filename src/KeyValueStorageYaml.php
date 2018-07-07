<?php


namespace App\Storage;

use App\Storage\KeyValueStorageInterface;
use Symfony\Component\Yaml\Yaml;

class KeyValueStorageYaml implements KeyValueStorageInterface
{
    private $cache = [];
    private $fileName;
    private $fileContent;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function read()
    {
        $this->fileContent = Yaml::parseFile("$this->fileName");
    }

    public function write()
    {
        $finalContent = array_replace($this->fileContent, $this->cache);
        $yaml = Yaml::dump($finalContent);
        file_put_contents("$this->fileName", !empty($yaml) ? $yaml : '');
    }

    public function set(string $key, $value) : void
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
    public function has(string $key) : bool
    {
        return !empty($this->get($key));
    }

    /**
     * Removes value by key.
     *
     * @param string $key
     */
    public function remove(string $key) : void
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
    public function clear() : void
    {
        $this->cache = [];
        $this->fileContent = [];
    }
}