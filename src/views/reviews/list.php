<?php $pageTitle = "Avis"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Avis (tous)</h1>
  <p class="muted">Liste complète de la collection <b>reviews</b>.</p>
</div>

<table>
  <tr>
    <th>Type</th>
    <th>TargetId</th>
    <th>Note</th>
    <th>Commentaire</th>
    <th>Date</th>
    <th>Actions</th>
  </tr>

  <?php foreach ($reviews as $r): ?>
    <tr>
      <td><?= htmlspecialchars($r['targetType'] ?? '') ?></td>
      <td><?= htmlspecialchars((string)($r['targetId'] ?? '')) ?></td>
      <td>⭐ <?= (int)($r['rating'] ?? 0) ?>/5</td>
      <td><?= htmlspecialchars($r['comment'] ?? '') ?></td>
      <td><?= isset($r['createdAt']) ? $r['createdAt']->toDateTime()->format('Y-m-d H:i') : '' ?></td>
      <td class="actions">
        <a class="danger" href="/?page=reviews&action=delete&id=<?= $r['_id'] ?>">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
