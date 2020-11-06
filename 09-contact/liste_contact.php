<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).
*/
$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));  // ne pas oublier de changer la BDD

function debug($variable) {
    echo '<div style="border: 1px solid orange; padding: 20px;">';
        echo '<pre>';
            print_r($variable);        
        echo '</pre>';
    echo '</div>';
}


// requête en BDD
$resultat = $pdo->query("SELECT * FROM contact");   // on peut faire query() car il n'y a pas besoin de marqueur dans cette requête


?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Liste des contacts</title>
</head>
<body>
	
	<h1>Liste des contacts</h1>
	
	<table>
		<!-- les entêtes -->
		<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Type de contact</th>
			<th>Photo</th>
			<th>Voir</th>
		</tr>

		<?php 
		while ($contact = $resultat->fetch(PDO::FETCH_ASSOC)) {
			// debug($contact); // tableau associatif

			echo '<tr>';
				foreach ($contact as $indice => $information) {
					
					if ($indice == 'photo') {
						echo '<td><img src="'. $information .'" style="width:80px"></td>';
					} else {
						echo '<td>' . $information . '</td>';
					}
				}

				echo '<td><a href="detail_contact.php?id_contact=' . $contact['id_contact'] . '">détail</a></td>';

			echo '</tr>';
		}
		?>
	</table>

</body>
</html>