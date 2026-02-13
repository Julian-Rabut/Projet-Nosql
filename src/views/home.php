<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Réunion Events</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ton CSS -->
  <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

<!-- HEADER -->
<header class="site-header">
  <div class="container header-inner">

    <div class="brand">
      <div class="brand-mark"></div>
      <div class="brand-name">Réunion Events</div>
    </div>

    <nav class="nav">
      <a href="/?page=home">Accueil</a>
      <a href="/?page=events&action=list">Événements</a>
      <a href="/?page=venues&action=list">Lieux</a>
      <a href="/?page=map">Carte</a>
      <a href="/?page=reviews&action=list">Avis</a>
      <a href="/?page=users&action=list">Utilisateurs</a>
    </nav>


  </div>
</header>


<!-- HERO AVEC IMAGE -->
<section class="hero">

  <div class="hero-overlay"></div>

  <div class="container hero-content">

    <p class="hero-kicker">Île de La Réunion</p>

    <h1 class="hero-title">
      Activités à La Réunion
    </h1>

    <p class="hero-subtitle">
      Application NoSQL (PHP + MongoDB)
    </p>

    <p class="hero-subtitle">
      Découvrez, ajoutez et notez les meilleures activités et lieux.
    </p>


      <div class="home-cards">
        <a class="home-card c1" href="/?page=events&action=list">
          <span>Voir les activités</span>
        </a>

        <a class="home-card c2" href="/?page=venues&action=list">
          <span>Voir les lieux</span>
        </a>

        <a class="home-card c3" href="/?page=map">
          <span>Voir la carte</span>
        </a>
      </div>


  </div>

</section>


<!-- FOOTER -->
<footer class="footer">

  <div class="container footer-grid">

    <div>
      <div class="brand">
        <div class="brand-mark"></div>
        <div class="brand-name">Réunion Events</div>
      </div>

      <p class="muted">
        Projet PHP + MongoDB — CRUD + recherche + carte
      </p>
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
    © 2026 — Tous droits réservés
  </div>

</footer>


</body>
</html>
