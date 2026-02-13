<?php
$pageTitle = "Utilisateurs"; require __DIR__ . '/../layout/header.php';;
?>

<div class="card">
  <h1>Utilisateurs</h1>
  <p class="muted">Liste complète de la collection <b>users</b>.</p>

  <p style="margin-top:10px;">
    <a class="btn" href="/?page=users&action=create">+ Ajouter un utilisateur</a>
  </p>
</div>

<table>
  <tr>
    <th>Nom</th>
    <th>Email</th>
    <th>ID</th>
    <th>Actions</th>
  </tr>

  <?php foreach ($users as $u): ?>
    <tr>
      <td><?= htmlspecialchars($u['name'] ?? '') ?></td>
      <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
      <td><?= htmlspecialchars((string)$u['_id']) ?></td>
      <td class="actions">
        <a class="btn2" href="/?page=users&action=edit&id=<?= $u['_id'] ?>">Modifier</a>
        <a class="danger" href="/?page=users&action=delete&id=<?= $u['_id'] ?>">Supprimer</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>
