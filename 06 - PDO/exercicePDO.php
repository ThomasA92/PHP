<?php
echo '<h1>Les commerciaux et leur salaires </h1>';

// -1  Afficher dans une liste <ul><li>, le prénom le nom et le salaire des employés appartennant au service commercial, en utilisant une requête préparé.

// - Afficher le nombre total de commerciaux.


//- 1 ------------------------------------------------
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // Le driver "mysql" + le serveur de la BDD + le nom de la BDD 
'root', // pseudo de la BDD
'', // mot de passe
array( // les options
    PDO::ATTR_ERRMODE => PDO ::ERRMODE_WARNING, // options 1: pour afficher les erreurs mysql dans le navigateur.
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : pour définir le jeu de caractère des échanges avec la BDD.
));

// La requête.

function debug($employe){
    echo '<pre>';
    print_r($employe);
    echo '</pre>';
}

$result =$pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service"); //1ère étape

$service = "commercial"; // On créé une variable service.

$result->bindParam(':service', $service); // 2ème étape

$result ->execute(); // 3ème étape

// Affichage
echo '<ul>';
    while($employe = $result->fetch(PDO::FETCH_ASSOC)){
        // debug($employe); // $employe est un tableau pour un commercial.
        echo $employe['prenom']. ' ' . $employe['nom'] . ' gagne '. $employe['salaire'] . '<br>';
    }
    echo '</ul>';

// 2 - Le nombre de commerciaux :
echo 'Les commerciaux sont au nombres de ' . $result->rowCount(); // compte le nombre de lignes dans $result.

?>