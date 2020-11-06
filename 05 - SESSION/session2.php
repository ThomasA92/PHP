<?php
// Ouvrir notre session créée page1
session_start(); // Ici on ne recré pas la session car elle existe déjà.Elle existe déjà graâce au session_start() de la page 1.

echo 'La session est disponile partout sur les site, comme ici <br>';
print_r($_SESSION);

// Conclusion : Ce fichier n'a rien à voir avec session1.php.Il n'y a pas d'inclusion,il pourrait être dans un autre dossier, s'appeler n'importe comment ,les informations du membre restent accessible à la session.