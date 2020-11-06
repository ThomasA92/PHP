<?php
//-----------------------------
// La superglobale $_COOKIE
//---------------------------
/*
- Un cookie est un petit fichier(4 ko max) déposé par le serveur du site dans le navigateur de l'internaute et qui peut contenir des informations.
- Les cookies sont automatiquement renvoyés par le navigateur vers le serveur web quand l'internaute navigue dans les pages concernées par les cookies.
- Le PHP permet de récupérer très facilement les données contenues dans un cookie:
ses informations sont stockées dans un superglobal $_COOKIE.
- Précautions à prendre avec les cookies !
=> comme il est déposé sur le poste de l'internaute, il peut être volé ou modifié.De ce fait, on ne met à l'intérieur que des informations d'importances mineures(pas de référence de CB, pas de panier d'achat, pas de mot de passe etc...)
 */

 // Application : Nous allons stocker la langue choisie par l'internaute dans un cookie.

 /* -2 Détermination de la langue:
  3 scénarios par défaut:
  - On arrive pour la première fois et on clique sur un lien, on prend la langue du lien.
  - On n'a pas cliqué mais un cookie existe déjà.
  - On n'a pas cliqué et il n'y a pas encore de cookie : on prend "fr" par défaut.
  */ 

  print_r($_GET);

  if (isset($_GET['langue'])){ // si existe "langue" dans $_GET,donc dans l'URL, c'est on a cliqué sur un lien.
    $langue = $_GET['langue'];// on prend la langue du lien.
  }elseif(isset($_COOKIE['langue'])){ // Sinon, si existe un cookie appelé "langue"
    $langue = $_COOKIE['langue']; // On prend la langue du cookie.
  } else {
      $langue = 'fr'; // Sinon on prend 'fr' par défaut.
  }
// On ressort de ces conditions avec une valeur dans $langue quoi qu'il arrive.

/* 3  - On envoie le cookie :
- On détermine la date de validité de notre cookie en timestamp(nombre de secondes écoulées depuis le 01/01/1970) :
*/
$un_an = time() + 365 * 24 * 60 * 60; // La fonction time() retourne le timestamp de maintenant auquel j'ajoute un an, exprimé en secondes(365 jours * 24h * 60 min * 60 sec).
setcookie('langue', $langue, $un_an); /* On crée un cookie appelé : langue,
 de valeur : $langue,
 et de date d'expiration maintenant  + 1 an en secondes  */

 // 4 - Affichage de la langue :
 echo "<h2> Le site sera en $langue </h2>";

/* Pour visualiser un cookie dans Chrome : Ouvrir l'inspecteur > onglet "applications" > "cookies" colonne de gauche > choisir le domaine concerné (localhost) pour voir ses cookies.
Firefox : Inspecter => stockage => onglets cookie sur le côté.
*/

/* setcookie() est une fonction prédéfinie qui permet de créer un cookie, mais il n'y a pas de fonction pour les supprimer.
Pour rendre un cookie invalide, on le met à jour avec une date périmée ou à 0, ou encore en ne précisant que le nom du cookie concerné.
 */


// -1 Le HTML.
?>

<h1>langue</h1>
<ul>
    <li><a href="?langue=fr">Français</a></li>
    <li><a href="?langue=es">Espagnol</a></li>
    <li><a href="?langue=en">Anglais</a></li>
    <li><a href="?langue=it">Italien</a></li>
</ul>