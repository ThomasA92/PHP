<style>
    h2{
        border-bottom: 1px solid navy;
        border-top: 1px solid navy;
        color: navy;
    }
    table, tr, th, td{
        border:1px solid;
        border-collapse: collapse;
    }
</style>

<?php

//--------------------
// PDO
//-------------------

// L'extension PDO pour PHP Data Objects, est une interface pour se connecter à une base de donénes et effectuer des requêtes SQL sur celle-ci.
function debug($variable){
    echo '<pre>';
    print_r($variable);
    echo '</pre>';
}
// ----------------------------
echo '<h2> Connexion à la BDD </h2>';
// ------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // Le driver "mysql" + le serveur de la BDD + le nom de la BDD 
'root', // pseudo de la BDD
'', // mot de passe
array( // les options
    PDO::ATTR_ERRMODE => PDO ::ERRMODE_WARNING, // options 1: pour afficher les erreurs mysql dans le navigateur.
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : pour définir le jeu de caractère des échanges avec la BDD.
));
// $pdo est un objet qui provient de la classe prédéfinie PDO. Cet objet représente la connexion à la BDD "entreprise".

debug($pdo); // $pdo est un objet qui provient de la classe prédéfinie PDO.

debug(get_class_methods($pdo)); // get_class_methods() affiche les méthodes de l'objet $pdo qui proviennent de la classe PDO.



// ----------------------------
echo '<h2> la method exec() </h2>';
// ------------------------------

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche,salaire)
VALUES('test', 'test', 'm', 'test', '2016-02-08',500)");

/*
La méthode exec() est utilisée pour formuler des requêtes ne retournant pas de jeu de résultat : INSERT, UPDATE, DELETE.

- Valeur de retour(ce que l'on récupère dans $resultat):
Si succès : retourne le nombre de lignes affectées par la requête.
Si échec : retourne un boolean false.
*/

echo 'Nombre de lignes insérées : ' . $resultat . '<br>';
echo 'Dernier ID généré en BDD :' .$pdo->lastInsertId() . '<br>' ; // Cette méthode de PDO nous retourne le dernier identifiant(clé pirmaire) que la BDD a généré.


//------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test' ");
echo 'Nombre de lignes supprimées : ' . $resultat ;

// ----------------------------
echo '<h2> la method query() + fetch() pour un seul résultat </h2>';
// ------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel' ");

/*
- La méthode query(), au contraire d'exec(), est utilisée pour formuler des requêtes retournant un ou plusieurs résultats : SELECT.

- Valeur de retour :
Succès : query() retourne un objet qui provient de la classe PDOStatement
Echec : false.

*/
debug($resultat); // On voit que $resultat est un objet issu de la classe PDOStatement.Par ailleurs on ne voit pas les données qui concernent Daniel.

// $resultat étant le résultat de la requête sous une forme inexploitable direcmtenet, il nous faut transformer ce résultat par la méthode fetch() :
$employe = $resultat->fetch(PDO::FETCH_ASSOC); // La méthode fetch() ave le paramètre PDO::FETCH_ASSOC retourne un tableau associatif exploitable (ici $employe) dont les indices correspondent au nom des champs de la requête SQL.

debug($employe);

echo 'Je suis ' .$employe['prenom'] . ' ' . $employe ['nom'] . ' du service ' . $employe['service'] . '<br>';
// comme $employe est un tableau, on accède aux valeurs en précisant leur indice entre [].

// On peut aussi faire l'un des "fetch" suivants
$resultat = $pdo->query("SELECT * FROM employes WHERE  prenom = 'Daniel' ");
$employe = $resultat->fetch(PDO::FETCH_NUM); // retourne un tableau indexé numériquement.
debug($employe);
echo $employe[1] . '<br>'; // On indique l'indice numérique entre [] pour accéder à Daniel.

$resultat =$pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel' ");
$employe = $resultat->fetch(); // Retourne un tableau à la fois associatif ET numérique.
debug($employe);
echo 'Je suis ' . $employe['prenom'] . '<br>';
echo 'Je suis ' . $employe[1] .'<br>';

