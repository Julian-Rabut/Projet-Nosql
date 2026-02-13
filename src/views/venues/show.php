<?php $title="Lieu"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1><?= htmlspecialchars($venue['name'] ?? '') ?></h1>
  <p><b>Ville :</b> <?= htmlspecialchars($venue['city'] ?? '') ?></p>

  <?php
    $coords = $venue['location']['coordinates'] ?? [null, null];
    $lng = $coords[0] ?? null;
    $lat = $coords[1] ?? null;
  ?>
  <p><b>GPS :</b> <?= htmlspecialchars((string)$lat) ?>, <?= htmlspecialchars((string)$lng) ?></p>

  <p>
    <a class="btn" href="/?page=reviews&action=create&type=venue&id=<?= $venue['_id'] ?>">Ajouter un avis sur ce lieu</a>
    <a class="btn2" href="/?page=venues&action=list">Retour</a>
  </p>
</div>

<div class="card">
  <h2>Avis sur ce lieu</h2>
  <?php if (count($reviews) === 0): ?>
    <p>Aucun avis.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($reviews as $r): ?>
        <li>⭐ <?= (int)($r['rating'] ?? 0) ?>/5 — <?= htmlspecialchars($r['comment'] ?? '') ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
