<?php
	//on créé une session 
    session_start();
    
    //on détruit la session pour être sûr que l'utilisateur est déconnecté
    session_destroy();
    header("location:../connexion.php"); //redirection vers la page de connexion 

?>