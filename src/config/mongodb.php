<?php
require __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;

function mongo_db(): MongoDB\Database {
    static $db = null;
    if ($db === null) {
        $client = new Client('mongodb://localhost:27017');
        $db = $client->reunion_events;
    }
    return $db;
}
