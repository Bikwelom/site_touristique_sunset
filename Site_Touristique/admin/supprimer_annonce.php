<?php
session_start();
require_once '../config/db.php';  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../connexion.php");
    exit();
}
// Vérifier si l'ID de l'annonce est valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $annonce_id = intval($_GET['id']);

    // Supprimer l'annonce
    $stmt = $conn->prepare("DELETE FROM annonces WHERE id = ?");
    $stmt->bind_param("i", $annonce_id);

    if ($stmt->execute()) {
        // Supprimer les commentaires associés à cette annonce (facultatif)
        $stmt_comments = $conn->prepare("DELETE FROM commentaires WHERE annonce_id = ?");
        $stmt_comments->bind_param("i", $annonce_id);
        $stmt_comments->execute();

        // Redirection après suppression
        echo  '<script type="text/javascript">alert("Annonce supprimer ✅");window.location=\'./home.php\';</script>';
        exit;
    } else {
        echo  '<script type="text/javascript">alert("Erreur lors de la suppression de l\'annonce ❌");window.location=\'./home.php\';</script>';
    }

    $stmt->close();
} else {
    echo  '<script type="text/javascript">alert("ID d\'annonce non valide. ⚠️");window.location=\'./home.php\';</script>';
}
?>