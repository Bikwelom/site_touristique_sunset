<?php
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
    header("Location: ../connexion.php"); //sinon le renvoyer à la page de connexion
    exit();
}

// Récupérer les données du formulaire
$commentaire = $_POST['commentaire'];
$annonce_id = $_POST['annonce_id'];
$user_id = $_SESSION['id'];  // ID de l'utilisateur connecté

// Vérification que les champs ne sont pas vides
if (!empty($commentaire) && !empty($annonce_id)) {

    // Préparation de la requête SQL pour insérer le commentaire
    $stmt = $conn->prepare("INSERT INTO commentaires (contenu, annonce_id, utilisateur_id) VALUES (?, ?, ?)");
    $stmt->bind_param('sii', $commentaire, $annonce_id, $user_id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers la page d'accueil après succès
        header('Location: ./home.php');
        exit;
    } else {
        // En cas d'échec, affichage d'un message d'erreur
        echo "Erreur : Impossible d'ajouter le commentaire.";
    }
} else {
    // Si le formulaire n'est pas correctement rempli
    echo "Tous les champs sont obligatoires.";
}
?>