<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$page   = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? 'list';

// Sécurise un minimum (évite n'importe quoi dans l'URL)
$page = preg_replace('/[^a-z_]/i', '', (string)$page);
$action = preg_replace('/[^a-z_]/i', '', (string)$action);

switch ($page) {
    case 'home':
        require __DIR__ . '/../src/views/home.php';
        break;

    case 'events':
        require_once __DIR__ . '/../src/controllers/EventController.php';
        (new EventController())->handle($action);
        break;

    case 'venues':
        require_once __DIR__ . '/../src/controllers/VenueController.php';
        (new VenueController())->handle($action);
        break;

    case 'users':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        (new UserController())->handle($action);
        break;

    case 'reviews':
        require_once __DIR__ . '/../src/controllers/ReviewController.php';
        (new ReviewController())->handle($action);
        break;

    case 'map':
        require __DIR__ . '/../src/views/map/view.php';
        break;

    default:
        http_response_code(404);
        echo "Page introuvable";
        break;
}
