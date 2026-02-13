<?php $title = "Accueil"; require __DIR__ . '/../layout/header.php'; ?>

<div class="row">
  <div class="card">
    <h2>Bienvenue 👋</h2>
    <p>Application “Activités à faire à La Réunion” (MongoDB + PHP).</p>
    <p class="muted">Tu peux gérer activités, lieux, utilisateurs, avis, et visualiser sur une carte.</p>
  </div>

  <div class="card">
    <h2>Stats</h2>
    <ul>
      <li>Activités : <b><?= (int)$counts['activities'] ?></b></li>
      <li>Lieux : <b><?= (int)$counts['venues'] ?></b></li>
      <li>Utilisateurs : <b><?= (int)$counts['users'] ?></b></li>
      <li>Avis : <b><?= (int)$counts['reviews'] ?></b></li>
    </ul>
  </div>
</div>

<div class="card">
  <h2>Accès rapide</h2>
  <p>
    <a class="btn" href="/?page=events&action=create">+ Ajouter une activité</a>
    <a class="btn" href="/?page=venues&action=create">+ Ajouter un lieu</a>
    <a class="btn" href="/?page=map&action=view">Voir la carte</a>
  </p>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
