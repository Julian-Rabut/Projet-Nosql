<?php
// $pageTitle optionnel
$pageTitle = $pageTitle ?? "Réunion Events";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">

    <a class="brand" href="/?page=home">
      <div class="brand-mark"></div>
      <div class="brand-name">Réunion Events</div>
    </a>

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

<main class="container" style="padding:26px 0 10px;">
