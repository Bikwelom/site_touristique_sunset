<?php
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
    header("Location: ../connexion.php"); //sinon le renvoyer à la page de connexion
    exit();
}
// Récupérer l'ID de la réservation
$reservation_id = $_GET['id'];

// Suppression de la réservation
$conn->query("DELETE FROM reservation WHERE id = $reservation_id");

// Redirection vers la page des réservations de l'utilisateur
header('Location: ./reservation_list.php');
exit;