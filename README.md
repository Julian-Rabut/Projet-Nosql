#  Activités à La Réunion — Projet NoSQL PHP & MongoDB

## Contexte
Ce projet est une application web permettant de découvrir, ajouter et noter des **activités et lieux touristiques à La Réunion**. 
 
Réalisé par :
Julian Rabut, Année 3 - UCO.

---

## Technologies utilisées
- PHP 8
- MongoDB
- HTML / CSS
- JavaScript + Leaflet (carte interactive)
- PHPUnit (tests unitaires)

---

## Collections MongoDB

| Collection | Rôle | Relations |
|-------------|------|-----------|
| users | Utilisateurs | liés aux activités et avis |
| venues | Lieux / spots (coordonnées GPS GeoJSON) | liés aux activités et avis |
| activities | Activités à faire | liées à un lieu + un utilisateur |
| reviews | Avis | liés soit à une activité soit à un lieu |

 Données complexes utilisées : **dates MongoDB UTCDateTime** et **coordonnées GPS GeoJSON**.

---

## Fonctionnalités

- CRUD complet sur users, venues, activities
- Ajout et affichage d’avis (reviews)
- Recherche et filtres (catégorie, difficulté, ville)
- Carte interactive affichant les lieux
- Données d’exemple générées automatiquement (seed)
- Tests unitaires PHPUnit

---

## Installation

### 1) Cloner le projet
git clone <url-du-repo>
cd reunion-events

### 2) Installer les dépendances
composer install

### 3) Vérifier que MongoDB est lancé
Service MongoDB actif sur mongodb://localhost:27017

### 4) Générer des données d’exemple
php seed_data.php

Lancer l’application :
php -S localhost:8000 -t public

Puis ouvrir dans le navigateur :

Accueil : http://localhost:8000/?page=home

Activités : http://localhost:8000/?page=events&action=list

Lieux : http://localhost:8000/?page=venues&action=list

Utilisateurs : http://localhost:8000/?page=users&action=list

Carte : http://localhost:8000/?page=map&action=view

Lancer les tests unitaires : vendor\bin\phpunit.bat