<?php
require_once __DIR__ . '/../config/mongodb.php';

class MapController {
    public function handle(string $action): void {
        if ($action !== 'view') {
            http_response_code(404);
            echo "Action inconnue";
            return;
        }
        require __DIR__ . '/../views/map/view.php';
    }
}
