<?php
// Inclure la connexion à la base de données
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier la longueur du mot de passe
    if (strlen($password) < 6) {
        echo "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO users (nom, email, password, type) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $nom, $email, $hashed_password);

        if ($stmt->execute()) {
            echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="post">
        Nom: <input type="text" name="nom" required><br>
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>