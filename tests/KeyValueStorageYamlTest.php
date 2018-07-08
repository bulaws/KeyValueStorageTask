<?php

namespace App\Storage\Tests;

use PHPUnit\Framework\TestCase;
use App\Storage\KeyValueStorageYaml;
use Symfony\Component\Yaml\Yaml;

class KeyValueStorageYamlTest extends TestCase
{
    /**
     * @var KeyValueStorageYaml
     */
    protected $yamlStorage;
    protected $testData;
    protected static $fileName = __DIR__."/../storage/FileYamlStorage.yaml";

    public function setUp()
    {
        $this->testData = ["animal" => "dog"];
        $yaml = Yaml::dump($this->testData);
        file_put_contents(self::$fileName, $yaml);
        $this->yamlStorage = new KeyValueStorageYaml(self::$fileName);
    }

    public function tearDown()
    {
        unlink(self::$fileName);
        $this->yamlStorage = null;
    }

    public function testRead()
    {
        $this->yamlStorage->read();

        $this->assertEquals($this->testData, $this->yamlStorage->fileContent);
    }

    public function testWrite()
    {
        $this->yamlStorage->set("animal", "cat");
        $this->yamlStorage->write();
        $this->yamlStorage->read();

        $this->assertEquals(["animal" => "cat"], $this->yamlStorage->fileContent);
    }

    public function testSet()
    {
        $this->yamlStorage->set("animal", "cat");

        $this->assertArrayHasKey("animal", $this->yamlStorage->cache);
        $this->assertEquals("cat",$this->yamlStorage->cache["animal"]);
    }

    public function testGet()
    {
        $this->yamlStorage->read();

        $this->assertEquals("dog", $this->yamlStorage->get("animal"));
    }

    public function testHas()
    {
        $this->yamlStorage->read();

        $this->assertTrue($this->yamlStorage->has("animal"));
    }

    public function testRemove()
    {
        $this->yamlStorage->remove("animal");

        $this->assertFalse($this->yamlStorage->has("animal"));
    }

    public function testClear()
    {
        $this->yamlStorage->clear();

        $this->assertFalse($this->yamlStorage->has("animal"));
    }
}