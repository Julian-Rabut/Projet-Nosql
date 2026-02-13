<?php
require_once __DIR__ . '/../../models/ReviewModel.php';
$reviewModel = new ReviewModel();
$activityId = (string)$event['_id'];
$reviews = $reviewModel->allByTarget('activity', $activityId);

$title = $event['title'] ?? 'Activité';
require __DIR__ . '/../layout/header.php';
?>

<div class="card">
  <h1><?= htmlspecialchars($event['title'] ?? '') ?></h1>
  <p><b>Catégorie :</b> <?= htmlspecialchars($event['category'] ?? '') ?></p>
  <p><b>Durée :</b> <?= htmlspecialchars($event['duration'] ?? '') ?></p>
  <p><b>Difficulté :</b> <?= htmlspecialchars($event['difficulty'] ?? '') ?></p>
  <p><b>Description :</b><br><?= nl2br(htmlspecialchars($event['description'] ?? '')) ?></p>

  <p><b>Date :</b> <?= isset($event['date']) ? $event['date']->toDateTime()->format('Y-m-d H:i') : '' ?></p>

  <p>
    <a class="btn" href="/?page=reviews&action=create&type=activity&id=<?= $event['_id'] ?>">Ajouter un avis</a>
    <a class="btn2" href="/?page=events&action=list">Retour liste</a>
  </p>
</div>

<div class="card">
  <h2>Avis sur cette activité</h2>
  <?php if (count($reviews) === 0): ?>
    <p>Aucun avis pour le moment.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($reviews as $r): ?>
        <li>⭐ <?= (int)($r['rating'] ?? 0) ?>/5 — <?= htmlspecialchars($r['comment'] ?? '') ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
