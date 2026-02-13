<?php $title="Supprimer utilisateur"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Supprimer un utilisateur</h1>
  <p>Confirmer la suppression de : <b><?= htmlspecialchars($user['name'] ?? '') ?></b></p>

  <form method="post">
    <button class="danger">Oui, supprimer</button>
    <a class="btn2" href="/?page=users&action=list">Annuler</a>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
