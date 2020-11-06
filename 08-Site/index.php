<?php
require_once 'inc/init.php';
$contenu_gauche = ''; // Pour le HTML du bloc "contenu_gauche" (catégorie)
$contenu_droite = ''; // Pour le HTML du bloc "contenu_droite"(produits)

 // 1 - Affichage des catégories.
$resultat = executeRequete("SELECT DISTINCT categorie FROM produit"); // On sélectionne toutes les catégories en enlevant les doublons avec DISTINCT.
$contenu_gauche .= '<div class="list-group mb-4">';
    // Lien "toutes les catégories" :
    $contenu_gauche .= '<a href="?categorie=all" class="list-group-item">Toutes les catégories</a>'; // On passe dans l'URL que la catégorie est "all" vers la même page.

    // Liens des catégories de la BDD :
    while($categorie = $resultat ->fetch(PDO::FETCH_ASSOC)){
        // debug($categorie); //$categorie est un tableau avec indice "categorie"
        $contenu_gauche .= '<a href="?categorie='. $categorie['categorie'] .'" class="list-group-item">'. $categorie['categorie'] .'</a>';
    }
$contenu_gauche .= '</div>';

// 2 - Affichage des produits.
debug($_GET);

if(isset($_GET['categorie']) && $_GET['categorie'] != 'all'){ // Si on a demandé une catégorie autre que "toutes les catégories", on sélectionne  en BDD les produits de la catégorie demandée :
    $resultat = executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie']) ); 
} else { // Sinon si "categorie" n'est pas dans l'URL (j'arrive pour la première fois sur la page) ou que l'on a choisi "toutes les catégories", on sélectionne tout les produits.
    $resultat = executeRequete("SELECT id_produit, reference, titre, photo, prix, description FROM produit");
}

while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)){ // On fait une boucle car il y a plusieurs produits.
    debug($produit);

    $contenu_droite .= '<div class="col-md-4 mb-4">';
    $contenu_droite .= '<div class="card">';
    $contenu_droite .= '</div>'; // fermeture de la div .card
        // Image cliquable
    $contenu_droite .= '<a href="detail_produit.php?id_produit='. $produit['id_produit'] .'"><img class="card-img-top" src="'. $produit['photo'] .'" alt="'. $produit['titre'] .'"></img></a>'; // On envoie à la page detail_produit.php l'id_produit par l'URL.

    // Infos du produit 
    $contenu_droite .= '<div class="card_body">';
        $contenu_droite .= '<h4>' .$produit['titre'] . '</h4>';
        $contenu_droite .= '<h4>' .$produit['prix'] . ' € TTC </h4>';
        if(strlen($produit['description']) > 20 ){ // Si la longueur est supérieure à 20, on coupe:
            $contenu_droite .= '<p>' . substr($produit['description'],0, 20) .' ...</p>'; // Exercice : Couper la description à partir de 20 caractères et ajouter des points de suspension.
        }else{ // Sinon on laisse le champ en entier.
            $contenu_droite .= '<p>' . $produit['description'] .' </p>'; 
        }
       
        
        

    $contenu_droite .= '</div>'; // .card-body


    $contenu_droite .= '</div>';

}


// ----------------
require_once 'inc/header.php';
?>

<h1 class="mt-4">Nos vêtements</h1>

<div class="row">
    <div class="col-md-3"> <!-- Va afficher les catégories de vêtements --> 
        <?php echo $contenu_gauche;?>
    </div>
    <div class="col-md-9"> <!-- Va afficher les produits -->
        <div class="row">
            <?php echo $contenu_droite; ?>
        </div>
    </div>



</div> <!-- Fin de la div row-->











<?
require_once 'inc/footer.php';

?>