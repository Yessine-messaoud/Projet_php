<?php
require 'db.php'; // Inclut le fichier de connexion

// Récupérer tous les livres
$sql = "SELECT * FROM Livres";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="index.css">

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Bibliothèque</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Ma Collection de Livres</h1>
    <a href="add_book.php">Ajouter un nouveau livre</a>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Année de publication</th>
                <th>Statut</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livres as $livre): ?>
                <tr>
                    <td><?= htmlspecialchars($livre['titre']) ?></td>
                    <td><?= htmlspecialchars($livre['auteur']) ?></td>
                    <td><?= htmlspecialchars($livre['annee_publication']) ?></td>
                    <td><?= $livre['statut'] ? 'Lu' : 'Non lu' ?></td>
                    <td><?= htmlspecialchars($livre['note']) ?> / 5</td>
                    <td>
                        <a href="edit_book.php?id=<?= $livre['id'] ?>">Modifier</a>
                        <a href="delete_book.php?id=<?= $livre['id'] ?>">Supprimer</a>
                        <a href="view_book.php?id=<?= $livre['id'] ?>">Détails</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
