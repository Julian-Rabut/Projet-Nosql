<?php
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../../vendor/autoload.php';

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

$client = new Client('mongodb://localhost:27017');
$db = $client->reunion_events;

$venues = $db->venues->find()->toArray();

$out = [];

foreach ($venues as $v) {
    $coords = $v['location']['coordinates'] ?? [null, null];
    $lng = $coords[0] ?? null;
    $lat = $coords[1] ?? null;

    $venueId = (string)$v['_id'];

    // Avis du lieu
    $venueReviews = $db->reviews->find([
        'targetType' => 'venue',
        'targetId' => new ObjectId($venueId)
    ])->toArray();

    $venueReviewsOut = array_map(function($r){
        return [
            'rating' => (int)($r['rating'] ?? 0),
            'comment' => (string)($r['comment'] ?? ''),
        ];
    }, $venueReviews);

    // activités liées à ce lieu
    $activities = $db->activities->find(['venueId' => new ObjectId($venueId)])->toArray();

    $activitiesOut = [];
    foreach ($activities as $a) {
        $activityId = (string)$a['_id'];

        // avis liés à l'activité
        $reviews = $db->reviews->find([
            'targetType' => 'activity',
            'targetId' => new ObjectId($activityId)
        ])->toArray();

        $reviewsOut = array_map(function($r){
            return [
                'rating' => (int)($r['rating'] ?? 0),
                'comment' => (string)($r['comment'] ?? ''),
            ];
        }, $reviews);

        $activitiesOut[] = [
            'id' => $activityId,
            'title' => (string)($a['title'] ?? ''),
            'category' => (string)($a['category'] ?? ''),
            'difficulty' => (string)($a['difficulty'] ?? ''),
            'reviews' => $reviewsOut,
        ];
    }

    $out[] = [
        'id' => $venueId,
        'name' => (string)($v['name'] ?? ''),
        'city' => (string)($v['city'] ?? ''),
        'lng' => $lng,
        'lat' => $lat,
        'venueReviews' => $venueReviewsOut,
        'activities' => $activitiesOut,
    ];
}

echo json_encode(['venues' => $out], JSON_UNESCAPED_UNICODE);
