<?php
require_once 'inc/init.php';
// 1 - Vous redirigez le membre NON connecté vers la page de connexion.
if (!isLogged()){
    header('location: connexion.php'); // On fait une redirection vers connexion.php
    exit; // et on quitte le script.
}

require_once 'inc/header.php';
?>
<h1 class="mt-4">Profil</h1>


<?php 
// 2 - Vous affichez le profil :
debug($_SESSION);
// Dans un <h2>Bonjour prenom nom ! </h2>
?>
    <h2> Bonjour <?php echo $_SESSION['membre']['prenom'] . ' ' . $_SESSION['membre']['nom']; ?> !</h2> 

    <hr>
    <h3>Vos coordonnées :</h3>
    
    <ul>
        <li>Email : <?php echo $_SESSION['membre']['email']; ?></li>
        <li>Adresse : <?php echo $_SESSION['membre']['adresse']; ?></li>
        <li>Code postal : <?php echo $_SESSION['membre']['code_postal']; ?></li>
        <li>Ville : <?php echo $_SESSION['membre']['ville']; ?></li>
    </ul>
<?php


 
// Vous affichez dans une liste <ul><li> : 
// Email
// Adresse
// Code postal
// ville

require_once 'inc/footer.php';

