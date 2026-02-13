<?php
require_once __DIR__ . '/../models/VenueModel.php';
require_once __DIR__ . '/../models/ReviewModel.php';

class VenueController {
    private VenueModel $model;

    public function __construct() {
        $this->model = new VenueModel();
    }

    public function handle(string $action): void {
        switch ($action) {
            case 'list':
                $venues = $this->model->all();
                require __DIR__ . '/../views/venues/list.php';
                return;

            case 'show':
                $id = $_GET['id'] ?? '';
                $venue = $this->model->findById($id);
                if (!$venue) { http_response_code(404); echo "Lieu introuvable"; return; }

                $reviewModel = new ReviewModel();
                $reviews = $reviewModel->allByTarget('venue', (string)$venue['_id']);
                require __DIR__ . '/../views/venues/show.php';
                return;

            case 'create':
                $error = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = trim($_POST['name'] ?? '');
                    $city = trim($_POST['city'] ?? '');
                    $lng  = (float)($_POST['lng'] ?? 0);
                    $lat  = (float)($_POST['lat'] ?? 0);

                    if ($name === '' || $city === '') {
                        $error = "Nom et ville obligatoires.";
                    } else {
                        $newId = $this->model->insert($name, $city, $lng, $lat);
                        header('Location: /?page=venues&action=show&id=' . (string)$newId);
                        exit;
                    }
                }
                $venue = null;
                require __DIR__ . '/../views/venues/form.php';
                return;

            case 'edit':
                $id = $_GET['id'] ?? '';
                $venue = $this->model->findById($id);
                if (!$venue) { http_response_code(404); echo "Lieu introuvable"; return; }

                $error = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = trim($_POST['name'] ?? '');
                    $city = trim($_POST['city'] ?? '');
                    $lng  = (float)($_POST['lng'] ?? 0);
                    $lat  = (float)($_POST['lat'] ?? 0);

                    if ($name === '' || $city === '') {
                        $error = "Nom et ville obligatoires.";
                    } else {
                        $this->model->update($id, $name, $city, $lng, $lat);
                        header('Location: /?page=venues&action=show&id=' . $id);
                        exit;
                    }
                }
                require __DIR__ . '/../views/venues/form.php';
                return;

            case 'delete':
                $id = $_GET['id'] ?? '';
                $venue = $this->model->findById($id);
                if (!$venue) { http_response_code(404); echo "Lieu introuvable"; return; }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->delete($id);
                    header('Location: /?page=venues&action=list');
                    exit;
                }
                require __DIR__ . '/../views/venues/delete.php';
                return;

            default:
                http_response_code(404);
                echo "Action inconnue";
        }
    }
}
