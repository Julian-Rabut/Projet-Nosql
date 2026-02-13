<?php $title="Supprimer avis"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Supprimer un avis</h1>
  <p>Confirmer la suppression de l’avis : <b><?= htmlspecialchars($reviewId ?? '') ?></b></p>

  <form method="post">
    <button class="danger">Oui, supprimer</button>
    <a class="btn2" href="/?page=reviews&action=list">Annuler</a>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
