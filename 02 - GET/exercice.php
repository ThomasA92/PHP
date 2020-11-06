<?php
// Exercice :
// - Vous créez 3 liens HTML : bananes, kiwis et cerises.
// Quand on clique sur 1 lien, vous passez dans l'URL uniquement le nom du fruit vers la page exercice.php.Pour cela vous remplissez le href
// - Quand un fruit est demandé,vous affichez son prix selon la phrase "le prix des .. est de ...euros au kilo." dans cette même page.

print_r($_GET); // pour vérifier que l'on reçoit les données(le fruit

if (isset($_GET['nom'])){ // s'il y a "fruit" dans $_GET, donc dans l'URL, c'est qu'on a cliqué sur le lien.
    if($_GET['nom']== 'bananes'){
        echo 'le prix des bananes est de 1.5 euros au kilo.';
    }elseif($_GET['nom'] == 'kiwis'){
        echo 'Le prix des kiwis est de 3.50 euros au kilo';
    }elseif ($_GET['nom'] == 'cerises'){
        echo 'Le prix des cerises est de 5.00 euros au kilo';
    }else{
        echo 'Fruit inexistant...';
    }
}

?>

<h1>Nos produits</h1>

<div>
    <a href="exercice.php?nom=bananes">Bananes</a> <!-- quand on envoie les données à la même page, on peut commencer directement par le point d'interrogation --> 
</div>

<div>
    <a href="?nom=kiwis">Kiwis</a>
</div>

<div>
    <a href="?nom=cerises">Cerises</a>
</div>

