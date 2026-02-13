</main>

<footer class="footer">
  <div class="container footer-grid">
    <div>
      <div class="brand brand-footer">
        <span class="brand-mark" aria-hidden="true"></span>
        <span class="brand-name">Réunion Events</span>
      </div>
      <p class="muted">Projet PHP + MongoDB — CRUD + recherche + carte</p>
    </div>

    <div>
      <h4>Navigation</h4>
      <a href="/?page=events&action=list">Événements</a>
      <a href="/?page=venues&action=list">Lieux</a>
      <a href="/?page=map">Carte</a>
      <a href="/?page=reviews&action=list">Avis</a>
    </div>

    <div>
      <h4>Actions</h4>
      <a href="/?page=events&action=add">Ajouter un événement</a>
      <a href="/?page=venues&action=add">Ajouter un lieu</a>
    </div>
  </div>

  <div class="container footer-bottom">
    <span class="muted">© <?= date('Y') ?> — Tous droits réservés</span>
  </div>
</footer>

</body>
</html>
