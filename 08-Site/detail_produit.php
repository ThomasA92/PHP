<?php 
require_once 'inc/init.php';

// 1 - Contrôle de l'existence du produit demandé (1 produit a pu être mis en favoris et supprimé de la BDD.)
// debug($_GET);

if (isset($_GET['id_produit'])){ // S'il y a un id_produit dans l'URL.
    // On vérifie l'existence du produit en BDD :
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit'=> $_GET['id_produit']));

        if($resultat->rowCount() == 0){ // Si $resultat n'a pas de lignes, c'est que le produit n'est pas en BDD.On redirige aussi vers la boutique.
            header('location:index.php');
            exit;
        }

    // 2- On prépare les données du produit à afficher.
    // debug($resultat); // Il faut faire un fetch sur cet objet PDOStatement sans boucle car il n'y a qu'un seul produit par ID.
    $produit =$resultat->fetch(PDO::FETCH_ASSOC);
    // debug($produit);
    extract($produit); // Cette fonction prédéfinie crée des variables nommées comme les indices du tableau et auxquelles on affecte les valeurs du tableau.Exemple : $produit['titre'] devient la variable $titre.
} else{
    header('location:index.php'); // S'il n' y a pas d'id_produit dans l'URL, on redirige vers la boutique.
    exit;
}// fin du if(isset($_GET['id_produit']))

// --------AFFICHAGE-------------------
require_once 'inc/header.php';
?>

    <div class="row">

        <div class="col-12">
            <h1 class="mt-4"><?php echo $titre; ?></h1>
        </div>

        <div class="col-md-8"> <!-- Photo -->
            <img class="img-fluid w-75" src="<?php echo $photo; ?>" alt="<?php echo $titre; ?>">
        </div>

        <div class="col-md-4">
            <h2>Description</h2>
            <p><?php echo $description; ?></p>

            <h2>Détails</h2>
            <ul>
                <li>Catégorie : <?php echo $categorie; ?></li>
                <li>Couleur : <?php echo $couleur; ?></li>
                <li>Taille : <?php echo $taille; ?></li>
            </ul>

            <div class="lead">Prix : <?php echo number_format($prix,2,",",""); ?> € TTC </div>

            <div><a href="index.php?categorie=<?php echo $categorie; ?>">Retour vers votre sélection</a></div>
        
        
        
        </div>
    
    </div> <!-- fermeture .row -->


<?php
require_once 'inc/footer.php';
?>