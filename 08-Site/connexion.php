<?php
require_once 'inc/init.php';
$message =''; // Pour afficher le message de déconnexion

// 2 -  Déconnexion du membre 
// debug($_GET);
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){ // si "action" est dans l'URL et qu'il a pour valeur "deconnexion", c'est que le membre a cliqué sur "Déconnexion".
    unset($_SESSION['membre']); // On vide la session de sa partie membre tout en conservant l'éventuelle partie "panier".
    $message .= '<div class="alert alert-info">Vous êtes déconnecté.</div>';

}

// 3 - On vérifie que le membre n'est pas déjà connecté.Sinon on le redirige vers le profil :
    if(islogged()){
        header ('location:profil.php'); // On n'autorise pas la reconnexion mais on redirige vers profil.php
        exit; // On quitte ce script.
    }


// 1 - Traitement du formulaire
// debug($_POST);

if(!empty($_POST
)){ // Si le formulaire a été envoyé

    // Contrôles du formulaire
    if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ // Si le pseudo OU le mdp est vide.
        $contenu .= '<div class=" alert alert-danger">Les identifiants sont obligatoires ! </div>';
    }

    // Si les champs sont remplis, on vérifie le pseudo puis le MDP en BDD:
        if(empty($contenu)){ // Si la variable est vide, c'est qu'il n'y a pas de message d'erreur.
            $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo'=> $_POST['pseudo']));
            
            if ($resultat->rowCount() ==1){ // SI il y a une ligne de résultats, c'est que le pseudo est dans la BDD: on peut alors vérifier le mdp.
                // debug($resultat);

                 $membre = $resultat->fetch(PDO::FETCH_ASSOC); // On "fetch" $resultat(qui est un objet) pour en extraire les données, sans boucle car le pseudo est unique en BDD.
                // debug($membre);

                if (password_verify($_POST['mdp'], $membre['mdp'])){ // password_verify() retourne true si le hash de la BDD correspond au mdp du formulaire.
                    // On peut connecter le membre :
                    $_SESSION['membre'] = $membre; // Pour connecter le membre on crée une session appelée "membre" avec toutes les infos du membre qui viennent de la BDD.

                    header('location:profil.php'); // Les identifiants étant corrects, on redirige l'utilisateur vers la page profil.php.
                    exit; //Et on quitte ce script.
                } else { // Sinon c'est que le MDP est erroné
                    $contenu .= '<div class=" alert alert-danger"> Erreur sur les identifiants ! </div>';
                }

            }else { // Sinon, c'est que le pseudo n'est pas dans la BDD.
                $contenu .= '<div class=" alert alert-danger"> Erreur sur les identifiants ! </div>';
            }
        }
} // fin du if(!empty($_POST
 


// ---------------AFFICHAGE --------------------
require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>

<?php
echo $message; // Pour afficher le message de déconnexion.
echo $contenu; // Pour afficher les autres messages.
?>

<form action="" method="post">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="password" name="mdp" id="mdp"></div>

    <div><input type="submit" value="Se connecter" class="btn btn-info mt-4"></div>

</form>


<?php
require_once 'inc/footer.php';


?>