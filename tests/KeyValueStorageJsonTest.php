<?php

namespace App\Storage\Tests;

use PHPUnit\Framework\TestCase;
use App\Storage\KeyValueStorageJson;

class KeyValueStorageJsonTest extends TestCase
{

    /**
     * @var KeyValueStorageJson
     */
    public $jsonStorage;
    public $testData;
    public static $fileName = __DIR__."/../storage/FileJsonStorage.json";

    public function setUp()
    {
        $this->testData = ["animal" => "dog"];
        file_put_contents(self::$fileName, json_encode($this->testData));
        $this->jsonStorage = new KeyValueStorageJson(self::$fileName);
    }

    public function tearDown()
    {
        $this->jsonStorage->fileClose();
        unlink(self::$fileName);
        $this->jsonStorage = null;
    }

    public function testRead()
    {
        $this->jsonStorage->read();

        $this->assertEquals($this->testData, $this->jsonStorage->fileContent);
    }

    public function testWrite()
    {
        $this->jsonStorage->set("animal", "cat");
        $this->jsonStorage->write();
        $this->jsonStorage->fileClose();
        $this->jsonStorage = new KeyValueStorageJson(self::$fileName);
        $this->jsonStorage->read();

        $this->assertEquals(["animal" => "cat"], $this->jsonStorage->fileContent);
    }

    public function testFileClose()
    {
        $this->assertTrue($this->jsonStorage->fileClose());
    }

    public function testSet()
    {
        $this->jsonStorage->set("animal", "cat");

        $this->assertArrayHasKey("animal", $this->jsonStorage->cache);
        $this->assertEquals("cat",$this->jsonStorage->cache["animal"]);
    }

    public function testGet()
    {
        $this->jsonStorage->read();

        $this->assertEquals("dog", $this->jsonStorage->get("animal"));
    }

    public function testHas()
    {
        $this->jsonStorage->read();

        $this->assertTrue($this->jsonStorage->has("animal"));
    }

    public function testRemove()
    {
        $this->jsonStorage->remove("animal");

        $this->assertFalse($this->jsonStorage->has("animal"));
    }

    public function testClear()
    {
        $this->jsonStorage->clear();

        $this->assertFalse($this->jsonStorage->has("animal"));
    }
}
