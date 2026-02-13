<?php
require_once __DIR__ . '/../models/EventModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/VenueModel.php';

class EventController {
    private EventModel $model;

    public function __construct() {
        $this->model = new EventModel();
    }

    public function handle(string $action): void {
        switch ($action) {

            case 'list':
                $venueModel = new VenueModel();

                $filters = [
                    'q' => $_GET['q'] ?? '',
                    'category' => $_GET['category'] ?? '',
                    'difficulty' => $_GET['difficulty'] ?? '',
                    'city' => $_GET['city'] ?? '',
                ];

                $venueIds = [];
                if (trim($filters['city']) !== '') {
                    $venueIds = $venueModel->findIdsByCity(trim($filters['city']));
                }

                $events = $this->model->filter($filters, $venueIds);

                $categories = $this->model->distinctCategories();
                $difficulties = $this->model->distinctDifficulties();
                $cities = $venueModel->distinctCities();

                require __DIR__ . '/../views/events/list.php';
                return;

            case 'show':
                $id = $_GET['id'] ?? '';
                $event = $this->model->findById($id);
                if (!$event) { http_response_code(404); echo "Introuvable"; return; }
                require __DIR__ . '/../views/events/show.php';
                return;

            case 'create':
                $userModel = new UserModel();
                $venueModel = new VenueModel();
                $users = $userModel->findAllForSelect();
                $venues = $venueModel->findAllForSelect();

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $newId = $this->model->insert($_POST);
                    header('Location: /?page=events&action=show&id=' . (string)$newId);
                    exit;
                }

                $event = null;
                require __DIR__ . '/../views/events/form.php';
                return;

            case 'edit':
                $id = $_GET['id'] ?? '';
                $event = $this->model->findById($id);
                if (!$event) { http_response_code(404); echo "Introuvable"; return; }

                $userModel = new UserModel();
                $venueModel = new VenueModel();
                $users = $userModel->findAllForSelect();
                $venues = $venueModel->findAllForSelect();

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: /?page=events&action=show&id=' . $id);
                    exit;
                }

                require __DIR__ . '/../views/events/form.php';
                return;

            case 'delete':
                $id = $_GET['id'] ?? '';
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->delete($id);
                    header('Location: /?page=events&action=list');
                    exit;
                }
                $event = $this->model->findById($id);
                require __DIR__ . '/../views/events/delete.php';
                return;

            default:
                http_response_code(404);
                echo "Action inconnue";
        }
    }
}
