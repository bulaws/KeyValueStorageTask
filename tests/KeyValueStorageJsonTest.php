<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Storage\KeyValueStorageJson;

class KeyValueStorageJsonTest extends TestCase
{
    public $file;
    public $fileContent;

    public function setUp()
    {
        $this->file = file_put_contents();
    }

    public function tearDown()
    {

    }
}