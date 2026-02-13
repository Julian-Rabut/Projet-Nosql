<?php
require_once __DIR__ . '/../config/mongodb.php';
require_once __DIR__ . '/../models/ReviewModel.php';

class ReviewController {
    public function handle(string $action): void {
        $model = new ReviewModel();

        if ($action === 'list') {
            $reviews = $model->all();
            require __DIR__ . '/../views/reviews/list.php';
            return;
        }

        if ($action === 'create') {
            $targetType = $_GET['type'] ?? '';
            $targetId = $_GET['id'] ?? '';

            if (!in_array($targetType, ['activity','venue'], true) || strlen($targetId) !== 24) {
                http_response_code(400);
                echo "Paramètres invalides (type/id)";
                return;
            }

            $user = mongo_db()->users->findOne();
            if (!$user) {
                http_response_code(500);
                echo "Aucun user trouvé. Lance seed.php.";
                return;
            }
            $defaultUserId = (string)$user['_id'];
            $error = null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $model->insert($_POST);
                    // retour intelligent
                    if ($targetType === 'activity') {
                        header("Location: /?page=events&action=show&id=" . $targetId);
                    } else {
                        header("Location: /?page=venues&action=show&id=" . $targetId);
                    }
                    exit;
                } catch (Throwable $e) {
                    $error = $e->getMessage();
                }
            }

            require __DIR__ . '/../views/reviews/form.php';
            return;
        }

        if ($action === 'delete') {
            $id = $_GET['id'] ?? '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $model->delete($id);
                header("Location: /?page=reviews&action=list");
                exit;
            }
            $reviewId = $id;
            require __DIR__ . '/../views/reviews/delete.php';
            return;
        }

        http_response_code(404);
        echo "Action inconnue";
    }
}
