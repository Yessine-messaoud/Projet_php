<?php
require 'db.php';

// Vérifier si l'ID du livre est passé en paramètre
if (!isset($_GET['id'])) {
    die('ID du livre non spécifié.');
}

// Récupérer l'ID du livre
$id = $_GET['id'];

// Récupérer les informations actuelles du livre
$sql = "SELECT * FROM Livres WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$livre = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le livre existe
if (!$livre) {
    die('Livre non trouvé.');
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $annee_publication = $_POST['annee_publication'];
    $statut = isset($_POST['statut']) ? 1 : 0;
    $note = $_POST['note'];

    // Mettre à jour le livre dans la base de données
    $sql = "UPDATE Livres SET titre = ?, auteur = ?, annee_publication = ?, statut = ?, note = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $auteur, $annee_publication, $statut, $note, $id]);

    // Redirection vers la page d'accueil après la mise à jour
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="edit_book.css">

<head>
    <meta charset="UTF-8">
    <title>Modifier un Livre</title>
</head>
<body>
    <h1>Modifier le Livre</h1>
    <form method="post">
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>

        <label>Auteur :</label>
        <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>

        <label>Année de publication :</label>
        <input type="number" name="annee_publication" value="<?= htmlspecialchars($livre['annee_publication']) ?>" required>

        <label>Statut :</label>
        <input type="checkbox" name="statut" <?= $livre['statut'] ? 'checked' : '' ?>> Lu

        <label>Note :</label>
        <input type="number" name="note" min="1" max="5" value="<?= htmlspecialchars($livre['note']) ?>" required>

        <button type="submit">Enregistrer les modifications</button>
    </form>
    <a href="index.php">Annuler</a>
</body>
</html>
