<?php
require_once '../inc/init.php'; //Ne pas oublier de remonter vers le dossier parent avec ../
// 1 - On vérifie que le membre est bien admin, sinon on le redirige vers la page de connexion.
if(!isAdmin()){
    header('location:../connexion.php');
    exit;
}


// 4 - Insertion du produit en BDD
// debug($_POST);

if (!empty($_POST)){ // Si le formulaire a été envoyé

    // Ici il faudrait mettre les conditions de contrôle du formulaire
    
    $photo_bdd = ''; // Le champ "photo" est vide par défaut en BDD.

    // 9 - Suite(ligne120).Modification de la photo:
        if (isset($_POST['photo_actuelle'])){ // Si existe "photo_actuelle" dans $_POST, c'est que je suis en train de modifier le produit.Je veux remettre le chemin de la photo en BDD.
            $photo_bdd = $_POST['photo_actuelle']; // Alors on affecte le chemin de la photo actuelle à la variable $photo_bdd qui est inséré en BDD.
        }

    // 5 suite - Traitement de la photo :
    // debug($_FILES); // $_FILES est une superglobale générée par le type="file" du champ "photo" du formulaire.Le premier indice de $_FILES correspond au "name" de cet input.A cet indice on trouve toujours un sous-tableau de l'indice "name" qui contient le nom du fichier en cours d'upload,l'indice "type" qui contient le type du fichier (ici image), l'indice "size" qui contient sa taille en octets.

    if (!empty($_FILES['photo']['name'])){ // SI n'est pas vide le nom de la photo, c'est qu'un fichier est en cours d'upload.
        
        $nom_fichier = $_FILES['photo']['name']; // on récupère le nom du fichier
        $photo_bdd = 'photo/' . $nom_fichier; // Cette variable contient le chemin relatif de l'image que l'on insère en BDD(elle est dans le dossier photo/ et s'appelle $nom_fichier).
        copy($_FILES['photo']['tmp_name'], '../' .$photo_bdd); // On copie le fichier temporaire qui est dans $_FILES['photo']['temp_name'] vers le répertoire dont le chemin est "../photo/nom_fichier".
    }

    // 4 - Suite - Insertion du produit en BDD.
    $success = executeRequete("REPLACE INTO produit VALUES(:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)",
                            array(
                                ':id_produit' => $_POST['id_produit'],
                                ':reference' => $_POST['reference'],
                                ':categorie' =>$_POST['categorie'],
                                ':titre' =>$_POST['titre'],
                                ':description' =>$_POST['description'],
                                ':couleur' =>$_POST['couleur'],
                                ':taille' =>$_POST['taille'],
                                ':public' =>$_POST['public'],
                                ':photo' =>$photo_bdd, // Chemin de la photo uploadé qui est vide par défaut.
                                ':prix' =>$_POST['prix'],
                                ':stock' =>$_POST['stock'],
                                ));

    if ($success) { // Si on a reçu un objet PDOStatement c'est que la requête a marché.
        $contenu .= '<div class="alert alert-success">Le produit a bien été enregistré</div>';
    }else { // Sinon on a reçu false, la requête n'a pas marché
        $contenu .= '<div class="alert alert-danger>Erreur lors d l\'enregistrement !</div>';
    }

} // Fin du if(!empty($_POST))

// 8 - Modification du produit :
    // Exercice : si "id_produit" est dans l'URL, alors vous sélectionnez tout les champs du produit demandé. Puis vous affichez les informations de ce produit dans un debug.
// debug($_GET);
    if (isset($_GET['id_produit'] )){ // Si id_produit est dans l'URL c'est qu'on a demandé la modification d'un produit.
        $resultat = executeRequete('SELECT * FROM produit WHERE id_produit =:id_produit ',array(':id_produit' => $_GET['id_produit']));
        $produit = $resultat->fetch(PDO::FETCH_ASSOC); // $produit est un tableau associatif dont on va mettre les valeurs dans les champs du formulaire.
        debug($produit);
    }


require_once '../inc/header.php';
// 2 - Onglets de navigation
?>

<h1 class="mt-4">Gestion de la boutique</h1>

<ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link" href="gestion_boutique.php">Listes des produits</a></li>
    <li class="nav-item"><a class="nav-link active" href="formulaire_produit.php">Formulaire produit</a></li>
</ul>


<?php
echo $contenu; // Pour afficher les messages et le tableau des produits. 