$resultat = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel' ");
$employe = $resultat ->fetch(PDO::FETCH_OBJ);
debug($employe);
echo $employe->prenom . '<br>'; // Pour accéder à la propriété "prenom", on écrit après la flèche "->".

// attention : il faut choisir l'un des "fetch" car vous ne pouvez pas en faire plusieurs sur le même résultat.

//--------
// Exercice : afficher le service de l'employé dont l'id_employes est 417 ou 7847.

$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 417  ");
$employe = $resultat ->fetch(PDO::FETCH_OBJ);
debug($employe);
echo $employe->prenom . '<br>';


// ----------------------------
echo '<h2> la method query() + fetch() pour un plusieurs résultats </h2>';
// ------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

echo 'Nombre de lignes de résultats : ' . $resultat->rowCount() . '<br>'; // Cette méthode compte le nombre de lignes retournées par la requête(=nombre d'employés).

// Comme nous avons plusieurs lignes dans le jeu de résultat, nous faisons une boucle pour les parcourir :
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){ // fetch retourne la ligne suivante du jeu de résultat en un tableau associatif.La boucle while permet de faire avancer le curseur dans la table à chaque fetch(),et s'arrête quand le curseur a atteint la fin du jeu de résultat et que fetch () retourne false.
    
    // debug($employe); // $employe est un tableau qui contient les données de un employé à chaque tour de boucle.

    echo '<div>';
        echo '<p>Prénom : ' . $employe['prenom'] . '</p>';
        echo '<p>Nom : ' . $employe['nom'] . '</p>';
        echo '<p>Salaire : ' . $employe['salaire'] . '</p>';
    echo '<div><hr>';
}
/* - Si votre requête sort plusieurs résultats : on fait une boucle.
- Si elle ne sort qu'un seul résultat unique : pas de boucle.
- En revanche, si elle sort un seul résultat mais peut potentiellement en sortir plusieurs : on fait une boucle.
*/

// ----------------------------
echo '<h2> Exercice </h2>';
// ------------------------------
// Afficher la liste des différents services de votre entreprise dans une liste <ul><li> (1 seule liste et un service par <li>).Pensez à dédoublonner les services.

$resultat = $pdo->query("SELECT DISTINCT service FROM employes ");

echo '<ul>';
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<li>' .  $employe['service'] . '</li>';
}
echo '</ul>';
    
// ----------------------------
echo '<h2> La méthode fetchAll() </h2>';
// ------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$datas = $resultat->fetchAll(); // fetchAll() retourne toutes les lignes de résultat dans un tableau multidimensionnel sans faire de boucle : nous avons un tableau associatif à chaque indice numérique.Marche aussi avec fetchAll(PDO::FETCH_NUM) pour un sous tableau indicé numériquement,ou encore avec fetchAll() pour un sous tableau associatif et numérique.

// debug($datas);

// ON parcout $datas avec une boucle foreach() pour en afficher le contenu :
    foreach($datas as $employe){
        // debug($employe); // Cette variable contient un tableau qui représente un seul employé à chaque tour de boucle.
        echo '<div>';
        echo '<p>Prénom : ' . $employe['prenom'] . '</p>';
        echo '<p>Nom : ' . $employe['nom'] . '</p>';
        echo '<p>Salaire : ' . $employe['salaire'] . '</p>';
    echo '<div><hr>';
    }


// ----------------------------
echo '<h2> Afficher le jeu de résultat dans une table HTML </h2>';
// ------------------------------

echo '<table>';
// la ligne des entêtes.
echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Prénom</th>';
    echo '<th>Nom</th>';
    echo '<th>Sexe</th>';
    echo '<th>Service</th>';
    echo '<th>Date embauche</th>';
    echo '<th>Salaire</th>';
echo '</tr>';

// On affiche 1 ligne par employé :
// debug($resultat); // $resultat étant un objet PDOStatement dont on ne voit pas directement les données des employés, il faut donc faire un fetch. De plus, comme il  y a plusieurs employés, il faut faire une boucle.
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<tr>';
        foreach($employe as $value){ // $value récupère chaque information à chaque tour de boucle de l'employé.
            echo '<td>' . $value . '</td>'; // On met les valeurs dans des <td> pour faire les colonne du <table>
}
    echo '</tr>';
}
echo '</table>';


