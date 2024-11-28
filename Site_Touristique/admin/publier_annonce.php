<?php
session_start();
require_once '../config/db.php';  // Connexion à la base de données

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin') {
    header("Location: ../connexion.php");
    exit();
}
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = htmlspecialchars($_POST['titre']);
    $price = htmlspecialchars($_POST['prix']);
    
    //Nous ajoutons le symbole dollars après avoir récupéré le tarif
    $prix = $price . '$';
    $description = htmlspecialchars($_POST['description']);
    
    // Gérer l'upload de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photoTmp = $_FILES['photo']['tmp_name'];
        $photoName = basename($_FILES['photo']['name']);
        $photoDestination = '../uploads/' . $photoName;

        // Déplacer la photo uploadée dans le dossier "uploads"
        if (move_uploaded_file($photoTmp, $photoDestination)) {
            // Insérer les données dans la table annonces
            $stmt = $conn->prepare("INSERT INTO annonces (titre,prix, description, photo, date_publication) VALUES (?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssss", $titre,$prix, $description, $photoDestination);

            if ($stmt->execute()) {
                echo  '<script type="text/javascript">alert("Annonce ajoutée avec succès! ✅");window.location=\'./home.php\';</script>';
            } else {
                echo  '<script type="text/javascript">alert("Erreur lors de l\'ajout de l\'annonce ❌");window.location=\'./publier_annonce.php\';</script>';
            }
            $stmt->close();
        } else {
            echo  '<script type="text/javascript">alert("Erreur lors du téléchargement de la photo. ❌");window.location=\'./publier_annonce.php\';</script>';
        }
    } else {
        echo  '<script type="text/javascript">alert("Veuillez sélectionner une photo. ⚠️");window.location=\'./publier_annonce.php\';</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Publication annonce</title>
    <link rel="stylesheet" href="style.css">
    <style>
              *,
    ::before,
    ::after {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
    }

    
    /* integration de la police telecharger  */

@font-face {
    font-family: 'Chivo';
    src: url('fonts/static/Chivo-ExtraBold.ttf') format('ttf'),
         url('fonts/static/Chivo-ExtraBoldItalic.ttf') format('ttf');
    font-weight:900;
    font-style: normal;
}
 body{
    min-height:120dvh;
    display:flex;
    flex-flow:column;
    align-items:center;
    background-color:#d8e2dc;
    gap:1em;
    font-family: 'Chivo',sans-serif;
 }
 
 nav{
    /* background-color:red; */
    height:10dvh;
    width: 100%;
    display:flex;
    justify-content:space-around;
    align-items:center;
 }
 .logo{
    font-size:24px;
 }
 ul{
    display:flex;
    justify-content:center;
    align-items:center; 
    gap:1.5em;
    width: 60%;
    list-style-type:none;

    li a{
        text-decoration:none;
        color:black;
        font-size:20px;
    }
 }

 .container{
    width:90%;
    height:100dvh;
    background-color:#ffffff;
    display:flex;
    flex-flow:column;
    /* justify-content:center; */
    align-items:center;
    gap:1em;
    padding:10px;
    
 }

 form{
    width:80%;
    height:90dvh;
    display:flex;
    flex-flow:column;
    justify-content:center;
    align-items:center;
    gap:1em;
    font-family: 'Chivo',sans-serif;

 }
.form-group{
    display:flex;
    flex-flow:column;
    gap:0.6em;

    input{
        width: 500px;
        height:50px;
    font-family: 'Chivo',sans-serif;

    }
}

textarea{
    height:150px;
    width: 500px;
}
.btn-publier{
    width: 400px;
    padding:10px;
    background-color:#fca311;
    border:none;
}
    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="home.php">Accueil</a></li>
        <li><a href="dashboard.php">Gestion Utilisateurs</a></li>
        <li><a href="reservation_list.php">Gestion Réservations</a></li>
        <li><a href="../config/logout.php">Déconnexion</a></li>
    </ul>
</nav>

    <div class="container">
        <h1>Ajouter une annonce</h1>

        <!-- Formulaire d'ajout d'annonce -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre de l'annonce</label>
                <input type="text" name="titre" class="form-control" required placeholder="Entrez le titre">
            </div>
            <div class="form-group">
            <label for="prix">Tarif de l'annonce</label>
            	<input type="number" name="prix" class="form-control" required placeholder="Entrer un montant">
            </div>
            <div class="form-group">
                <label for="description">Description de l'annonce</label>
                <textarea name="description" class="form-control" required placeholder="Décrivez votre annonce "></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Photo d'illustration de l'annonce</label>
                <input type="file" name="photo" class="form-control" required>
            </div>
            <button type="submit" class="btn-publier">Publier</button>
        </form>

        <hr>

    </div>

</body>
</html>