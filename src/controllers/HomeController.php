<?php
require_once __DIR__ . '/../config/mongodb.php';

class HomeController {
    public function handle(string $action): void {
        // dashboard simple
        $db = mongo_db();
        $counts = [
            'activities' => $db->activities->countDocuments(),
            'venues' => $db->venues->countDocuments(),
            'users' => $db->users->countDocuments(),
            'reviews' => $db->reviews->countDocuments(),
        ];
        require __DIR__ . '/../views/home/index.php';
    }
}
