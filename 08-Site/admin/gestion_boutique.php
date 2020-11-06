<?php
require_once '../inc/init.php'; //Ne pas oublier de remonter vers le dossier parent avec ../
// 1 - On vérifie que le membre est bien admin, sinon on le redirige vers la page de connexion.
if(!isAdmin()){
    header('location:../connexion.php');
    exit;
}

// 7 - Supression d'un produit
debug($_GET);

if (isset($_GET['id_produit'])) { // s'il y a des "id_produit" dans $_GET donc dans l'URL
    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    // debug($resultat->rowCount()); // On obtient 1 lors de la suppression d'un produit.

    if ($resultat->rowCount() == 1){ // Si le DELETE retourne une ligne c'est que la requête a marché.
        $contenu .= '<div class="alert alert-success">Le produit a bien été supprimé.</div>';
    }else {
        $contenu .= '<div class="alert alert-danger">Le produit n\'a pas pu être supprimé </div>';
    }
}

// 6 - Listes des produits dans une table HTML:
$resultat = executeRequete("SELECT * FROM produit"); // On sélectionne tous les produits

$contenu .= 'Nombre de produits dans la boutique : ' .  $resultat->rowCount();
$contenu .= '<table class="table">';
    // les entêtes
$contenu .= '<tr>';
    $contenu .= '<th>ID</th>';
    $contenu .= '<th>Référence</th>';
    $contenu .= '<th>Catégorie</th>';
    $contenu .= '<th>Titre</th>';
    $contenu .= '<th>Description</th>';
    $contenu .= '<th>Couleur</th>';
    $contenu .= '<th>Taille</th>';
    $contenu .= '<th>Public</th>';
    $contenu .= '<th>Photo</th>';
    $contenu .= '<th>Prix</th>';
    $contenu .= '<th>Stock</th>';
    $contenu .= '<th>Actions</th>'; // Colonne pour les liens modifier et supprimer.
$contenu .='</tr>';


// Les lignes de produit 
// debug($resultat);
while($produit = $resultat->fetch(PDO::FETCH_ASSOC)){
    // debug($produit); // Puisque $produit est un tableau, on le parcours avec une boucle foreach() :
        $contenu .= '<tr>'; // On créé une ligne de <table> par produit
        foreach($produit as $indice => $information) { // $information parcours les valeurs de $produit

            if($indice == 'photo'){ // Si l'indice se trouve sur le champ "photo", on affiche une balise <img>:
                $contenu .= '<td><img src="../' . $information . '" style="width:90px"></td>'; // $information contient le chemin relatif de la photo vers le dossier "photo/" qui se trouve dans le dossier parent.On concatène donc "../".
            }else { // Sinon on affiche les autres valeurs dans un <td> seul :
            $contenu .= '<td>' . $information . '</td>';
        }
    }
    // On ajoute les liens "modifier" et "supprimer" :
        $contenu .= '<td>

                    <a href="formulaire_produit.php?id_produit=' . $produit['id_produit'] . '">Modifier</a> | <a href="?id_produit=' .$produit['id_produit'] . '"onclick="return confirm(\'Etes-vous certain de vouloir supprimer ce produit ?\');">Supprimer </a>

                    </td>';
                        
    $contenu .= '</tr>';
        
}
$contenu .='</table>';


require_once '../inc/header.php';
// 2 - Onglets de navigation

?>


<h1 class="mt-4">Gestion de la boutique</h1>

<ul class="nav nav-tabs">
    <li class="nav-link"><a href="gestion_boutique.php">Listes des produits</a></li>
    <li class="nav-link"><a href="formulaire_produit.php">Formulaire produit</a></li>
</ul>


<?php
echo $contenu; // Pour afficher les messages et le tableau des produits. 
require_once '../inc/footer.php';

?>

