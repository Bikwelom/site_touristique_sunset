<?php

// Inclure la connexion à la base de données
include 'config/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire via la méthode Post
    $email = $_POST['email']; //récupère l'email
    $password = $_POST['password']; //récupère le mot de passe

    // Préparer et exécuter la requête de sélection
    $stmt = $conn->prepare("SELECT id, nom, password, type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute(); //on exécute la requête pour récupérer les informations de l'utilisateur 
    $stmt->store_result();
    $stmt->bind_result($id, $nom, $hashed_password, $type); //résultat de la requête 

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // on chiffre le mot de passe pour comparer avec celui de la base des données
        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $id;
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $type;
			
			//une fois les informations vérifier et qu'un utilisateur est trouver 
            // on vérifie si c'est un administrateur ou un utilisateur normal
            
            if ($type == 'admin') {
            	//si c'est un administrateur on redirige vers la page appropriée
                header("Location: ./admin/dashboard.php");
            } else {
            	//si c'est un utilisateur normal on le redirige vers l'espace user
                header("Location: ./user/home.php");
            }
        } else {
        	//message d'erreur au cas où les informations sont incorrectes
            echo '<script type="text/javascript">alert("⚠️Email ou mot de passe incorrect.");window.location=\'./connexion.php\';</script>';
        }
    } else {
          echo '<script type="text/javascript">alert("⚠️Email ou mot de passe incorrect.");window.location=\'./connexion.php\';</script>';
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
    <title>connexion</title>
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
      
@font-face {
    font-family: 'Chivo';
    src: url('fonts/static/Chivo-ExtraBold.ttf') format('ttf'),
         url('fonts/static/Chivo-ExtraBoldItalic.ttf') format('ttf');
    font-weight:900;
    font-style: normal;
}

      body {
        width: 100%;
        height: 100dvh;
        background-color: var(--btn-color);
        display: flex;
        flex-flow: rows;
        align-items: center;
        font-family: 'Chivo',sans-serif;
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
      <h1>Connectez-Vous.</h1>
      <form action="" method="post">
        <p id="messageInscription"></p>
        <label for="email">
          Entrez votre Email *
          <input type="email" name="email" id="email" required>
        </label>
        <label for="password">
          Entrez Le Mot de Passe *
          <input type="password" name="password" id="password" required>
        </label><br>
        <input type="submit" value="Se connecter">
        <div class="connection-links">
          <a href="inscription.php">S'inscrire</a>
        </div>
      </form>
    </div>
  </body>
</html>