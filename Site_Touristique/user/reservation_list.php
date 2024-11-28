<?php
// Inclure la connexion à la base de données
include '../config/db.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['type']) || $_SESSION['type'] != 'user') {
    header("Location: ../connexion.php"); //sinon le renvoyer à la page de connexion
    exit();
}

$userId = $_SESSION['id'];

// Requête SQL pour récupérer les réservations avec le titre de l'annonce
$sql = "SELECT r.id, r.nom, r.email, r.jour, a.titre 
        FROM reservation r
        JOIN annonces a ON r.annonce_id = a.id AND r.user_id = $userId";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />

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
        /* background-color: var(--btn-color); */
        display: flex;
        flex-flow: rows;
        align-items: center;
        font-family: bebas Neue;
      }
      main {
        display: flex;
        width: 100%;
        height: 100dvh;
      }
      .sidebar {
        background-color:rgb(241, 194, 39);
        padding: 20px;
        height: 100dvh;
        width: 15%;
      }

      .sidebar nav ul li {
        list-style: none;
        margin-bottom: 10px;
      }

      .sidebar nav ul li a {
        text-decoration: none;
        color: #333;
        padding: 10px;
        display: block;
      }

      .sidebar nav ul li a:hover {
        background-color: #ddd;
      }

      .content {
        padding: 20px;
        background-color: rgb(73, 70, 70);
        width: 85%;
      }

      .table-container table {
        border-collapse: collapse;
        width: 100%;
      }

      th,
      td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>

</head>
<body>

    <main>
      <section class="sidebar">
        <h2>Mes réservations</h2>
        <nav>
          <ul>
            <li><a href="home.php">Accueil</a></li>
            <li><a href="../config/logout.php">Déconnexion</a></li>
          </ul>
        </nav>
      </section>
      <section class="content">
        <div class="table-container-title">
          <h1>Liste des réservations</h1>
        </div>
        <div class="table-container">
        <table border="1">
        <?php
        if ($result->num_rows > 0) {
        	echo "
        		<tr>
        		<th>Numéro</th>
        		<th>Nom</th>
        		<th>Email</th>
        		<th>Annonce</th> <!-- Afficher le titre ici -->
        		<th>Date</th>
        		<th>Action</th>
        		</tr>
        	";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nom'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['titre'] . "</td> <!-- Remplacement de l'ID par le titre -->
                    <td>" . $row['jour'] . "</td>
                    <td><button onclick='location.href=\"annuler_reservation.php?id=" . $row['id'] . "\"'>Annuler</button></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucune réservation pour le moment</td></tr>";
        }
        ?>
    </table>
        </div>
      </section>
    </main>
    
</body>
</html>

<?php
$conn->close();
?>