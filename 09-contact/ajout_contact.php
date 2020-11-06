<?php
/* 1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	
	5- Si une photo est uploadée, ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site.

*/

$contenu = '';
$photo_bdd = '';
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  // ne pas oublier de changer la BDD


function debug($variable) {
    echo '<div style="border: 1px solid orange; padding: 20px;">';
        echo '<pre>';
            print_r($variable);        
        echo '</pre>';
    echo '</div>';
}


debug($_POST);

if (!empty($_POST)) {   // si le formulaire a été envoyé

	// On contrôle les champs du formulaire
	if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) {
		$contenu .= '<div>Le nom doit contenir au moins de 2 caractères.</div>';
	}

	if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 50) {
		$contenu .= '<div>Le prénom doit contenir au moins de 2 caractères.</div>';
	}	

	if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
		$contenu .= '<div>Le téléphone n\'est pas valide.</div>';
	}

	if (!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre')) {
		$contenu .= '<div>Le type de contact n\'est pas valide.</div>';
	}

	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$contenu .= '<div>L\'email n\'est pas valide.</div>';
	}

	//-----------------------
	// Photo
	// debug($_FILES);

	if (!empty($_FILES['photo']['name'])) {  // si un fichier est en cours d'upload

		$nom_fichier = $_FILES['photo']['name'];   // contient le nom du fichier en cours d'upload

		$photo_bdd = 'photo/' . $nom_fichier;   // contient le chemin relatif de la photo inséré en BDD

		copy($_FILES['photo']['tmp_name'], $photo_bdd);  // copie le fichier temporaire qui se trouve dans $_FILES['photo']['tmp_name'] vers la destination $photo_bdd
	}


	//------------------------
	if (empty($contenu)) { // si la variable est vide c'est qu'il n'y a pas d'erreur sur notre formulaire : on peut faire l'insertion en BDD

		// échappement des données :
		foreach ($_POST as $indice => $valeur) {
			$_POST[$indice] = htmlspecialchars($valeur); // pour se prémunir des risques XSS (JS) ou CSS. Cette fonction remplace les < et > en entités HTML (&lt; et &gt;)
		}

		// Requête préparée :
		$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, type_contact, photo) VALUES (:nom, :prenom, :telephone, :email, :type_contact, :photo)");
		$succes = $resultat->execute(array(   // execute retourne TRUE en cas de succès de la requête, sinon FALSE
			':nom'          => $_POST['nom'],
			':prenom'       => $_POST['prenom'],
			':telephone'    => $_POST['telephone'],
			':email'        => $_POST['email'],
			':type_contact' => $_POST['type_contact'],
			':photo'        => $photo_bdd
		));

		if ($succes) {
			$contenu .= '<div>Le contact a été ajouté.</div>';
		} else {
			$contenu .= '<div>Le contact n\'a pas été ajouté.</div>';
		
		}

	}

} // fin du if (!empty($_POST))



// ------------------------------------ AFFICHAGE -------------------------------
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Répertoire</title>
</head>
<body>
	<h1>Ajout d'un contact</h1>

	<?php echo $contenu; ?>

	<form action="" method="post" enctype="multipart/form-data">
	
		<div><label for="nom">Nom</label></div>
		<div><input type="text" name="nom" id="nom"></div>
		
		<div><label for="prenom">Prénom</label></div>
		<div><input type="text" name="prenom" id="prenom"></div>
	
		<div><label for="telephone">Téléphone</label></div>
		<div><input type="text" name="telephone" id="telephone"></div>
	
		<div><label for="email">Email</label></div>
		<div><input type="text" name="email" id="email"></div>

		<div><label for="type_contact">Type de contact</label></div>
		<div>
			<select name="type_contact" id="type_contact">
				<option>choisir un contact</option>
				<option value="ami">Ami</option>
				<option value="famille">Famille</option>
				<option value="professionnel">Professionnel</option>
				<option value="autre">Autre</option><!-- bien remplir les attributs value quand on en met -->			
			</select>		
		</div>

		<div><label for="photo">Photo</label></div>
		<div><input type="file" name="photo" id="photo"></div><!-- il ne faut pas oublier l'attribut enctype="multipart/form-data" dans la balise <form> -->

		<div><input type="submit" value="Enregistrer le contact"></div>

	</form>		

</body>
</html>