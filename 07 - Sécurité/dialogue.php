<?php
// -----------------------------
// Sécuriser une requête dans les données proviennent de l'internaute.
// ----------------------------
// On créé un formulaire pour poster des commentaires.

/* 
On crée la BDD appelée "dialogue"

Table : commentaire 

Champs : id_commentaire INT PK AI
         pseudo     VARCHAR(20)
         message       TEXT
         date_enregistrement DATETIME
*/
// print_r($_POST);
// 2 - Connexion à la BDD et traitement fu formulaire.
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', // Le driver "mysql" + le serveur de la BDD + le nom de la BDD 
'root', // pseudo de la BDD
'', // mot de passe
array( // les options
    PDO::ATTR_ERRMODE => PDO ::ERRMODE_WARNING, // options 1: pour afficher les erreurs mysql dans le navigateur.
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : pour définir le jeu de caractère des échanges avec la BDD.
));
if (!empty($_POST)){ // si $_POST n'est pas vide c'est que le formulaire a été envoyé.
    // 5 -Traitement contre les failles XSS( = JavaScript) et les injections CSS :
    // Pour tester on injecte le code suivant dans le champ message : <style>body{display:none;}</style>
    // Pour se prémunir de ce type de faille, on échappe les données de la manière suivante :
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
    $_POST['message'] = htmlspecialchars($_POST['message']); // htmlspecialchhars() convert les caractères spéciaux suivant >,<, en entités HTML &gt; &lt; &amp; ce qui a pour effet de neutraliser <style> et <script>, et donc de se prémunir des failles XSS et CSS.

    // Quand le formulaire a été envoyé, on insère en BDD le pseudo et le message :
    // $resultat = $pdo->query("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]',NOW(), '$_POST[message]')"); // ON NEUTRALISE cette requête car elle n'est pas protégée.

    // 4 - On fait l'injection SQL suivante dans le champ "message" : '); DELETE FROM commentaire;#
    // Pour se protéger contre les injections SQL, nous faisons une requête préparée :
    $resultat =$pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message)"); //On met des marqueurs vides à la place des variables qui proviennent de l'internaute.
    $resultat->execute(array(
        ':pseudo' => $_POST['pseudo'], // Le pseudo vient du formulaire.
        ':message' => $_POST['message'] // Le message également.
    ));

    // Comment ça marche ?Le fait de mettre des marqueurs dans la requête empêche que les instructions SQL injectées viennent se concaténer avec notre code.De plus, en faisant une requête préparé, les valeurs liées aux marqueurs sont neutralisées en texte brut lors des bindParam() ou bindValue().La BDD reçoit  donc une chaîne de caractères inoffensive qu'elle n'exécute pas.

} // Fin de if (!empty($_POST))


// Le formulaire HTML
?>

<h1>Votre message</h1>
<form action="" method="post">
    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo']?? ''; ?>"></div>
    <div><label for="message">Message</label></div>
    <div><textarea name="message" id="message" cols="30" rows="10"><?php echo $_POST['message'] ?? '';?></textarea></div> <!-- Avec le "??" on affiche la première valeur qui existe : soit le message si l'utilisateur en a saisi un, sinon un string vide. -->

    <div><input type="submit"></div>

    </form>

    <?php

    // 3 - Affichage des messages 
    $resultat =$pdo->query("SELECT * FROM commentaire ORDER BY date_enregistrement DESC");

    echo '<h2> Nombre de commentaires : ' .$resultat->rowCount() . '</h2>';

    while($commentaire = $resultat ->fetch(PDO::FETCH_ASSOC)){
        // print_r($commentaire);
        echo '<div>';
            echo '<p>Commentaire de ' .$commentaire['pseudo'] . ' à la date dy ' . $commentaire['date_enregistrement'] . '</p>';
            echo '<p>' . $commentaire['message'] . '</p>';
        echo '</div><hr>';
    }














    ?>