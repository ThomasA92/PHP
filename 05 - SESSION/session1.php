<?php
//-----------------------------
// La superglobale $_SESSION
//---------------------------

/* Principe de la session : un fichier temporaire appelé "session" et créé sur le serveur avec un identifiant unique.Cette session est liée à un internaute car dans le même temps, un cookie est déposée sur le poste de l'internaute avec l'identifiant dedans (nom du cookie : PHPSESSID).Ce cookie se détruit quand on quitte le navigateur.

-Le fichier de session peut contenir des informations sensibles sensibles car il n'est pas accessible par l'internaute.On y met par exemple des identifiants ou des informations de paiement.

-Tous les sites qui fonctionnent avec le principle d'une connexion (FB, site bancaire...) ou qui ont besoin de suivre un internaute de page en page (ex:panier dans Amazon,Fnac etc...) utilisent les sessins.
*/

// Création ou ouverture d'une sessin :
session_start(); // Cette fonction crée un fichier de session avec son identifiant OU ovre la session si elle existe déjà(et qu'on a reçu un cookie avec son identifiant).

// Remplir la session :
$_SESSION['pseudo'] = 'tintin';
$_SESSION['mdp'] = 'milou'; // $_SESSION est une superglobale et donc, un tableau. On y crée les indices que l'on souhaite pour stocker nos informations.

echo '1 - La session après remplissage : <br>';
print_r($_SESSION); // Les sessions sont toute dans le dossier xampp/ tmp.

// Vider une partie de la sessin :
unset($_SESSION['mdp']); // On peut supprimer une partie seulement de la session avec unset.Par exemple pour déconner un membre sans lui supprimer son panier.

echo'<br> 2 - La session après suppression du MDP : ';
print_r($_SESSION);

// Supprimer entièrement une session :
// session_destroy(); //  Un sessin_destroy() permet la suprresion d'une session.%Mais il est d'abord vu par l'interpréteur comme étant à la fin du script.C'est pourquoi nous voyons encore les données dans le print_r çi dessous.
echo '<br> 3 - La session supprimée : <br>';
print_r($_SESSION);

// C'est ici que s'exécute le session_destroy();

