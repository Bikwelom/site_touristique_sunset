<?php
// Inclure la connexion à la base de données
include 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Préparer et exécuter la requête de sélection
    $stmt = $conn->prepare("SELECT id, nom, password, type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nom, $hashed_password, $type);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Vérifier le mot de passe
        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $id;
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $type;

            // Rediriger vers la page appropriée
            if ($type == 'admin') {
                header("Location: dashboard.php");
            } else {
                echo "Connexion réussie. <a href='profile.php'>Voir votre profil</a>";
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="post">
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
