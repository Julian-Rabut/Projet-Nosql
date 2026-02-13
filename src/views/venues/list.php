<?php $title="Lieux"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Lieux / Spots à La Réunion</h1>
  <p class="muted">Liste complète de la collection <b>venues</b>.</p>
  <p style="margin-top:10px;">
    <a class="btn" href="/?page=venues&action=create">+ Ajouter un lieu</a>
  </p>
</div>

<table>
  <tr>
    <th>Nom</th>
    <th>Ville</th>
    <th>Longitude</th>
    <th>Latitude</th>
    <th>Actions</th>
  </tr>

  <?php foreach ($venues as $v): ?>
    <?php
      $coords = $v['location']['coordinates'] ?? [null, null];
      $lng = $coords[0] ?? null;
      $lat = $coords[1] ?? null;
    ?>
    <tr>
      <td><?= htmlspecialchars($v['name'] ?? '') ?></td>
      <td><?= htmlspecialchars($v['city'] ?? '') ?></td>
      <td><?= htmlspecialchars((string)$lng) ?></td>
      <td><?= htmlspecialchars((string)$lat) ?></td>
      <td class="actions">
        <a class="btn2" href="/?page=venues&action=show&id=<?= $v['_id'] ?>">Détail</a>
        <a class="btn2" href="/?page=venues&action=edit&id=<?= $v['_id'] ?>">Modifier</a>
        <a class="danger" href="/?page=venues&action=delete&id=<?= $v['_id'] ?>">Supprimer</a>
        <a class="btn" href="/?page=reviews&action=create&type=venue&id=<?= $v['_id'] ?>">+ Avis</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
