<?php
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
    header("Location: ../connexion.php"); //sinon le renvoyer à la page de connexion
    exit();
}
// Récupérer les annonces pour les utilisateurs
$annonces = $conn->query("SELECT * FROM annonces");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Utilisateur</title>
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
        justify-content:center;
        align-items:center;
        flex-flow:column;
        background-color:#d8e2dc;
        font-family: 'Chivo',sans-serif;
    }
    header{
     /* background-color:yellow; */
     width: 100%;
     height:12dvh;
     display:flex;
     justify-content:space-around;
     align-items:center;
     padding:20px;
     /* border-bottom:2px solid black; */
    }
    .logo{
        font-size:24px;
    }

 ul {
    list-style-type:none;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:1em;
 }
 li a{
    text-decoration:none;
    color:black;
    font-size:18px;
 }

 a:hover{
    text-decoration:2px solid black;
 }
    .container{
        /* background-color:yellow; */
        max-width:900px;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-flow:column;
        gap:1em;
    }
    .content-title-paragraphe{
        /* background-color:yellow; */
        width: 90%;
        height:320px;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-flow:column;
        text-align:center;
        gap:1em;

        h1{
            font-size:3em;
        }
        p{
            font-size:19px;
        }
    }
    .content-photo-visiteurs{
        width:300px;
        heigth:200px;
        display:flex;
        align-items:center;
        justify-content:center;
        /* background-color:red; */
      
    }
    .photo{
            width: 100px;
            height: 100px;
            display:flex;
        align-items:center;
        justify-content:center;
    }
    .photo:nth-child(1){
            transform: translateX(0);
        }
        .photo:nth-child(2){
            transform: translateX(-20px);
            
        }
        .photo:nth-child(3){
            transform: translateX(-35px);

        }
        .photo:nth-child(4){
            transform: translateX(-55px);

        }
        .photo:nth-child(5){
            transform: translateX(-75px);

        }
    .photo img{
            width:50px;
            height:50px;
            border-radius:50%;
            border: 3px solid #fca311;
        }
    
    .content-video{
        width:95%;
        heigth:500px;
        padding:5px;
        /* balise video  ciblée */
        video{
            width: 100%;
            border-radius:14px;
            border: 5px solid #fca311;
        }
    }

    .content-annonce{
    /* background-color:red; */
    display:flex;
    flex-flow:column;
    width: 90%;
    height:500px;
    gap:1em;
    }

    .section-card-annonce{
 display:flex;
 justify-content:center;
 align-items:center;
 /* background-color:aqua; */
 width: 100%;
 height:500px;
 gap:0.8em;
 
    }

    .card{
        background-color:#ffffff;
    width: 300px;
    height: 460px;
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
    a{
        background-color:#fca311;
    text-decoration:none;
    color:black;
    padding:5px;
    }
    }
    .card-body{
    display:flex;
    flex-flow:column;
    gap:0.6em;
    padding-left:4px;
    }
    .btn{
        background-color:#fca311;
        border:none;
        padding:5px 10px;
    }
    </style>
</head>
<body>
    <!-- entete de la page -->
    <header>
    <div class="logo"><p>Sunset</p></div>
<ul>
<li><a href="#">Accueil</a></li>
<li><a href="about.php"> A propos</a></li>
<li><a href="#annonce"> Blog</a></li>
<li><a href="reservation_list.php"> Mes reservations</a></li>
<li><a href="#contact"> Contact</a></li>
<li><a href="../config/logout.php"> Deconnexion</a></li>
</ul>

 </header>



    <div class="container">

    <div class="content-title-paragraphe">
        <h1>Explorez le monde avec Sunset</h1>

       <p>découvrez des destinations de rêve et des expériences uniques.
         Bénéficiez de recommandations personnalisées et d'itinéraires sur
          mesure pour rendre chaque voyage mémorable. Explorez le monde à votre manière,
           avec Sunset comme guide.
      </p>

      <div class="content-photo-visiteurs">
        <div class="photo">
            <img src="asset/p1.jpg" alt="photo">
        </div>
        <div class="photo">
            <img src="asset/p2.jpg" alt="photo">
        </div>
        <div class="photo">
            <img src="asset/p3.jpg" alt="photo">
        </div>
        <div class="photo">
            <img src="asset/p4.jpg" alt="photo">
        </div>
        <div class="photo">
            <img src="asset/p5.jpg" alt="photo">
        </div>
      </div>
     </div>
        <!-- video presentation -->
     <div class="content-video">
        <video autoplay loop muted>
          <source src="video.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la balise vidéo.
       </video>
     </div>

      <div class="content-annonce" id="annonce">
      <h1>Nos activités et espace</h1>
      <div class="section-card-annonce">  
<?php
while ($row = $annonces->fetch_assoc()) {
    $annonceId = $row['id'];
?>
    <div class="card">
    <img width='25%' src="<?= $row['photo']; ?>" class="card-img-top" alt="<?= $row['titre']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $row['titre']; ?> </h5>
               <h5 class="card-title"><?= $row['prix']; ?> </h5>
               <p class="card-text"><?= $row['description']; ?></p>
            <h5><a href="reservation.php?id=<?= $annonceId; ?>" class="btn btn-primary">Réserver</a></h5>
            <h6>Commentaires</h6>

            <?php
            // Récupérer les commentaires pour cette annonce
            $commentaires = $conn->query("SELECT c.contenu, u.nom FROM commentaires c JOIN users u ON c.utilisateur_id = u.id WHERE c.annonce_id = $annonceId LIMIT 5");
            
            while ($commentaire = $commentaires->fetch_assoc()) {
                echo "<p><strong>{$commentaire['nom']}</strong>: {$commentaire['contenu']}</p>";
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
    </div>





    <footer style="width: 100%; background-color: #8ecae6; color:black; padding: 20px 0;">
    <div style="display: flex; justify-content: space-around; flex-wrap: wrap;">
        
        <!-- Section Adresse -->
        <div style="flex: 1; padding: 10px;">
            <h3 style="font-size: 20px;">Adresse</h3>
            <p>Sunset Agency</p>
            <p>123 Rue de la Plage</p>
            <p>Kinshasa, RDC</p>
        </div>

        <!-- Section Contact -->
        <div style="flex: 1; padding: 10px;" id="contact">
            <h3 style="font-size: 20px;">Contact</h3>
            <p>Téléphone : +243 900 123 456</p>
            <p>Email : info@sunset.com</p>
        </div>

        <!-- Section Réseaux Sociaux -->
        <div style="flex: 1; padding: 10px;">
            <h3 style="font-size: 20px;">Suivez-nous</h3>
            <a href="#" style="color:black; margin-right: 10px;">Facebook</a>
            <a href="#" style="color:black; margin-right: 10px;">Instagram</a>
            <a href="#" style="color:black;">Twitter</a>
        </div>

        <!-- Section Horaires -->
        <div style="flex: 1; padding: 10px;">
            <h3 style="font-size: 20px;">Horaires d'ouverture</h3>
            <p>Lundi - Vendredi : 8h00 - 18h00</p>
            <p>Samedi : 9h00 - 14h00</p>
            <p>Dimanche : Fermé</p>
        </div>
    </div>

    <div style="text-align: center; padding-top: 20px;">
        <p>2024 Michée Bikwelo. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>