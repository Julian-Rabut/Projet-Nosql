<?php
$title = $user ? "Modifier utilisateur" : "Ajouter utilisateur";
require __DIR__ . '/../layout/header.php';
?>

<div class="card">
  <h1><?= $user ? "Modifier" : "Ajouter" ?> un utilisateur</h1>

  <?php if (!empty($error)): ?>
    <p style="color:red;"><b><?= htmlspecialchars($error) ?></b></p>
  <?php endif; ?>

  <form method="post">
    <div>
      <label>Nom</label>
      <input name="name" required value="<?= htmlspecialchars($user['name'] ?? '') ?>">
    </div>

    <div style="margin-top:10px;">
      <label>Email</label>
      <input name="email" required value="<?= htmlspecialchars($user['email'] ?? '') ?>">
    </div>

    <div style="margin-top:12px;">
      <button class="btn">Enregistrer</button>
      <a class="btn2" href="/?page=users&action=list">Retour</a>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
