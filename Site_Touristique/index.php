<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Annonces</title>
  <!-- css pur -->
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
        color:#fca311;
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
    font-size:22px;
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

    /* section annonce et gestion des cards */
.content-annonce{
 /* background-color:red; */
 display:flex;
 flex-flow:column;
 width: 90%;
 height:450px;
/* container card */
 .section-card-annonce{
 display:flex;
 justify-content:center;
 align-items:center;
 /* background-color:aqua; */
 width: 100%;
 height:400px;
 gap:0.8em;
 }
 /* carte dynamique  */
 .card-annonce{
    background-color:#ffffff;
    width: 300px;
    height: 400px;
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
 label a{
    background-color:#fca311;
    text-decoration:none;
    color:black;
    padding:8px;

 }
 .card-body{
    display:flex;
    flex-flow:column;
    gap:0.6em;
    padding-left:4px;
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

</head>
<body>
    <!-- entete de la page -->
 <header>
    <div class="logo"><p>Sunset</p></div>
<ul>
<li><a href="connexion.php"> Se connecter</a></li>
<strong>/</strong>
<li><a href="inscription.php"> S'inscrire</a></li>
</ul>

 </header>
<!-- corps de la page -->
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
          <source src="user/video.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la balise vidéo.
       </video>
     </div>

     <div class="content-annonce">
     <h1>Nos annonces:</h1>
       <div class="section-card-annonce">
       <?php
        // Connexion à la base de données
        require_once 'config/db.php'; // Config.php contient la connexion à la base de données

        // Récupérer les annonces et leurs commentaires
        $result = $conn->query("SELECT * FROM annonces");

        while ($row = $result->fetch_assoc()) {
            $annonceId = $row['id'];
            $commentCount = $conn->query("SELECT COUNT(*) AS total_comments FROM commentaires WHERE annonce_id = $annonceId")->fetch_assoc();
        ?>
          
            <div class="card-annonce">
                <img width='25%' src="uploads/<?= $row['photo']; ?>" class="card-img-top" alt="<?= $row['titre']; ?>">
                <div class="card-body">
                    <label class="card-title"><?= $row['titre']; ?></label>
                    <label class="card-title"><?= $row['prix']; ?></label>
                    <p class="card-text"><?= $row['description']; ?></p>
                    <label class="card-title"><a href="connexion.php"> Réserver</a></label>
                    <p><strong><?= $commentCount['total_comments']; ?></strong> commentaires</p>
                  
                </div>
          </div>
        <?php } ?>
       </div>
     </div>

    </div>
<footer><p>@Developée par Michée Bikwelo</p></footer>
</body>
</html>