<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private UserModel $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function handle(string $action): void {
        switch ($action) {
            case 'list':
                $users = $this->model->all();
                require __DIR__ . '/../views/users/list.php';
                return;

            case 'create':
                $error = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = trim($_POST['name'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    if ($name === '' || $email === '') {
                        $error = "Nom et email obligatoires.";
                    } else {
                        $this->model->insert($name, $email);
                        header('Location: /?page=users&action=list');
                        exit;
                    }
                }
                $user = null;
                require __DIR__ . '/../views/users/form.php';
                return;

            case 'edit':
                $id = $_GET['id'] ?? '';
                $user = $this->model->findById($id);
                if (!$user) { http_response_code(404); echo "Utilisateur introuvable"; return; }

                $error = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = trim($_POST['name'] ?? '');
                    $email = trim($_POST['email'] ?? '');
                    if ($name === '' || $email === '') {
                        $error = "Nom et email obligatoires.";
                    } else {
                        $this->model->update($id, $name, $email);
                        header('Location: /?page=users&action=list');
                        exit;
                    }
                }
                require __DIR__ . '/../views/users/form.php';
                return;

            case 'delete':
                $id = $_GET['id'] ?? '';
                $user = $this->model->findById($id);
                if (!$user) { http_response_code(404); echo "Utilisateur introuvable"; return; }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->delete($id);
                    header('Location: /?page=users&action=list');
                    exit;
                }
                require __DIR__ . '/../views/users/delete.php';
                return;

            default:
                http_response_code(404);
                echo "Action inconnue";
        }
    }
}
