<?php
session_start();
require_once '../config/db.php';  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../connexion.php");
    exit();
}

// Vérifier si l'identifiant est présent dans l'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Préparer et exécuter la requête de suppression
    $stmt = $conn->prepare("DELETE FROM reservation WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo  '<script type="text/javascript">alert("Réservation annuler ✅");window.location=\'./reservation_list.php\';</script>';
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID utilisateur non spécifié.";
}

$conn->close();
?>