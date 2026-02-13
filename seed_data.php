<?php
// Utilise EXACTEMENT la même connexion que l'app
require_once __DIR__ . '/src/config/mongodb.php';

use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

$db = mongo_db();

echo "=== SEED DATA (DB APP) ===\n";

// Petit helper
function upsertOne($col, array $filter, array $doc) {
    $existing = $col->findOne($filter);
    if ($existing) return (string)$existing['_id'];
    $res = $col->insertOne($doc);
    return (string)$res->getInsertedId();
}

// 1) USERS
$userIds = [];
$userIds['admin@reunion.local'] = upsertOne($db->users, ['email'=>'admin@reunion.local'], [
    'name'=>'Admin Reunion',
    'email'=>'admin@reunion.local',
    'createdAt'=> new UTCDateTime()
]);

$userIds['julie@reunion.local'] = upsertOne($db->users, ['email'=>'julie@reunion.local'], [
    'name'=>'Julie',
    'email'=>'julie@reunion.local',
    'createdAt'=> new UTCDateTime()
]);

$userIds['lucas@reunion.local'] = upsertOne($db->users, ['email'=>'lucas@reunion.local'], [
    'name'=>'Lucas',
    'email'=>'lucas@reunion.local',
    'createdAt'=> new UTCDateTime()
]);

echo "Users: " . $db->users->countDocuments() . "\n";

// 2) VENUES (lieux)
$venueIds = [];
$venueIds['Jardin de l’État'] = upsertOne($db->venues, ['name'=>'Jardin de l’État','city'=>'Saint-Denis'], [
    'name'=>'Jardin de l’État',
    'city'=>'Saint-Denis',
    'location'=>['type'=>'Point','coordinates'=>[55.4481, -20.8789]],
    'createdAt'=> new UTCDateTime()
]);

$venueIds['Plage de l’Ermitage'] = upsertOne($db->venues, ['name'=>'Plage de l’Ermitage','city'=>'Saint-Paul'], [
    'name'=>'Plage de l’Ermitage',
    'city'=>'Saint-Paul',
    'location'=>['type'=>'Point','coordinates'=>[55.2339, -21.0796]],
    'createdAt'=> new UTCDateTime()
]);

$venueIds['Piton de la Fournaise'] = upsertOne($db->venues, ['name'=>'Piton de la Fournaise (Pas de Bellecombe)','city'=>'Sainte-Rose'], [
    'name'=>'Piton de la Fournaise (Pas de Bellecombe)',
    'city'=>'Sainte-Rose',
    'location'=>['type'=>'Point','coordinates'=>[55.7135, -21.2444]],
    'createdAt'=> new UTCDateTime()
]);

$venueIds['Cascade Langevin'] = upsertOne($db->venues, ['name'=>'Cascade Langevin','city'=>'Saint-Joseph'], [
    'name'=>'Cascade Langevin',
    'city'=>'Saint-Joseph',
    'location'=>['type'=>'Point','coordinates'=>[55.6342, -21.3736]],
    'createdAt'=> new UTCDateTime()
]);

echo "Venues: " . $db->venues->countDocuments() . "\n";

// 3) ACTIVITIES (ta collection est "activities")
$activityIds = [];

$activityIds['Snorkeling au lagon'] = upsertOne($db->activities, ['title'=>'Snorkeling au lagon'], [
    'title'=>'Snorkeling au lagon',
    'category'=>'plage',
    'duration'=>'2h',
    'difficulty'=>'facile',
    'description'=>'Masque/tuba à l’Ermitage, eau calme et poissons.',
    'venueId'=> new ObjectId($venueIds['Plage de l’Ermitage']),
    'createdBy'=> new ObjectId($userIds['julie@reunion.local']),
    'createdAt'=> new UTCDateTime(),
]);

$activityIds['Randonnée Piton de la Fournaise'] = upsertOne($db->activities, ['title'=>'Randonnée Piton de la Fournaise'], [
    'title'=>'Randonnée Piton de la Fournaise',
    'category'=>'rando',
    'duration'=>'journée',
    'difficulty'=>'moyen',
    'description'=>'Départ Pas de Bellecombe, paysages volcaniques.',
    'venueId'=> new ObjectId($venueIds['Piton de la Fournaise']),
    'createdBy'=> new ObjectId($userIds['lucas@reunion.local']),
    'createdAt'=> new UTCDateTime(),
]);

$activityIds['Pique-nique à Langevin'] = upsertOne($db->activities, ['title'=>'Pique-nique à Langevin'], [
    'title'=>'Pique-nique à Langevin',
    'category'=>'nature',
    'duration'=>'demi-journée',
    'difficulty'=>'facile',
    'description'=>'Pause fraîcheur près de la cascade, photos + baignade prudente.',
    'venueId'=> new ObjectId($venueIds['Cascade Langevin']),
    'createdBy'=> new ObjectId($userIds['admin@reunion.local']),
    'createdAt'=> new UTCDateTime(),
]);

echo "Activities: " . $db->activities->countDocuments() . "\n";

// 4) REVIEWS (targetType / targetId)
function addReviewIfMissing($db, $comment, $type, $targetId, $userId, $rating) {
    $existing = $db->reviews->findOne(['comment'=>$comment]);
    if ($existing) return;
    $db->reviews->insertOne([
        'targetType'=>$type,
        'targetId'=> new ObjectId($targetId),
        'userId'=> new ObjectId($userId),
        'rating'=>(int)$rating,
        'comment'=>$comment,
        'createdAt'=> new UTCDateTime(),
    ]);
}

addReviewIfMissing($db, "Super spot, lagon calme !", "venue", $venueIds['Plage de l’Ermitage'], $userIds['julie@reunion.local'], 5);
addReviewIfMissing($db, "Incroyable, prévoir de l’eau.", "activity", $activityIds['Randonnée Piton de la Fournaise'], $userIds['lucas@reunion.local'], 5);
addReviewIfMissing($db, "Top mais venir tôt.", "activity", $activityIds['Snorkeling au lagon'], $userIds['admin@reunion.local'], 4);

echo "Reviews: " . $db->reviews->countDocuments() . "\n";

echo " Seed terminé. Vérifie:\n";
echo "- /?page=events&action=list\n";
echo "- /?page=venues&action=list\n";
echo "- /?page=map&action=view\n";
