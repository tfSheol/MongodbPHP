<?php

require_once './config.php';

$mongodb = new \api\MongodbPHP\MongodbPHP();

$mongodb->selectDb("test_db");
$mongodb->selectCollection("test_collection");

$mongodb->insertU(array());
$mongodb->insert(array());

$mongodb->delete(array());
$mongodb->deleteFirst(array());
$mongodb->deleteAll();

$mongodb->update(array());

$mongodb->getCount();

$mongodb->getAll();
$mongodb->getAllCollections();
$mongodb->getAllDatabase();
