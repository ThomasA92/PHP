<?php
/*
   1- Vous affichez le détail complet du voiture demandé dans liste_contact.php, y compris la photo. Si le voiture n'existe pas, vous laissez un message. 

*/
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  // ne pas oublier de changer la BDD


function debug($variable) {
    echo '<div style="border: 1px solid orange; padding: 20px;">';
        echo '<pre>';
            print_r($variable);        
        echo '</pre>';
    echo '</div>';
}

// debug($_GET);

if (isset($_GET['id_contact'])) {  // s'il y a "id_contact" dans l'URL, je peux le sélectionner en BDD

   // Echappement des données :
   $_GET['id_contact'] = htmlspecialchars($_GET['id_contact']);  // évite les risque XSS (JS) et CSS en neutralisant les chevrons en particulier en entités HTML.

   $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
   $resultat->execute(array(':id_contact' => $_GET['id_contact']));  // l'ID venant de l'URL, on le récupère dans $_GET

   $voiture = $resultat->fetch(PDO::FETCH_ASSOC);  // on va charcher les données du voiture dans l'objet $resultat

   debug($voiture);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Détail de la voiture</title>
</head>
<body>
   <?php 
   if (!empty($contact)) { // isset() vérifie si la variable existe (et est non NULL) alors que empty() vérifie si la variable contient 0, "", NULL, false ou alors si elle n'est pas définie. Dans le cas présent, si "id_contact" n'est dans $_GET, alors la variable $contact n'est pas déclarée, elle donc "empty".
   ?>
      <div class="card" style="width: 30rem;">
      <div><img src="<?php echo $contact['photo']; ?>" alt="<?php echo $contact['marque']; ?>"></div>
      <div><img src="<?php echo $contact['fiche']; ?>" alt="<?php echo $contact['marque']; ?>"></div>
      <div class="card-body">
         <h3><?php echo $contact['marque']; ?></h1>
            <ul>
               <li>Kilomètrage : <?php echo $contact['kilometrage']; ?></li>
               <li>tarif : <?php echo $contact['tarif']; ?></li>
            </ul>
         <a href="#" class="btn btn-primary">Modifier</a>
      </div>
   </div>
   <?php 
   
   } else {
      echo '<p>contact non trouvée.</p>';
   } 
   

   ?>   

  
</body>
</html>