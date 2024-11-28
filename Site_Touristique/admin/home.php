<?php
session_start();
require_once '../config/db.php';  // Connexion à la base de données

// Récupérer les annonces pour les utilisateurs
$annonces = $conn->query("SELECT * FROM annonces");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Admin</title>

</head>
<body>

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
    min-height:100dvh;
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
    width: 90%;
    /* background-color:red; */
    height:90dvh;
    display:flex;
    flex-flow:column;
    padding:20px;
    gap:1em;

    .content-card-blog{
        /* background-color:yellow; */
        display:flex;
        justify-content:center;
        align-items:center;
        gap:1em;

        .card{
    background-color:#ffffff;
    width: 340px;
    height:480px;
    display:flex;
    flex-flow:column;
    gap:1em;
    padding:5px;
    border-radius:7px;
    /* image contenu dans le cards */
    img{
        width: 100%;
        height:200px;
    }
        }
        a{
    background-color:#fca311;
    text-decoration:none;
    color:black;
    padding:8px;

 }
        /* card contenu */
        .card-body{
    display:flex;
    flex-flow:column;
    gap:0.6em;
    padding-left:4px;

    /* bouton commenter */
    .btn{
        background-color:#fca311;
        border:none;
        padding:6px 10px;
        border-radius:8px;
    }
    textarea{
        padding:10px;
    }
        }
    }
}
footer{
    font-size:24px;
    height:10dvh;
    display:flex;
    justify-content:center;
    align-items:center;
 }
</style>

<nav>
    <div class="logo"><p>sunset</p></div>
    <ul>
        <li><a href="publier_annonce.php">Publier un blog</a></li>
        <li><a href="dashboard.php">Gestion Utilisateurs</a></li>
        <li><a href="reservation_list.php">Gestion Réservations</a></li>
        <li><a href="../config/logout.php">Déconnexion</a></li>
    </ul>
</nav>

<div class="container">
    <h1>Listes des Annonces</h1>
   
    <div class="content-card-blog">
    <?php
    while ($row = $annonces->fetch_assoc()) {
        $annonceId = $row['id'];
    ?>
        <div class="card">
        <img width='25%' src="<?= $row['photo']; ?>" class="card-img-top" alt="<?= $row['titre']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $row['titre']; ?></h5>
                 <h5 class="card-title"><?= $row['prix']; ?></h5>
                <p class="card-text"><?= $row['description']; ?></p>
                <a href="supprimer_annonce.php?id=<?= $annonceId; ?>" class="btn">Supprimer l'annonce</a>
                <h3>Commentaires</h3>

                <?php
                // Récupérer les commentaires pour cette annonce
                $commentaires = $conn->query("SELECT c.id AS commentaire_id, c.contenu, u.nom FROM commentaires c JOIN users u ON c.utilisateur_id = u.id WHERE c.annonce_id = $annonceId LIMIT 5");

                if ($commentaires) {
                    while ($commentaire = $commentaires->fetch_assoc()) {
                        $commentaireId = $commentaire['commentaire_id'];
                        echo "<p><strong>{$commentaire['nom']}</strong>: {$commentaire['contenu']}</p>";
                        // Lien de suppression
                        echo "<a href='supprimer_commentaire.php?id=$commentaireId' class='btn btn-danger btn-sm'>Supprimer</a>";
                    }
                } else {
                    echo "<p>Erreur lors de la récupération des commentaires : " . $conn->error . "</p>";
                }
                ?>

                <!-- Formulaire pour ajouter un commentaire -->
                <form action="ajouter_commentaire.php" method="POST">
                    <input type="hidden" name="annonce_id" value="<?= $annonceId; ?>">
                    <div class="form-group">
                        <textarea name="commentaire" class="form-control" placeholder="Ajoutez un commentaire..." required></textarea>
                    </div>
                    <button type="submit" class="btn">Commenter</button>
                </form>

            </div>
        </div>
    <?php } ?>
    </div>
</div>
<footer><p>@Developée par Michée Bikwelo</p></footer>

</body>
</html>