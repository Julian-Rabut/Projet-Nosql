<?php
/** @var string $pageTitle */
/** @var string $activePage */
$pageTitle = $pageTitle ?? 'Projet Réunion';
$activePage = $activePage ?? '';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="/assets/style.css" />
</head>
<body class="<?= htmlspecialchars($activePage) ?>">
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/?page=home">
      <span class="brand-mark" aria-hidden="true"></span>
      <span class="brand-name">Réunion Events</span>
    </a>

    <nav class="nav" aria-label="Navigation principale">
      <a class="<?= $activePage==='public'?'is-active':'' ?>" href="/">Accueil</a>
      <a class="<?= $activePage==='events'?'is-active':'' ?>" href="/?page=events&action=list">Événements</a>
      <a class="<?= $activePage==='venues'?'is-active':'' ?>" href="/?page=venues&action=list">Lieux</a>
      <a class="<?= $activePage==='map'?'is-active':'' ?>" href="/?page=map">Carte</a>
      <a class="<?= $activePage==='reviews'?'is-active':'' ?>" href="/?page=reviews&action=list">Avis</a>
      <a class="<?= $activePage==='users'?'is-active':'' ?>" href="/?page=users&action=list">Utilisateurs</a>
    </nav>

  </div>
</header>

<main class="main">