// ----------------------------
echo '<h2> Requête préparée  </h2>';
// ------------------------------
// Les requêtes préparées sont préconisées si vous exécutez plusieurs fois la même requête et ainsi vouloir éviter de répéter le cycle analyse  / interprétation / exécution réalisé par le SGBD(gain de performance).
// Les requêtes préparées sont aussi souvent utilisées pour assainir les données et se prémunir contre les injections SQL(voir le cours suivant).

$nom = 'Sennard';

/* Une requête préparée se réalise en 3 étapes :
 1 - On prépare la requête : */
 $resultat =$pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // la méthode prepare() permet de préparer la requête mais ne l'exécute pas. Avec prepare(),on utilise des marqueurs comme :nom.Il s'agit d'un marquer nominatif qui est vide et qui attend une valeur.

// 2-Lier les marqueurs à leur valeur :
$resultat->bindParam(':nom', $nom); // bindParam() reçoit exclusivement une variable vers laquelle pointe le marqueur.Ainsi, si le contenu de la variable change, la valeur du marqueur changera automatiquement quand on refera un autre execute() sans avoir besoin de refaire le bindParam().


// Ou encore, vous avez l'alternative suivante : 
// $resultat->bindValue(':nom','Sennard');//  bindValue() permet de lier un marqueur directement à une valeur, ou à une variable si on le souhaite.Mais le marqueur pointe ici vers la VALEUR.Si celle ci change entre deux execute(), il faudra refaire un bindValue() pour prendre en compte la nouvelle valeur.



// 3 - Exécuter la requête :
$resultat ->execute(); // cette méthode permet d'exécuter une requête préparée avec prepare().ils vont toujours ensemble.

/*
La méthode prepare() retourne TOUJOURS un objet PDOStatement.
La méthode  execute ():
    succès : true
    echec : false.

*/

// 4 -Affichage
debug($resultat);
$employe = $resultat ->fetch(PDO::FETCH_ASSOC);
echo 'Je suis' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';

//---------------
// Si on change la valeur de $nom, sans nouveau BindParam(), le marqueur de la requête va pointer vers la nouvelle valeur.Exemple:
$nom = 'Durand';
$resultat->execute();
$employe = $resultat ->fetch(PDO::FETCH_ASSOC);
echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '<br>';






// ------------------------------------------------------------
echo '<h2> Requête préparé : points complémentaires. </h2>';
// -------------------------------------------------------------

echo '<h3> Le marquer "? </h3>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?"); // On prépare la requête avec les parti variables représentées par des marqueurs sous forme de "?".Ces marqueurs sont vides et attendent une valeur.

$resultat->bindValue(1, 'Durand'); // le chiffre 1 représente le premier point d'interrogation "?" auquel on lit la valeur 'Durand'.
$resultat->bindValue(2, 'Damien'); // Le chiffre 2 représente le second "?" auquel on lie la valeur "Damien"
$resultat->execute(); // Puis on exécute l'ensemble de la requête.On peut aussi écrire la syntaxe alternative suivantre qui regroupe ces trois lignes :
$resultat->execute(array('Durand', 'Damien')); // Dans l'ordre, "Durand" remplace le premier point d'interrogation "?" et "Damien" par le second.

debug($resultat);
$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo $employe['prenom'] . ' ' . $employe['nom'] . ' est du service '. $employe['service'] . '<br>';

echo '<h3> Faire un execute () sans bindParam() </h3>';
$resultat =$pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
$resultat->execute(array(':nom' => 'Chevel', ':prenom' => 'Daniel')); // on associe chaque marqueurs à leur valeurs directement dans un tableau associatif passé en aargument de execute().Notez que vous n'êtes pas obligé de mettre les ":" devant les marqueurs quand on les associe à leur valeur dans cet array.

$employe = $resultat->fetch(PDO::FETCH_ASSOC);
echo $employe['prenom'] . ' ' . $employe['nom'] . ' est du service '. $employe['service'] . '<br>';

?>

