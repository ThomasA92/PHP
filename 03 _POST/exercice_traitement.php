<?php

// print_r($_POST);

if(!empty($_POST)){ // si $_POST n'est pas vide, c'est qu'il est rempli, donc que le formulaire a été envoyé.

// ici viendra la vérification des champ du formulaire.
echo 'Ville : ' .$_POST['ville'] . '<br>'; 
echo 'Code postal : ' . $_POST['codepostal'] . '<br>';
echo 'Adresse : ' . $_POST['adresse'] . '<br>';

// ------------------
// Ecrire les données dans un fichier  sur le serveur
// ------------------------
// On écrit les données saisies par les internautes dans un fichier txt en l'absence de BDD.

$file = fopen('adresses.txt', 'a'); // fopen() avec le mode "a" crée le fichier adresses.txt s'il n'existe pas ou l'ouvre s'il existe. 

$adresse = $_POST['ville'] . ' - ' . $_POST['codepostal'] . ' - ' . $_POST['adresse'] . "\n"; // $adresse contient l'adresse de l'internaute à écrure dans le fichier. "\n" permet de faire un saut de ligne dans le fichier txt.

fwrite($file, $adresse); // écrit le contenu de $adresse dans le fichier représenté par $file.

fclose($file); // fclose pour fermer le fichier afin de libérer de la ressource sur le serveur.

} // fin du if(empty($_POST))





?>