<?php
$title = "Supprimer activité";
require __DIR__ . '/../layout/header.php';
?>

<div class="card">
  <h1>Supprimer une activité</h1>

  <p>Confirmer la suppression de : <b><?= htmlspecialchars($event['title'] ?? '') ?></b></p>

  <form method="post">
    <button class="danger">Oui, supprimer</button>
    <a class="btn2" href="/?page=events&action=list">Annuler</a>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
