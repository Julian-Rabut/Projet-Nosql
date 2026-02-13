<?php
$title = $event ? "Modifier une activité" : "Créer une activité";
require __DIR__ . '/../layout/header.php';

$selectedVenue = isset($event['venueId']) ? (string)$event['venueId'] : '';
$selectedUser  = isset($event['createdBy']) ? (string)$event['createdBy'] : '';
?>

<div class="card">
  <h1><?= $event ? "Modifier" : "Créer" ?> une activité</h1>

  <form method="post">
    <div>
      <label>Nom de l’activité</label>
      <input name="title" required value="<?= htmlspecialchars($event['title'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Catégorie</label>
      <input name="category" required placeholder="rando, plage, cascade..."
             value="<?= htmlspecialchars($event['category'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Durée</label>
      <input name="duration" placeholder="ex: 2h, demi-journée, journée"
             value="<?= htmlspecialchars($event['duration'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Difficulté</label>
      <?php $d = $event['difficulty'] ?? 'facile'; ?>
      <select name="difficulty">
        <option value="facile" <?= $d==='facile'?'selected':'' ?>>facile</option>
        <option value="moyen" <?= $d==='moyen'?'selected':'' ?>>moyen</option>
        <option value="difficile" <?= $d==='difficile'?'selected':'' ?>>difficile</option>
      </select>
    </div>

    <div style="margin-top:10px;">
      <label>Description</label>
      <textarea name="description" rows="4"><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
    </div>

    <div style="margin-top:10px;">
      <label>Date (optionnel)</label>
      <input name="date" placeholder="2026-02-01 18:30"
        value="<?php if (isset($event['date'])) echo $event['date']->toDateTime()->format('Y-m-d H:i'); ?>">
      <small class="muted">Tu peux laisser vide.</small>
    </div>

    <div style="margin-top:10px;">
      <label>Lieu</label>
      <select name="venueId" required>
        <?php foreach ($venues as $v): ?>
          <?php $vid = (string)$v['_id']; ?>
          <option value="<?= htmlspecialchars($vid) ?>" <?= $vid===$selectedVenue ? 'selected' : '' ?>>
            <?= htmlspecialchars(($v['name'] ?? '') . " (" . ($v['city'] ?? '') . ")") ?>
          </option>
        <?php endforeach; ?>
      </select>
      <small class="muted">Si la liste est vide, ajoute un lieu d’abord.</small>
    </div>

    <div style="margin-top:10px;">
      <label>Créé par</label>
      <select name="createdBy" required>
        <?php foreach ($users as $u): ?>
          <?php $uid = (string)$u['_id']; ?>
          <option value="<?= htmlspecialchars($uid) ?>" <?= $uid===$selectedUser ? 'selected' : '' ?>>
            <?= htmlspecialchars($u['name'] ?? '') ?>
          </option>
        <?php endforeach; ?>
      </select>
      <small class="muted">Si la liste est vide, ajoute un utilisateur d’abord.</small>
    </div>

    <div style="margin-top:12px;">
      <button class="btn">Enregistrer</button>
      <a class="btn2" href="/?page=events&action=list">Retour</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
