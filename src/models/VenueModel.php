<?php
require_once __DIR__ . '/../config/mongodb.php';

use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

class VenueModel {
    private $col;

    public function __construct() {
        $this->col = mongo_db()->venues;
    }

    public function all(): array {
        return $this->col->find([], ['sort' => ['createdAt' => -1]])->toArray();
    }

    public function findAllForSelect(): array {
        return $this->col->find([], ['sort' => ['city' => 1, 'name' => 1]])->toArray();
    }

    public function findById(string $id) {
        if (!$id || strlen($id) !== 24) return null;
        return $this->col->findOne(['_id' => new ObjectId($id)]);
    }

    public function distinctCities(): array {
        $cities = $this->col->distinct('city');
        sort($cities);
        return $cities;
    }

    public function findIdsByCity(string $city): array {
        if ($city === '') return [];
        $cursor = $this->col->find(['city' => $city], ['projection' => ['_id' => 1]]);
        $ids = [];
        foreach ($cursor as $v) $ids[] = $v['_id'];
        return $ids;
    }

    public function insert(string $name, string $city, float $lng, float $lat) {
        return $this->col->insertOne([
            'name' => $name,
            'city' => $city,
            'location' => [
                'type' => 'Point',
                'coordinates' => [$lng, $lat], // lng, lat
            ],
            'createdAt' => new UTCDateTime(),
        ])->getInsertedId();
    }

    public function update(string $id, string $name, string $city, float $lng, float $lat): void {
        if (!$id || strlen($id) !== 24) return;
        $this->col->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'name' => $name,
                'city' => $city,
                'location' => ['type' => 'Point', 'coordinates' => [$lng, $lat]]
            ]]
        );
    }

    public function delete(string $id): void {
        if (!$id || strlen($id) !== 24) return;
        $this->col->deleteOne(['_id' => new ObjectId($id)]);
    }
}
