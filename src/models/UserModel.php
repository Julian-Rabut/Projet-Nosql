<?php
require_once __DIR__ . '/../config/mongodb.php';

use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

class UserModel {
    private $col;

    public function __construct() {
        $this->col = mongo_db()->users;
    }

    public function all(): array {
        return $this->col->find([], ['sort' => ['createdAt' => -1]])->toArray();
    }

    public function findAllForSelect(): array {
        return $this->col->find([], ['sort' => ['name' => 1]])->toArray();
    }

    public function findById(string $id) {
        if (!$id || strlen($id) !== 24) return null;
        return $this->col->findOne(['_id' => new ObjectId($id)]);
    }

    public function insert(string $name, string $email) {
        return $this->col->insertOne([
            'name' => $name,
            'email' => $email,
            'createdAt' => new UTCDateTime(),
        ])->getInsertedId();
    }

    public function update(string $id, string $name, string $email): void {
        if (!$id || strlen($id) !== 24) return;
        $this->col->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => ['name' => $name, 'email' => $email]]
        );
    }

    public function delete(string $id): void {
        if (!$id || strlen($id) !== 24) return;
        $this->col->deleteOne(['_id' => new ObjectId($id)]);
    }
}
