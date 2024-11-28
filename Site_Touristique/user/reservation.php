<?php
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
    header("Location: ../connexion.php"); //sinon le renvoyer à la page de connexion
    exit();
}
// Récupérer l'annonce sélectionnée
$annonce_id = $_GET['id'];
$user_id = $_SESSION['id'];

// Récupérer les détails de l'annonce
$annonce = $conn->query("SELECT * FROM annonces WHERE id = $annonce_id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire via la méthode Post
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $jour = $_POST['jour'];

        // Préparer et exécuter la requête d'insertion dans la base des données
        $stmt = $conn->prepare("INSERT INTO reservation (nom, email, annonce_id, user_id, jour) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nom, $email, $annonce_id, $user_id, $jour);

        if ($stmt->execute()) {
          echo '<script type="text/javascript">alert("Réservation terminée🎉");window.location=\'./home.php\';</script>';
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
    <title>Inscription</title>
    <style>
      *,
      ::before,
      ::after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        scroll-behavior: smooth;
      }
      :root {
        --bg-color: white;
        --txt-color: rgb(34, 33, 33);
        --btn-color: rgb(241, 194, 39);
      }
      .bebas-neue-regular {
        font-family: "Bebas Neue", sans-serif;
        font-weight: 400;
        font-style: normal;
      }

      body {
        width: 100%;
        height: 100dvh;
        background-color: var(--btn-color);
        display: flex;
        flex-flow: rows;
        align-items: center;
        font-family: bebas Neue;
      }
      .section-slogan {
        width: 50%;
        background-color: var(--bg-color);
        height: 100dvh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .slogan {
        /* background-color: var(--btn-color); */
        height: 50dvh;

        h1 {
          text-align: center;
          font-size: 12em;
        }
        .slogan-paragraphe {
          /* background-color: var(--btn-color); */
          padding: 0 0 0 80px;
        }
      }

      /* page formulaires */
      .section-form {
        width: 50%;
        background-color: var(--btn-color);
        height: 100dvh;
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;

        form {
          /* background-color: red; */
          height: 60dvh;
          width: 60%;
          display: flex;
          flex-flow: column;
          justify-content: center;
          align-items: center;
          gap: 0.8em;

          label {
            display: flex;
            flex-flow: column;
            width: 70%;
            height: 50px;

            input {
              height: 30px;
              outline: none;
              border: none;
              cursor: pointer;
              border-radius: 7px;
              background-color: rgb(230, 218, 218);
              /* border-radius: 14px; */
              padding: 5px;
            }
          }
        }
      }
      .connection-links {
        display: flex;
        flex-flow: column;
        justify-content: center;
        align-items: center;
        /* background-color: blue; */
        width: 60%;
        height: 80px;
        gap: 1em;

        a:nth-child(1) {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 70%;
          height: 30px;
          text-decoration: none;
          color: var(--txt-color);
          transition: cubic-bezier(0.175, 0.885, 0.32, 1.275);
          &:hover {
            background-color: rgb(230, 218, 218);
            border-radius: 7px;
            /* ajouter une transition de soulignement */
          }
        }
        a {
          text-decoration: none;
          color: var(--txt-color);
          &::after {
            content: "";
            position: absolute;
            width: 0;
            height: 2px; /* Épaisseur de la ligne */
            bottom: 0;
            left: 0;
            background-color: #000; /* Couleur de la ligne */
            visibility: hidden;
            transition: all 0.3s ease-in-out;
          }

          &:hover::after {
            visibility: visible;
            width: 100%;
          }
        }
      }
    </style>
  </head>
  <body>
    <div class="section-slogan">
      <div class="slogan">
        <h1>Sunset</h1>
        <div class="slogan-paragraphe">
          <p>
            <span style="color: rgb(241, 194, 39)">une evasion unique.</span>
            <br />
            Que vous soyez en quête d'aventure, de détente, ou de découverte,
            Sunset a tout ce qu'il vous faut.
          </p>
        </div>
      </div>
    </div>

    <!-- formulaire section -->
    <div class="section-form">
      <h1>Réservation de : <?= $annonce['titre']; ?></h1>
      <form action="" method="post">
        <p id="messageInscription"></p>
        <label for="nom">
          Réserver au Nom de *
          <input type="text" name="nom" id="nom" placeholder="Entrez votre nom.."  required>
        </label>
        <label for="email">
          Email de réservation *
          <input type="email" name="email" id="email" placeholder="Entrez votre email"  required>
        </label>
        <label for="jour">
        Date de la réservation  *
        <input type="date" name="jour" id="jour" placeholder="Entrez la date"  required>
        </label>
        <input type="submit" value="Réserver">
        <div class="connection-links">
          <a href="home.php">annuler</a>
        </div>
      </form>
    </div>
  </body>
</html>