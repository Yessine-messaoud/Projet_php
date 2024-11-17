<?php
$host = 'localhost';
$dbname = 'biblio';  // Nom de la base de données créée
$username = 'root';   // Nom d'utilisateur par défaut de MySQL dans XAMPP
$password = '';       // Mot de passe vide par défaut pour MySQL dans XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connexion réussie à la base de données!";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
