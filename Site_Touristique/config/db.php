<?php
$servername = "localhost";
$username = "root"; //identifiant 
$password = ""; //mot de passe
$dbname = "michee"; //nom de la base des données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>