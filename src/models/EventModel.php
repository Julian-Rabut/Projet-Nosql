<?php
require_once __DIR__ . '/../config/mongodb.php';

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class EventModel {
    private $col;

    public function __construct() {
        $this->col = mongo_db()->activities;
    }

    public function all(array $filter = [], array $options = []) {
        $options = array_merge(['sort' => ['createdAt' => -1]], $options);
        return $this->col->find($filter, $options)->toArray();
    }

    public function findById(string $id) {
        if (!$id || strlen($id) !== 24) return null;
        return $this->col->findOne(['_id' => new ObjectId($id)]);
    }

    public function insert(array $data) {
        $dateStr = trim($data['date'] ?? '');
        $dateUtc = null;
        if ($dateStr !== '') {
            $dateUtc = new UTCDateTime(strtotime($dateStr) * 1000);
        }

        $doc = [
            'title' => trim($data['title'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'category' => trim($data['category'] ?? ''),
            'duration' => trim($data['duration'] ?? ''),
            'difficulty' => trim($data['difficulty'] ?? ''),
            'venueId' => new ObjectId($data['venueId']),
            'createdBy' => new ObjectId($data['createdBy']),
            'createdAt' => new UTCDateTime(),
        ];

        if ($dateUtc !== null) $doc['date'] = $dateUtc;

        return $this->col->insertOne($doc)->getInsertedId();
    }

    public function update(string $id, array $data) {
        $dateStr = trim($data['date'] ?? '');
        $set = [
            'title' => trim($data['title'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'category' => trim($data['category'] ?? ''),
            'duration' => trim($data['duration'] ?? ''),
            'difficulty' => trim($data['difficulty'] ?? ''),
            'venueId' => new ObjectId($data['venueId']),
            'createdBy' => new ObjectId($data['createdBy']),
        ];

        if ($dateStr === '') {
            $set['date'] = null;
        } else {
            $set['date'] = new UTCDateTime(strtotime($dateStr) * 1000);
        }

        $this->col->updateOne(['_id' => new ObjectId($id)], ['$set' => $set, '$unset' => ['date' => '']]);
        // Si date non vide, on la remet dans $set, donc on la réécrit après l'unset
        if ($dateStr !== '') {
            $this->col->updateOne(['_id' => new ObjectId($id)], ['$set' => ['date' => $set['date']]]);
        }
    }

    public function delete(string $id) {
        if (!$id || strlen($id) !== 24) return;
        $this->col->deleteOne(['_id' => new ObjectId($id)]);
    }

    public function distinctCategories(): array {
        $cats = $this->col->distinct('category');
        $cats = array_values(array_filter($cats, fn($c) => is_string($c) && trim($c) !== ''));
        sort($cats);
        return $cats;
    }

    public function distinctDifficulties(): array {
        $d = $this->col->distinct('difficulty');
        $d = array_values(array_filter($d, fn($x) => is_string($x) && trim($x) !== ''));
        sort($d);
        return $d;
    }

    public function filter(array $params, array $venueIds = []): array {
        $q = trim($params['q'] ?? '');
        $category = trim($params['category'] ?? '');
        $difficulty = trim($params['difficulty'] ?? '');

        $filter = [];

        if ($q !== '') {
            $regex = new MongoDB\BSON\Regex(preg_quote($q), 'i');
            $filter['$or'] = [
                ['title' => $regex],
                ['category' => $regex]
            ];
        }

        if ($category !== '') $filter['category'] = $category;
        if ($difficulty !== '') $filter['difficulty'] = $difficulty;

        if (!empty($venueIds)) {
            $filter['venueId'] = ['$in' => $venueIds];
        }

        return $this->all($filter);
    }
}
