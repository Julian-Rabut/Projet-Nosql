<?php
$title = $title ?? 'Activités Réunion';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="stylesheet" href="/assets/style.css">
  <style>
    body{font-family:Arial, sans-serif; margin:20px; background:#f7f7fb;}
    a{color:#0b5ed7; text-decoration:none}
    a:hover{text-decoration:underline}
    .nav{background:#fff; padding:12px 14px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.06); margin-bottom:14px;}
    .nav a{margin-right:12px; font-weight:bold}
    .card{background:#fff; padding:14px; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.06); margin-bottom:14px;}
    table{width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden}
    th,td{border-bottom:1px solid #eee; padding:10px; text-align:left; vertical-align:top}
    th{background:#fafafa}
    .btn{display:inline-block; padding:8px 10px; background:#0b5ed7; color:#fff; border-radius:8px}
    .btn:hover{text-decoration:none; opacity:.95}
    .btn2{display:inline-block; padding:8px 10px; background:#6c757d; color:#fff; border-radius:8px}
    .danger{display:inline-block; padding:8px 10px; background:#dc3545; color:#fff; border-radius:8px}
    .muted{color:#666}
    .row{display:flex; gap:12px; flex-wrap:wrap}
    .row > .card{flex:1; min-width:280px}
    input,select,textarea{width:100%; padding:8px; border:1px solid #ddd; border-radius:8px; background:#fff}
    textarea{resize:vertical}
    .actions a{margin-right:8px}
  </style>
</head>
<body>

<div class="nav">
  <a href="/?page=home">Accueil</a>
  <a href="/?page=events&action=list">Activités</a>
  <a href="/?page=venues&action=list">Lieux</a>
  <a href="/?page=users&action=list">Utilisateurs</a>
  <a href="/?page=reviews&action=list">Avis</a>
  <a href="/?page=map&action=view">Carte</a>
</div>
