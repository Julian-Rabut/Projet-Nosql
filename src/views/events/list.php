<?php
require_once __DIR__ . '/../../models/ReviewModel.php';
require_once __DIR__ . '/../../models/VenueModel.php';

$reviewModel = new ReviewModel();
$venueModel  = new VenueModel();

$title = "Activités";
$pageTitle = "Événements"; require __DIR__ . '/../layout/header.php';


$selectedCat = trim($filters['category'] ?? '');
$selectedDiff = trim($filters['difficulty'] ?? '');
$selectedCity = trim($filters['city'] ?? '');
?>

<div class="card">
  <h1>Activités à faire à La Réunion</h1>
  <p class="muted">Recherche + filtres (catégorie, difficulté, ville).</p>

  <form method="get" style="margin-top:10px;">
    <input type="hidden" name="page" value="events">
    <input type="hidden" name="action" value="list">

    <div class="row" style="align-items:end;">
      <div style="flex:2; min-width:220px;">
        <label>Recherche</label>
        <input name="q" placeholder="titre ou catégorie" value="<?= htmlspecialchars($filters['q'] ?? '') ?>">
      </div>

      <div style="flex:1; min-width:180px;">
        <label>Catégorie</label>
        <select name="category">
          <option value="">(toutes)</option>
          <?php foreach ($categories as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>" <?= $c===$selectedCat?'selected':'' ?>>
              <?= htmlspecialchars($c) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="flex:1; min-width:180px;">
        <label>Difficulté</label>
        <select name="difficulty">
          <option value="">(toutes)</option>
          <?php foreach ($difficulties as $d): ?>
            <option value="<?= htmlspecialchars($d) ?>" <?= $d===$selectedDiff?'selected':'' ?>>
              <?= htmlspecialchars($d) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="flex:1; min-width:180px;">
        <label>Ville</label>
        <select name="city">
          <option value="">(toutes)</option>
          <?php foreach ($cities as $city): ?>
            <option value="<?= htmlspecialchars($city) ?>" <?= $city===$selectedCity?'selected':'' ?>>
              <?= htmlspecialchars($city) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div style="flex:1; min-width:140px;">
        <button class="btn">Appliquer</button>
      </div>

      <div style="flex:1; min-width:220px;">
        <a class="btn" href="/?page=events&action=create">+ Ajouter une activité</a>
      </div>
    </div>

    <div style="margin-top:10px;">
      <a class="btn2" href="/?page=events&action=list">Réinitialiser</a>
    </div>
  </form>
</div>

<table>
  <tr>
    <th>Nom</th>
    <th>Catégorie</th>
    <th>Durée</th>
    <th>Difficulté</th>
    <th>Lieu</th>
    <th>Date</th>
    <th>Actions</th>
  </tr>

  <?php foreach ($events as $e): ?>
    <?php
      $venueLabel = "—";
      if (isset($e['venueId'])) {
        $venue = $venueModel->findById((string)$e['venueId']);
        if ($venue) $venueLabel = ($venue['name'] ?? '') . " (" . ($venue['city'] ?? '') . ")";
      }

      $activityId = (string)$e['_id'];
      $reviews = $reviewModel->allByTarget('activity', $activityId);
    ?>

    <tr>
      <td>
        <a href="/?page=events&action=show&id=<?= $e['_id'] ?>">
          <?= htmlspecialchars($e['title'] ?? '') ?>
        </a>
      </td>
      <td><?= htmlspecialchars($e['category'] ?? '') ?></td>
      <td><?= htmlspecialchars($e['duration'] ?? '') ?></td>
      <td><?= htmlspecialchars($e['difficulty'] ?? '') ?></td>
      <td><?= htmlspecialchars($venueLabel) ?></td>
      <td><?= isset($e['date']) ? $e['date']->toDateTime()->format('Y-m-d H:i') : '' ?></td>
      <td class="actions">
        <a class="btn2" href="/?page=events&action=edit&id=<?= $e['_id'] ?>">Modifier</a>
        <a class="danger" href="/?page=events&action=delete&id=<?= $e['_id'] ?>">Supprimer</a>
      </td>
    </tr>

    <tr>
      <td colspan="7">
        <b>Avis :</b>
        <?php if (count($reviews) === 0): ?>
          <span class="muted">Aucun avis</span>
        <?php else: ?>
          <ul style="margin:8px 0 8px 18px;">
            <?php foreach ($reviews as $r): ?>
              <li>⭐ <?= (int)($r['rating'] ?? 0) ?>/5 — <?= htmlspecialchars($r['comment'] ?? '') ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <a class="btn" href="/?page=reviews&action=create&type=activity&id=<?= $e['_id'] ?>">+ Ajouter un avis</a>
      </td>
    </tr>

  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
