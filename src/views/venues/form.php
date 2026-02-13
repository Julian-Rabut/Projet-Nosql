<?php
$title = $venue ? "Modifier un lieu" : "Ajouter un lieu";
require __DIR__ . '/../layout/header.php';

$coords = $venue['location']['coordinates'] ?? [null, null];
$lng = $coords[0] ?? '';
$lat = $coords[1] ?? '';
?>

<div class="card">
  <h1><?= $venue ? "Modifier" : "Ajouter" ?> un lieu</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red;"><b><?= htmlspecialchars($error) ?></b></p>
  <?php endif; ?>

  <form method="post">
    <div>
      <label>Nom</label>
      <input name="name" required value="<?= htmlspecialchars($venue['name'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Ville</label>
      <input name="city" required value="<?= htmlspecialchars($venue['city'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Longitude</label>
      <input name="lng" value="<?= htmlspecialchars((string)$lng) ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Latitude</label>
      <input name="lat" value="<?= htmlspecialchars((string)$lat) ?>">
    </div>

    <div style="margin-top:12px;">
      <button class="btn">Enregistrer</button>
      <a class="btn2" href="/?page=venues&action=list">Retour</a>
    </div>
  </form>

  <p class="muted" style="margin-top:10px;">GPS = bonus (GeoJSON Point).</p>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
