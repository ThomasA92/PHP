<?php
require_once 'inc/init.php';
// ---------------------------- TRAITEMENT PHP -----------------

// Traitement des données du formulaire.
debug($_POST);

if (!empty($_POST)){ // Si le formulaire a été envoyé 

// On contrôle tout les champs du formulaire
if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20 ){ // si le champ "pseudo" n'existe pas OU que sa longueur est inférieure à 4 OU que sa longueur est supérieure à 20 (selon le BDD), alors on met un message à l'internaute
    $contenu .= '<div class ="alert alert-danger"> Le pseudo doit contenir entre 4 et 20 caractères !</div>';
}

if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20 ){
    $contenu .= '<div class ="alert alert-danger"> Le mot de passe doit contenir entre 4 et 20 caractères ! </div>';
}

if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20 ){
    $contenu .= '<div class ="alert alert-danger"> Le nom  doit contenir entre 2 et 20 caractères ! </div>';
}

if (!isset($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){ // La fonction prédéfinie filter_var() avec le paramètre FILTER_VALIDATE_EMAIL retourne true si $_POST['email'] est bien de format email.
    $contenu .= '<div class ="alert alert-danger"> L\'email n\'est pas valide ! </div>';
}

if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')){ // Si le champ civilite n'existe pas OU que sa valeur est différente de "m" ET de "f" en même temps.Attention à la paire de () autour du &&.
    $contenu .= '<div class ="alert alert-danger"> La civilité n\'est pas valide ! </div>';
}

if (!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20 ){
    $contenu .= '<div class ="alert alert-danger"> La ville de passe doit contenir entre 1 et 20 caractères ! </div>';
}

if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#',$_POST['code_postal'])){
    $contenu .= '<div class ="alert alert-danger"> Le code postal n\'est pas valide. </div>';
}
if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50 ){
    $contenu .= '<div class ="alert alert-danger"> La ville de passe doit contenir entre 4 et 50 caractères ! </div>';
}

//----------
// S'il n'y a pas d'erreur sur le formulaire , on vérifie que le pseudo est disponible puis on insère le membr een BDD :
    if (empty($contenu)){ // Si notre variable est vide, c'est qu'il n'y a pas de message d'erreur.
        // On vérifie que le pseudo est disponible.
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' =>$_POST['pseudo']));

        // debug($resultat)

        if($resultat->rowCount() > 0) { // S'il y a une ou plusieurs lignes dans l'objet $resultat, c'est que le pseudo est déjà en BDD.
            $contenu .= '<div class ="alert alert-danger"> Le pseudo existe déjà.Veuillez en choisir un autre.  </div>';
        
        }else { // Le pseudo est disponible, on insère le pseudo(membre) dans la BDD.
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT); // Cette fonction retourne la clé de hachage de notre mot de passe selon l'algorithme "bcrypt" par défaut.Il faudra  sur la page de connexion comparer le hash de la BDD avec celui du mdp fourni lors de la connexion avec la fonction password_verify().
            // debug($mdp);

            $success = executeRequete(
            "INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, :statut)",
            array(
                ':pseudo' =>$_POST['pseudo'],
                ':mdp' => $mdp, // prend le mdp hashé
                ':nom' => $_POST['nom'],
                ':prenom' =>$_POST['prenom'],
                'email' => $_POST['email'],
                ':civilite' => $_POST['civilite'],
                ':ville' =>$_POST['ville'],
                ':code_postal' => $_POST['code_postal'],
                ':adresse'=>$_POST['code_postal'],
                ':statut' => 0 // 0 pour les membres et admin.
            ));

            if ($success){
                $contenu .= '<div class= "alert alert-success">Vous êtes inscrit. Pour vous connecter <a href="connexion.php">cliquez ici.</a></div>';
            }else {
                $contenu .= '<div class="alert alert-danger">Une erreur est survenue.</div>';
            }
        }

    } // fin de if(empty($contenu))

} // fin de if(empty)


// ----------------------
require_once 'inc/header.php';
?>
<h1 class="mt-4"> Inscription </h1>

<?php  echo $contenu; // Pour afficher les messages ?>

<form action="" method="post">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="password" name="mdp" id="mdp" value="<?php echo $_POST['mdp'] ?? ''; ?>"></div>

    <div><label for="nom">Nom</label></div>
    <div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"></div>

    <div><label for="prenom">Prénom</label></div>
    <div><input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"></div>

    <div><label for="email">Email</label></div>
    <div><input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>"></div>

    <div><label for="civilite">Civilité</label></div>
    <div><input type="radio" name="civilite" id="civilite" value="m" checked>Homme</div>
    <div><input type="radio" name="civilite" id="civilite" value="f" <?php if (isset($_POST['civilite'])&& $_POST['civilite'] == 'f' ) echo 'checked' ; ?>>Femme</div>

    <div><label for="ville">Ville</label></div>
    <div><input type="text" name="ville" id="ville" value="<?php echo $_POST['ville'] ?? ''; ?>"></div>

    <div><label for="code_postal">Code Postal</label></div>
    <div><input type="text" name="code_postal" id="code_postal" value="<?php echo $_POST['code_postal'] ?? ''; ?>"></div>

    <div><label for="adresse">Adresse</label></div>
    <div><textarea name="adresse" id="adresse"><?php echo $_POST['adresse'] ?? ''; ?></textarea></div>

    <div><input type="submit" value="S'inscrire" class="btn tn-info mt-4"></div>

</form>

<?php
require_once 'inc/footer.php';


?>