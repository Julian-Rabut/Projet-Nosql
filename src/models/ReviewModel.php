<?php
require_once __DIR__ . '/../config/mongodb.php';

use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class ReviewModel {
    private $col;

    public function __construct() {
        $this->col = mongo_db()->reviews;
    }

    public function all(): array {
        return $this->col->find([], ['sort' => ['createdAt' => -1]])->toArray();
    }

    public function allByTarget(string $type, string $targetId): array {
        if (!$type || !$targetId || strlen($targetId) !== 24) return [];
        return $this->col->find(
            ['targetType' => $type, 'targetId' => new ObjectId($targetId)],
            ['sort' => ['createdAt' => -1]]
        )->toArray();
    }

    public function insert(array $data): void {
        $targetType = trim($data['targetType'] ?? '');
        $targetId = trim($data['targetId'] ?? '');
        $userId = trim($data['userId'] ?? '');

        if (!in_array($targetType, ['activity', 'venue'], true)) {
            throw new InvalidArgumentException("targetType invalide");
        }
        if (strlen($targetId) !== 24 || strlen($userId) !== 24) {
            throw new InvalidArgumentException("targetId/userId invalide");
        }

        $rating = (int)($data['rating'] ?? 0);
        if ($rating < 1) $rating = 1;
        if ($rating > 5) $rating = 5;

        $comment = trim($data['comment'] ?? '');

        $this->col->insertOne([
            'targetType' => $targetType,
            'targetId' => new ObjectId($targetId),
            'userId' => new ObjectId($userId),
            'rating' => $rating,
            'comment' => $comment,
            'createdAt' => new UTCDateTime(),
        ]);
    }

    public function delete(string $id): void {
        if (!$id || strlen($id) !== 24) return;
        $this->col->deleteOne(['_id' => new ObjectId($id)]);
    }
}
