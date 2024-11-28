<?php
// Inclure la connexion à la base de données
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../connexion.php");
    exit();
}

// Vérifier si l'identifiant est présent dans l'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Préparer et exécuter la requête de suppression
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script type="text/javascript">alert("✅Utilisateur supprimé");window.location=\'./dashboard.php\';</script>';
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID utilisateur non spécifié.";
}

$conn->close();
?>