<?php
require 'db.php';

// Vérifier si l'ID du livre est passé en paramètre
if (!isset($_GET['id'])) {
    die('ID du livre non spécifié.');
}

// Récupérer l'ID du livre
$id = $_GET['id'];

// Récupérer les informations du livre à partir de la base de données
$sql = "SELECT * FROM Livres WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le livre existe
if (!$livre) {
    die('Livre non trouvé.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="view_book.css">

<head>
    <meta charset="UTF-8">
    <title>Détails du Livre</title>
</head>
<body>
    <h1>Détails du Livre</h1>
    
    <p><strong>Titre :</strong> <?= htmlspecialchars($livre['titre']) ?></p>
    <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
    <p><strong>Année de publication :</strong> <?= htmlspecialchars($livre['annee_publication']) ?></p>
    <p><strong>Statut :</strong> <?= $livre['statut'] ? 'Lu' : 'Non lu' ?></p>
    <p><strong>Note :</strong> <?= htmlspecialchars($livre['note']) ?> / 5</p>

    <a href="edit_book.php?id=<?= $livre['id'] ?>">Modifier</a> | 
    <a href="index.php">Retour à la liste des livres</a>
</body>
</html>
