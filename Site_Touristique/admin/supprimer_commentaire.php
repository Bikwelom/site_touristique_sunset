<?php
session_start();
require_once '../config/db.php';  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../connexion.php");
    exit();
}
// Vérifier si l'ID du commentaire est présent et est un entier valide
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $commentaire_id = intval($_GET['id']);

    // Préparer la requête pour supprimer le commentaire
    $stmt = $conn->prepare("DELETE FROM commentaires WHERE id = ?");
    $stmt->bind_param("i", $commentaire_id);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection vers la page précédente si la suppression est réussie
        echo  '<script type="text/javascript">alert("Commentaire supprimer ✅");window.location=\'./home.php\';</script>';
        exit;
    } else {
        echo  '<script type="text/javascript">alert("Erreur lors de la suppression du commentaire. ❌");window.location=\'./home.php\';</script>';
    }

    // Fermer la requête préparée
    $stmt->close();
} else {
    echo  '<script type="text/javascript">alert("ID de commentaire non valide. ⚠️");window.location=\'./home.php\';</script>';
}
?>
