<?php
require_once '../inc/init.php';
 /* Exercice :
 1 - Seul un administrateur a accès à cette page.Les autres membres seront redirigés vers connexion.php
 2 - Afficher dans cette page, tous les membres inscrits dans une table HTML,avec toutes les informations du membre SAUF mot de passe.
 3 - Vous ajoutez une colonne "action sans laquelel vous mettez un lien pour pouvoir supprimer un membre, SAUF vous même qui êtes connecté. Bonus : demander la confirmation en JS.
 */

// 1 - Seul un administrateur a accès à cette page.Les autres membres seront redirigés vers connexion.php
if (!isAdmin()){
    header('location:../connexion.php');
    exit;
}

// 3 - Suppression du membre
debug($_GET);

if(isset($_GET['id_membre'] )){ // Si on a "id_membre" dans l'URL,c'est qu'on demande sa suppression.
    debug($_SESSION);

    if ($_GET['id_membre'] != $_SESSION['membre']['id_membre']) { // Si l'ID passé dans l'URL est différent de l'ID présent dans la session, donc du membre connecté, c'est donc que je n'ai pas cliqué sur moi même.
        // On supprime le membre :
        $resultat = executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

        if($resultat->rowCount() == 1) { // Si le DELETE retourne une ligne, c'est qu'elle a été bien supprimée.
            $contenu .= '<div class="alert alert-success">Le membre a bien été supprimé.</div>';
        } else{
            $contenu .= '<div class="alert alert-danger">Le membre n\'a pas pu être supprimé.</div>';
        }
    } else {
    $contenu .= '<div class="alert alert-danger">Vous ne pouvez pas supprimer votre propre profil.</div>';
    }
}

// 2 - Afficher les membres et toutes leur informations sans les mot de passe dans une table HTML

$resultat = executeRequete("SELECT id_membre,pseudo,nom,prenom,email,civilite,ville,code_postal,adresse,statut FROM membre");

$contenu .= '<table class="table">';
    // Les entêtes 
    $contenu .= '<tr>';
        $contenu .= '<th>ID</th>';
        $contenu .= '<th>Pseudo</th>';
        $contenu .= '<th>Nom</th>';
        $contenu .= '<th>Prenom</th>';
        $contenu .= '<th>email</th>';
        $contenu .= '<th>Civilite</th>';
        $contenu .= '<th>Ville</th>';
        $contenu .= '<th>Code Postal</th>';
        $contenu .= '<th>Adresse</th>';
        $contenu .= '<th>Statut</th>';
    $contenu .= '</tr>';

while($membre = $resultat->fetch(PDO::FETCH_ASSOC)){
    // debug($membre);
    $contenu .= '<tr>'; // On créé une ligne  par produit
    foreach($membre as $indice => $information) { // $information parcours les valeurs de $produit
        $contenu .= '<td>' . $information . '</td>';
}
    $contenu .= '<td>
                <a href="?id_membre=' .$membre['id_membre'] . '"onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce membre ?\');">Supprimer </a>
                </td>';
 $contenu .= '</tr>';

}

$contenu .= '</table>';

require_once '../inc/header.php';

echo '<h1 class="mt-4">Gestion des membres </h1>';

echo $contenu;















require_once '../inc/footer.php';

?>