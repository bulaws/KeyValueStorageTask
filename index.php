<?php

require __DIR__."/vendor/autoload.php";

use App\Models\KeyValueStorageCache;
use App\Models\KeyValueStorageJson;
use App\Models\KeyValueStorageYaml;

use App\classes\JsonStorage;
/*$cache = new CacheStorage();

$cache->set('test','23');
var_dump($cache);
var_dump($cache->has('test'));*/

$json = new JsonStorage(__DIR__.'/file.json');

var_dump($json);
