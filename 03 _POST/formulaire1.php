<?php
//-----------------------------
// La superglobale $_POST
//---------------------------
// $_POST est une superglobale qui permet de récupérer des données saisies dans un formulaire.

// $_POST étant une superglobale, c'est un tableau (array). De plus il est disponible dans tous les contextes du script, y compris au sein des fonctions sans y faire "global $_POST".

// Les inputs du formulaire possèdent un attribut name qui vont constituer les indices de $_POST.Et les valeurs saisies par l'internaute vont constituer les valeurs de $_POST.

print_r($_POST); // pour afficher le contenu de la variable et  vérifier que l'on reçoit les données du formulaire.

echo '<hr>';

if(!empty($_POST)){ // si $_POST n'est pas vide, c'est qu'il est rempli, donc que le formulaire a été envoyé.

    // ici viendra la vérification des champ du formulaire.
echo 'Prénom : ' .$_POST['prenom'] . '<br>'; 
echo 'Description : ' . $_POST['description'] . '<br>';
}

/* Remarques sur F5:
- Faire F5 ou CTRL+R répète la dernière action et renvoie le formulaire.
- Pour réinstialiser le formulaire et le vider comme si nous arrivions la première fois, on clique dans l'URL puis la touche Entrée. 
*/

?>

<h1>Formulaire</h1>

<form action="formulaire1.php" method="post"> <!-- Un formulaire doit TOUJOURS être dans des balises <form> pour fonctionner. L'attribut method spécifie comment les données vont circulier vers le serveur,post signifie que c'est $_POST qui recueille les données. L'attribut "action" spécifie l'URL du script de destination des données.(lorsque vide "", on les envoie à la même page). -->

<div><label for="prenom">Prénom</label></div>
<div><input type="text" name="prenom" id="prenom"></div><!-- Il ne faut pas oublier l'attribut name sur les input du formulaire. Ils constituent les indices du tableau $_POST qui réceptionne les données.-->
<div><label for="description">Description</label></div> <!--L'attribut for est lié à l'id de l'input qui suit.Ainsi quand on clique sur le label, le curseur de place dans la case à remplir(l'input qui possède l'id de même nom.C'est une norme d'accessibilité.) --> 
<div><textarea name="description" id="description" ></textarea></div>
<div><input type="submit" value="envoyer"></div>
</form>