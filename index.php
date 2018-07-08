<?php

require __DIR__."/vendor/autoload.php";

use App\Storage\KeyValueStorageCache;
use App\Storage\KeyValueStorageJson;
use App\Storage\KeyValueStorageYaml;


$json = new KeyValueStorageJson(__DIR__ . '/storage/FileJson.json');

$json->read();
//var_dump($json);
$json->write();
$json->fileClose();
