<?php $title = "Ajouter un avis"; require __DIR__ . '/../layout/header.php'; ?>

<div class="card">
  <h1>Ajouter un avis</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red;"><b>Erreur :</b> <?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post">
    <input type="hidden" name="targetType" value="<?= htmlspecialchars($targetType) ?>">
    <input type="hidden" name="targetId" value="<?= htmlspecialchars($targetId) ?>">
    <input type="hidden" name="userId" value="<?= htmlspecialchars($defaultUserId) ?>">

    <div>
      <label>Note</label><br>
      <select name="rating">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected>3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
    </div>

    <div style="margin-top:10px;">
      <label>Commentaire</label><br>
      <textarea name="comment" rows="4" placeholder="Ton avis..."></textarea>
    </div>

    <div style="margin-top:10px;">
      <button class="btn">Envoyer</button>
      <a class="btn2" href="/?page=home">Retour</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