// 3 - Formulaire de produit
?>
<form action="" method="post" enctype="multipart/form-data"> <!-- L'attribut enctype="multipart/form-data" spécifie que le formulaire envoie des données binaires(fichier) et du texte(champs du formulaire): permet d'upload un fichier(exemple:photo).-->

    <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit'] ?? 0; ?>"> <!-- Le champ caché id-produit est nécessaire pour la MODIFICATION d'un produit (UPDATE) car on a besoin de récupérer l'ID du produit modifié pour la requête SQL "REPLACE INTO". Quand on crée un produit nouveau (INSERT) on met une valeur par défaut 0 pour que "REPLACE INTO" se comporte comme un "INSERT" . -->

    <div><label for="reference">Reference</label></div>
    <div><input type="text" name="reference" id="reference" value="<?php echo $produit['reference'] ?? '' ; ?>"></div>

    <div><label for="categorie">Categorie</label></div>
    <div><input type="text" name="categorie" id="reference" value="<?php echo $produit['categorie'] ?? '' ; ?>"></div>

    <div><label for="titre">Titre</label></div>
    <div><input type="text" name="titre" id="titre" value="<?php echo $produit['titre'] ?? '' ; ?>"></div> <!-- Il n'y a pas de value sur le textearea-->

    <div><label for="description">description</label></div>
    <div><textarea name="description" id="description" ><?php echo $produit['description'] ?? '' ; ?></textarea></div>

    <div><label for="couleur">Couleur</label></div>
    <div><input type="text" name="couleur" id="couleur" value="<?php echo $produit['couleur'] ?? '' ; ?>"></div>

    <div><label for="taille">Taille</label></div>
    <div>
        <select name="taille" id="taille">
            <option value="S">S</option>
            <option value="M" <?php if(isset($produit['taille']) && $produit['taille'] == 'M')echo 'selected'; ?>   >M</option>
            <option value="L" <?php if(isset($produit['taille']) && $produit['taille'] == 'L')echo 'selected'; ?> >L</option>
            <option value="XL" <?php if(isset($produit['taille']) && $produit['taille'] == 'XL')echo 'selected'; ?>>XL</option>
        </select>
    </div>

    <div><label for="public">public</label></div>
    <div><input type="radio" name="public" id="public" value="m" checked>Masculin</div>
    <div><input type="radio" name="public" id="public" value="f" <?php if(isset($produit['public']) && $produit['taille'] == 'f') echo 'checked'; ?> >Féminin</div>
    <div><input type="radio" name="public" id="public" value="mixte" <?php if(isset($produit['public']) && $produit['public'] == 'mixte' )echo 'checked'; ?> >Mixte</div> <!-- Attention, le champ public est un ENUM en BDD qui n'attend que les valeurs "m", "f" ou "mixte". -->

    <div><label for="photo">Photo</label></div>
    <!-- 5 - Upload de photos  -->
    <input type="file" name="photo" ><!-- le type="file" permet de remplir la superglobale $_FILES.Le name="photo" correspond à l'indice de $_FILES['photo'].Pour uplaoder un fichier, il ne faut pas oublier l'attribut enctype="multipart/form-data" sur la balise "form"-->

    <!-- 9 - Modification de la photo : Il nous faut mettre la valeur du champ photo du $produit dans le formulaire pour le renvoyer en BDD à la place du string vide par défaut contenu dans $photo_bdd. -->
    <?php
    if(isset($produit['photo'])){ // Si existe $produit['photo'] c'est que nous en sommes en train de modifier le produit.
        echo '<div>photo actuelle du produit </div>';
        echo '<div><img src="../'. $produit['photo'] .'" style="width: 90px"></img></div>'; // On affiche la photo actuelle dont le chemin est dans le champ photo de la bdd donc dans $produit.
        echo '<input type="hidden" name="photo_actuelle" value="' . $produit['photo'] . '">'; // On crée ce champ caché pour remettre le chemin de la photo actuelle, dans le formulaire, donc dans $_POST à l'indice "photo_actuelle".Ainsi, on réinsère ce chemin en BDD lors de la modification.
    }

    ?>


    <div><label for="prix">Prix</label></div>
    <div><input type="text" name="prix" id="prix" value="<?php echo $produit['prix'] ?? '' ; ?>"></div>

    <div><label for="prix">Stock</label></div>
    <div><input type="text" name="stock" id="stock" value="<?php echo $produit['stock'] ?? '' ; ?>"></div>

    <div><input type="submit" value="Enregistrer le produit" class="btn btn-info mt-4"></div>
  
</form>


<?php
require_once '../inc/footer.php';

?>

