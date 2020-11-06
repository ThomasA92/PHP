<?php
/* ---------------------
 La superglobale $_GET
--------------------------- */

/* 
- $_GET représente les informations qui circulent dans l'URL.Il s'agit d'une superglobale,et comme toute les superglobales ,c'est un tableau(array).
- De plus , cette variable est disponible dans tous les contextes du script, y compris à l'intérieur des fonctions sans avoir à faire appel à "$_GET"./
- Les Informations transitent dans l'URL de la manière suivante :
page.php?indice1=valeur1&indiceN=valeurN

- Ces informations remplissent le tableau $_GET :
$_GET = array('indice1' => 'valeur1', 'indiceN' => 'valeurN');
*/

// ----------------

print_r($_GET); // on fait un print_r() pour vérifier que l'on reçoit bien les données depuis le navigateur.

if (isset($_GET['article'] && isset($_GET['couleur']) && isset($_GET['prix']))){ // Si existe "article" dans $_GET, donc dans l'URL, ainsi que "couleur" et "prix", alors on peut les afficher :
    echo '<p>Article' . $_GET['article'] . '</p>'; // $_GET étant un array, on met l'indice entre []
    echo '<p>couleur' . $_GET['couleur'] . '</p>';
    echo '<p>prix' . $_GET['prix'] . 'euros TTC </p>';
}else{
    echo '<p> AUCUN produit sélectionné </p>';
}


?>
<a href="page1.php">Retour vers la boutique</a>