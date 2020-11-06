<?php
// Exercice : 
// - Créer un formulaire avec les champs ville, code postal et un textarea adresse.
// - Afficher les valeurs saisies par l'internaute dans la page exercice_traitement quand le formulaire a été envoyé.

print_r($_POST);

?>

<h1>Formulaire exercice</h1>

<form action="exercice_traitement.php" method="post">
<div><label for="ville">Ville</label></div>
<div><input type="text" name="ville" id="ville"></div>
<div><label for="codepostal">Code Postal</label></div>
<div><input type="text" name="codepostal" id="codepostal"></div>
<div><label for="adresse">Adresse</label></div>
<div><textarea name="adresse" id="adresse" ></textarea></div>
<div><input type="submit" value="envoyer"></div>


</form>