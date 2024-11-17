<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee_publication = $_POST['annee_publication'];
    $statut = isset($_POST['statut']) ? 1 : 0;
    $note = $_POST['note'];

    $sql = "INSERT INTO Livres (titre, auteur, annee_publication, statut, note) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $auteur, $annee_publication, $statut, $note]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="add_book.css">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Livre</title>
</head>
<body>
    <h1>Ajouter un Nouveau Livre</h1>
    <form method="post">
        <label>Titre :</label>
        <input type="text" name="titre" required>
        <label>Auteur :</label>
        <input type="text" name="auteur" required>
        <label>Année de publication :</label>
        <input type="number" name="annee_publication" required>
        <label>Statut :</label>
        <input type="checkbox" name="statut"> Lu
        <label>Note :</label>
        <input type="number" name="note" min="1" max="5" required>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
