<?php

require __DIR__."/vendor/autoload.php";

use App\Models\KeyValueStorageCache;
use App\Models\KeyValueStorageJson;
use App\Models\KeyValueStorageYaml;


$json = new KeyValueStorageJson(__DIR__ . '/storage/FileJson.json');

$json->read();
var_dump($json);
$json->clear();
$json->write();
$json->fileClose();
