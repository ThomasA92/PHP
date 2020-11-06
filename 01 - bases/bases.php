<style>
    h2{
        border-top:1px solid navy;
        border-bottom: 1px solid navy;
        color:navy;
    }
    .bu{
        color:blue;
    }
    .bc{
        color:grey;
    }
    .red{
        color:red;
    }
    
    table, td{
        border: 1px solid green;
        border-collapse : collapse;
    }
</style>

<?php
// -----------------------------
echo '<h2>Les balises PHP </h2>';
// -------------------------------
?>

<p>Ici je suis en HTML car en dehors des balises de PHP </p>

<?php // pour ouvrir un php j'utilise cette balise

// Vous n'êtes pas obligé de fermer un passage en PHP quand vous êtes à la fin duscript .

// Pour faire un commentaire sur une ligne 
# sur une ligne
/*
Pour le faire sur plusieurs lignes
*/

// -----------------------------
echo '<h2>Affichage </h2>';
// -------------------------------

echo 'Bonjour<br>'; // rappel:Echo est une instruction pour afficher dans le navigateur.Toutes les instructions se terminent  par un ; OBLIGATOIREMENT.

print 'Nous sommes mardi<br>' ; // autre instruction d'affichage qui fait la même chose que echo.

// Autres instructions que nous utiliserons :
print_r('code'); // permet d'afficher le contenu d'une variable dans le navigateur.
echo '<br>'; // saut de ligne
var_dump('code'); // même chose que print_r mais affiche les types en plus.

// -------------------------
echo '<h2> Variable </h2>';
// -------------------------
// Une variable est un espace mémoire qui porte un nom et qui permet de stocker une valeur.
// En PHP, on représente une variable avec le signe $.

$a = 127; // on déclaire la variable $a et lui affecte (on donne) la valeur 127.
echo gettype($a); // gettype() est une fonction prédéfinie qui permet d'afficher le type d'une variable.Ici c'est un INTEGER.
echo '<br>';

$a = 1.5; // on remplace la valeur 127 par 1.5 dans $a.
echo gettype($a); //ici c'est un DOUBLE = FLOAT (nombre décimal)
echo '<br>';

$a = 'une chaîne';
echo gettype($a); // ici c'est STRING (= chaine de caractères)
echo '<br>';

$a = true; // ou false
echo gettype($a); // ici c'est un BOOLEAN (= booléen)

// par convention, un nom de variable commence par une lettre minuscule, puis on met une majuscule à chaque mot.Il peut contenir des chiffres (jamais au début), ou un "_"(pas au début ni ç la fin).Pas d'espace, pas d'accent, pas de caractères spéciaux.

// ------------------------------
echo '<h2> Concaténation </h2>';
// ------------------------------
// En PHP on concatène (= faire suivre)les éléments avec le "." 

$x = 'Bonjour';
$y = 'tout le monde';
echo $x . $y . '<br>'; //On concatène les deux variables  et un string.Le point de concaténation peut être traduit par "suivi de.".

//-----
echo '<hr> Concaténation et affectation combinées avec .= <br>';
$message = 'Erreur sur le pseudo <br>';
$message .= "Erreur sur le mot de passe <br>"; // On affecte le second message à la variable en plus de la valeur précédente.Le .= permet d'ajouter sans remplacer.
echo $message;

// ---------------------------------
echo '<h2>Guillemets et quotes </h2>';
// -------------------------------

$message = "aujourd'hui" ; // ou alors :
$message = 'aujourd\'hui' ; // on échappe l'apostrophe écrite dans des quotes simples.

$txt = 'Bonjour';
echo "$txt tout le monde <br>"; // Dans les guillemets c'est son contenu qui est affiché.
echo '$txt tout le monde <br>'; // Dans des quotes simples, tout est du texte brut.on voit donc le nom de la variable en toute lettre.

// -------------------------------
echo '<h2> Constante  </h2>';
// -------------------------------
/* Une constante est comme une variable qui permet de conserver une valeur, mais celle ci ne peut être modifié durant l'exécution du script.
Exemple d'utilisation: on met les paramêtres de la BDD(base de données) pour ne pas risquer de les modifier.
*/

// Methode 1
define('CAPITALE_FRANCE','PARIS'); /* On déclare la constante CAPITALE_FRANCE et on lui affecte la valeur PARIS.
Par convention on l'écrit en majuscules.
*/
echo CAPITALE_FRANCE . '<br>';

// méthode 2
const TAUX_CONVERSION = 6.55957; // On peut aussi déclarer une constante avec "const".
echo TAUX_CONVERSION . '<br>';

// --
// Exercice: vous affichez "Bleu-Blanc-Rouge" en mettant le texte de chaque couleur dans une variable.

// $bleu = "<div class=bu>Bleu</div>";
// $blanc = "<div class=bc>Blanc</div>";
// $rouge = "<div class=red>Rouge</div>";

$bleu ='Bleu';
$blanc = 'Blanc';
$rouge = 'Rouge';
echo "$bleu . '-' $blanc '-' . $rouge <br>";
echo"$bleu-$blanc-$rouge <br>";

$drapeau ='Bleu';
$drapeau .= '-Blanc';
$drapeau .= '-Rouge';

echo $drapeau;

// -------------------------------
echo '<h2> Opérateurs arithmétiques  </h2>';
// -------------------------------
$a = 10;
$b = 2;

echo $a + $b .'<br>'; //affiche 12
echo $a - $b .'<br>'; // affiche 8
echo $a * $b .'<br>'; // affiche 20
echo $a / $b .'<br>'; // affiche 5
echo $a % $b .'<br>'; // affiche 0(vous avez 3 billes que vous répartissez sur 2 joueurs.Il reste 1 bille dans la main) : 3%2 = 1;

// -------
// Les opérateurs combinés :
$a += $b; // équivant à $a = $a + $b soit $a vaut  12.
$a -=$b; // équivaut à $a = $a -$b soit $a vaut 10 à la fin.
$a *= $b; // équivaut à $a = $a *$b soit $a vaut 20 à la fin.
$a /= $b; // équivaut à $a = $a / $b soit $a vaut 10 à la fin.
$a %= $b; //  équivaut à $a = $a % $b soit $a vaut 0 à la fin.

//--------------
//incrémenter et décrementer 
$i = 0;$i++; // incrementation : on ajoute 1 à $i. $i vaut donc 1.
$i--; // décrementation : on retire 1 a $i. $i vaut donc 1.

// -------------------------------
echo '<h2> conditions  </h2>';
// -------------------------------
$a = 10;
$b = 5;
$c = 2;

// if ...else :
    if ($a > $b){ // si la condition est évaluée à true, c'est à dire que $a est supérieur à $b, alors on entre dans les accolades qui suivent :
        echo '$a est bien supérieur à $b<br>';
    }else{  // sinon on exécute le else :
        echo 'Non, c\'est $ b qui est supérieur à $a <br>';
    }

    //-----
    // L'opérateur AND qui s'écrit && :!
    if($a > $b && $b > $c){ // si $a est supérieur à $b et que dans le même temps, $b est supérieur à $c, alors on entre dans les accolades :
        echo 'Vrai pour les 2 conditions <br>';
    }

    // TRUE && TRUE => TRUE
    // FALSE && FALSE => FALSE
    // TRUE && FALSE => FALSE

    //--------
    // L'opérateur OR qui s'écrit || :
    if ($a == 9 || $b > $c){ // Si $a estr égale (==) à 9 ou alors que $b est supérieur à $c, alors on entre dans les accolades :
    echo 'Vrai pour au moins une des deux conditions <br>';    
    }else{
        echo'Les deux conditions sont fausses <br>';
    }

    //-----------
    // if.... elseif ...else :
        if($a == 8){
            echo 'Réponse 1 : $a est égal à 8 <br>';
        }elseif($a != 10) {
            echo 'Réponse 2 : $a est différent de 10 <br>';
        }else {
            echo 'Réponse 3 : les deux conditions précédentes sont fausses <br>';
        }// pas de ";" à la fin des structures 

        /* TRUE || TRUE => TRUE
         FALSE || FALSE =>FALSE
         TRUE || FALSE => TRUE
        Avec or il faut que l'une des conditions soit vrai.
         */
        
        //--------
        // Forme contracutée dite "ternaire":
        // Autre syntaxe du if.
        $a = 10;

        echo ($a == 10) ? 'Oui $a est égal à 10 <br>' : 'Non, $a est différent de 10<br>';
        // Dans cette syntaxe, le "?" remplace le if, et le ":" remplace le else.On affiche le premier string si $a est égal à 10, sinon on affiche le second.

/*--------
Différence entre  == et === 
*/  
$varA = 1; // integer
$varB = '1'; // string

if ($varA == $varB){ // comparaison en valeur uniquement.
    echo '$varA est égal à $varB en valeur uniquement <br>';
}

if($varA === $varB) { // Comparaison en valeur et en type.
    echo '$varA est égal à varB en valeur et en type <br>';
}else {
    echo '$varA est différent de $varB en type ou en valeur <br>';
}

// Pour mémoire : le simple "=" => pour affecter.

//--------
/* isset () et empty ():
 - empty () teste si la variable est vide : 0, string vide '', NULL,false, ou non définie
- isset() teste si la variable existe et est différente de NULL.
*/

$var1 = 0;
$var2 = '';

if (empty($var1))echo '$var1 est vide (0, "",NULL, false ou non définie)';
// comme $var1 contient 0, il est empty
if (isset($var2)) echo '$var2 existe et est non NULL <br>';
// comme $var2 est déclaré (et non contient pas NULL)il est isset.

/* Exemple d'utilisation : 
- empty pour vérifier qu'un champ de formulaire est rempli.
- isset pour vérifier l'existence d'une varaible avant de l'utiliser.
*/

/* ------
L'opérateur NOT qui s'écrit "!" : */
$var3 = 'quelque chose';
if (!empty($var3)) echo '$var3 n\'est pas vide <br>'; // "!" pour NOT qui est une négation.Ici cela signifie si $var3 n'est pas vide.

// !TRUE => FALSE
// !FALSE => TRUE


/*  -----------
- PHP7 : afficher une variable si elle existe avec l'opérateur NULL coalescent qui s'écrit "??" :
phpinfo(); => pour fournir les valeurs des paramètres serveur. 
*/

echo $maVar ?? 'valeur par défaut <br>'; // on affiche la variable $maVar SI ELLE EXISTE, sinon on affiche 'valeur par défaut'.
// On s'en servira pour maintenir les valeurs dans un formulaire.

// -------------------------------
echo '<h2> switch </h2>';
// -------------------------------
// La condition switch est une autre syntaxe pour  écrire un if / elseif /elseif/eslse quand on veut comparer une variable à une multitude de valeurs.

$langue = 'chinois';
switch($langue){
    case 'français': // on compare $langue à la valeur des "case" et exécute le code qui suit si elle correspond:
        echo'Bonjour !';
    break; // obligatoire pour quitter la structure une fois le "case" exécuté.

    case 'italien' : 
        echo 'Buongiorno !';
    break;
    case 'espagnol' : 
        echo'Hola !';
    break;
    default : // cas par défaut si on entre pas dans les "case" précédents.
        echo 'Hello !';
    break;
}
echo '<br>';
// Exercice : vous réécrivez ce switch en if... pour obtenir les mêmes résultats.

if($langue =='français'){
    echo 'Bonjour!';
}elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol'){
    echo 'Hola !';
}else {
    echo 'Hello !';
}

// -------------------------------
echo '<h2> Fonctions prédéfinies </h2>';
// -------------------------------
/* Une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP. */

// strpos() : 
$email = 'prenom@site.fr <br> ';
echo strpos($email, '@'); // indique la position de la chaîne '@' dans la $email

echo '<br>';

//strlen() :
$phrase = 'mettez une phrase à cet endroit';
echo strlen ($phrase); // affiche la taille d'une chaîne(compte le nombre d'octets, un caractère accentué comptant pour deux d'ou le résultat qui est égal à 32).

echo '<br>';

// substr() :
$texte = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor dignissimos earum at magni sequi, fugiat officia consequatur qui deleniti, doloribus sapiente totam odio temporibus id sint nemo esse, magnam repellendus.';
echo substr($texte, 0, 20). '...<a href="">lire la suite </a>';// retourne une partie de la chaîne $texte en partant du point 0 et en prenant une longueur de 20 octets.

echo '<br>';

// exemple : pour découper le "fr" à la fin de $email
$start = strpos($email, '.'); // on cherche la position du "." dans $email.
echo substr($email, $start + 1); // et on affiche la partie de l'email après le "."jusqu'à la fin.

// strtolower(), strtoupper(), trim() :
$message = '   Hello World !    ';
echo strtolower ($message). '<br'; // Affiche tout en minuscule.
echo strtoupper($message) . '<br>'; // Affiche tout en majuscule.
echo strlen($message); // on compte avec les espaces.
echo strlen(trim($message)). '<br>'; // on supprime les espaces au début et à la fin de $message avec trim(), puis on compte le tout sans les espaces.

echo str_replace(' ', '', $message); // 

// -------------------------------
echo '<h2> Fonctions utilisateurs</h2>';
// -------------------------------
/* -Une fonction est un morceau de code écrit dans des accolades et qui porte un nom.
-On appelle la fonction au besoin pour exécuter le code qui s'y trouve. 
-Les fonctions sont d'abord déclarées, puis appelés pour les exécuter. */
// Exemple :
function separation (){ // déclaration d'une fonction sans paramètres (les parenthèses restent vides.)
    echo'<hr>'; // cette fonction affiche un trait horizontal dans le navigateur.
}

separation(); // on exécute une fonctio nen l'appelant par son nom suivi d'une paire de ().

//-------
// Fonction avec paramètres et return :
function bonjour($prenom, $nom){ // $prenom et $nom sont les paramètres de la fonction.Ils permettent de recevoir une valeur car ce sont des variables de réception.
    return 'bonjour ' . $prenom . ' ' . $nom . ' ! <br>' ; // return renvoie la phrase(bonjour etc...)à l'endroit où la fonction est appelée.
    echo 'cette ligne ne sera pas exécutée...'; // après un return on quitte la fonction.Les lignes de code qui suivent ne sont donc pas exécutées.
}

// Exécution :
echo bonjour('John', 'Doe'); /* si la fonction attend des valeurs, appelées "arguments", il faut lui envoyer dans le même ordre que les paramètres.
On reçoit la phrase "Bonjour John Doe ! <br>" à cet endroit grâce au return de la fonction. */

// On peut mettres des variables dans l'appel de la fonction.
$formulaire_prenom = 'Pierre';
$formulaire_nom = 'Dupont';
echo bonjour($formulaire_prenom, $formulaire_nom);

// Exercice : vous déclarez une fonction exoMeteo qui affiche l'article correct "au" ou "en" selon la saison reçue.Pour cela vous partez de la fonction çi-dessous que vous adaptez.
function meteo($saison){
    echo "Nous sommes en $saison <br>";
}
meteo('été');
meteo('printemps');

// ma version
// $saison = 'printemps';
// function exoMeteo($saison){
//     if ($saison == 'printemps'){
//     echo'nous sommes au' $saison ;
//     } else {
//     echo 'nous sommes en';
//     }
// }
// exometeo('été');
// exometeo('printemps');

// Correction
function exoMeteo ($saison){

    if($saison == 'printemps'){
        $article = 'au';    
    }else {
        $article = 'en';
    }
    echo "Nous Sommes $article $saison <br>";
}

exoMeteo('été');
exoMeteo('printemps');

echo '<br>';
/*Exercice :
-Déclarez la fonction factureEssence() qui calcule le coût total de votre facture en fonction du nombre de libres que vous indiquez en appelant la fonction.Cette fonction retourne la phrase "Votre facture est de... euros pour .... litres d'essence."Le prix du litre est de 1.30€.
Vous affichez le résultat pour 40 litres.

-Vous déclarez un autre fonction prixAuLitre()qui retourne la valeur 1.30.Vous devez utiliser cette fonction dans le calcul de factureEssence.
*/
function prixAuLitre(){
    return 1.30;
} 

function factureEssence(int $litre){
    $prix =1.30;
    $total = $prix * $litre;
    return "votre facture est de .$total euros pour $litre litres d'essence.";
}
echo factureEssence(10);



//------
// PHP7 - On peut préciser le type des valeurs entrantes dans une fonction.
function identite(string $nom, int $age){ // $nom attend une valeur de type string, et $age de type integer.On peut mettre les types array, bool, float, int, string.
    return $nom . ' a ' . $age . ' ans <br>';
}

echo identite('Asterix', 60); // Les types des arguments sont respectés , il n'y a pas d'erreur.

/* echo identite('Astérix', 'soixante ans');  "fatal error" car on passe un string à la place d'un integer pour l'âge.Nous mettons donc cette ligne en commentaire pour éviter l'erreur. */

// -------
// PHP7 - On peut aussi préciser le type de la valeur de retour qui sort de la fonction.
function estAdulte(int $âge) : bool {
    if($age >= 18){
        return true; // Il est adulte.
    } else {
        return false; // Il n'est pas adulte.
    }
}

var_dump(estAdulte(10)); // Va renvoyer le type et la valeur => "bool(false)"

// -------------------------------
echo '<h2> Variable locale et variable globale.</h2>';
// -------------------------------
/* On va de l'espace local à l'espace global : */
function jourSemaine(){
    $jour = 'mercredi' ; //variable locale
    return $jour; // on sort la valeur de la variable $jour de la fonction.
}

// echo $jour ; => cette variable ne fonctionne pas car cette dernière n'est connu que dans la fonction.
echo jourSemaine() . '<br>'; // On récupère la valeur retournée par le return de la fonction jourSemaine puis on l'affiche.

//------
// On va de l'espace global vers l'espace local:
$pays = 'France'; // variable globale.
function affichePays(){
    global $pays; // Le mot clé "global" permet de récupérer la valeur d'une variable globale à l'intérieur d'une fonction.
    echo $pays;
}
affichePays();

// -------------------------------
echo '<h2> Structures itératives : Les boucles.</h2>';
// -------------------------------
//Les boucles sont destinées à répéter des lignes de code de façon automatique.

// Boucle while :
    $i =0; // variable pour compter le nombre de tours effectués.
while ($i <3){ // tant que $i est inférieur à 3, on entre dans la boucle.
    echo $i . '<br>'; // affiche 0 puis 1 puis 2 
    $i++; // on oublie pas d'incrémenter $ià chaque tour de boucle pour ne pas avoir une boucle infinie.
}

    // EXERCICE : à l'aide d'une boucle while, vous affichez les annéesde 1920 à 2020 dans un menu déroulant.
    // Syntaxe HTML d'un menu déroulant :
echo '<select>';
    echo '<option>1920</option>';
    echo '<option>....</option>';
    echo '<option>2020</option>';
echo '</select>';

echo '<select>';
$year =1920;
while ($year <=2020){
    echo $year . '<br>';
    $year++;
    echo '<option>'. $year .'</option>';
}
echo '</select><br>' ;

//----------
// Boucle de do while :
// La boucle do while a la particularité de s'exécuter au moins une fois , puis tant que la condition de fin est vraie.

$j =1; // Point de départ

do {
    echo 'Je fais 1 tour de boucle <br>';
    $j++;
}while($j >10); // Cette condition renvoie false immédiatement et pourtant, la boucle a bien tournée une fois.C'est le "do" qui exécute le premier tour.Attention à bien mettre le ; après le while.

echo '<br>';

//-------
// La boucle for :
// la boucle for est une autre syntaxe de la boucle while.
for ($i = 0; $i < 3; $i++){// On trouve dans les () de la for : la valeur de départ; la condition d'entrée dans la boucle ; la variation de $i(incrémentation ou décrémentation ou autre chose....).
    echo $i . '<br>';
}

echo '<br>'; 

// Exercice : Afficher les mois de 1 à 12 dans un menu déroulant.
echo '<select>';
for($month = 1;$month < 13;$month++){
    echo "<option>$month</option>"; 
}
echo '</select><br>';

// -----------
// Boucle foreach :


// -------------------------------
echo '<h2> Exercices de mélange PHP, HTML et CSS</h2>';
// -------------------------------

// Exercice : faites une boucle for qui affiche 0 à 9 sur la même ligne dans une table HTML.Vous ajoutez des bordures en CSS dans la balise <style> du début de cette page.

/* Voici la strucure de base çi-dessous:
echo '<table>'; 
    echo '<tr>';
        echo'<td>1</td>';
        echo'<td>2</td>';
        echo'<td>3</td>';
        echo'<td>4</td>';
        echo'<td>5</td>';
        echo'<td>6</td>';
        echo'<td>7</td>';
        echo'<td>8</td>';
        echo'<td>9</td>';
    echo '</tr>';
echo '</table><br>'; 
*/

// Correction 
echo "<table><tr>";
for($i = 0; $i <= 9; $i++)
{
    echo "<td>  $i  </td>";
}
echo "</tr></table>";

echo '<br>';

// Exercice : Faites une boucle qui affiche 0 à 9 sur la même ligne répétée sur 10 lignes, dans une table HTML.

// echo '<table>';
// for($line = 0; $line < 10; $line++) 
// {
//     echo '<tr>';
//     for($case = 0; $case < 10; $case++) 
//     {
//         echo '<td>' . (10 * $line + $case) . '</td>'; 
//     }
//     echo '</tr>';
// } 
// echo '</table>';

// corrections
echo '<table>';
        
    for ($j = 0; $j <= 9; $j++) {
        echo '<tr>'; // pour faire 1 ligne
            for ($i = 0; $i <= 9; $i++) {
                echo '<td>' . $i . '</td>';
            }  
        echo '</tr>';
    }

echo '</table>';

// -------------------------------
echo '<h2> Tableau de données (array)S</h2>';
// -------------------------------
// Un tableau ou array en anglais est déclaré comme une variabl amélioré dans laquelle on stocke une multitudes de valeurs.Ces valeurs peuvent être de n'importe quelle type et possède un indice par défaut dont la numérotation commence à 0.

// Déclarer un tableau (méthode1) :
$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges'); // On crée un tableau avec le mot clé array.

// echo $liste; => il y aura une erreur de type "notice".L'interpréteur de PHP ne peut pas afficher directement un array.

echo '<pre>';
print_r($liste); // Affiche le contenu du tableau $liste.
echo '</pre>'; // la balise <pre> sert à formater l'affichage en colonne.

echo '<pre>';
var_dump($liste); // Affiche le contenu du tableau $liste avec en plus les types des éléments.
echo '</pre>';

// On crée votre fonction personnelle pour faire notre affichage
function debug($variable){ // cette fonction a pour but d'afficher une balise <pre> et un print_r() à l'intérieur.$variable accueillera l'élément dont on veut afficher le contenu.
   echo '<pre>';
   print_r($variable);
   echo '</pre>';
}
debug($liste);

// Autre façon de déclarer un tableau (méthode 2):
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];
//        0           1            2         3
debug($tab);

//---------
// Afficher "Italie"
echo $tab[1] .  '<br>'; // Pour afficher "Italie" on passe par son indice 1 que l'on écrit dans des [].

// Ajouter un élément à la fin d'un tableau :
$tab[] = 'Suisse'; // les [] vides permettent d'ajouter une valeur à la fin du tableau.

debug($tab);

// -------
// Tableau associatif :
// Dans un tableau assosciatif, nous pouvons choisir le nom des indices.
$couleur = array(
    'j' => 'jaune', // à gauche de la => nous avons l'indice, et à droite nous avons la valeur.
    'b' => 'bleu',
    'v' => 'vert',
);

// Pour accéder à un élément du tableau associatif :
echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>';
echo "La seconde couleur de notre tableau est le $couleur[b] <br>"; // Attention, ici le tableau est écrit dans des guillemets : il perd donc les quotes autour de son indice.

//-------
// Compter le nombre d'éléments d'un tableau :
echo 'Taille du tableau : ' . count($couleur) . '<br>'; // Count est une fonction prédéfinie qui compte le nombre d'éléments du tableau $couleur.
echo 'Taille du tableau : ' . sizeof($couleur) . '<br>'; // sizeof fait exactement la même chose.

// -------------------------------
echo '<h2> Boucle foreach </h2>';
// -------------------------------
// foreach est un moyen simple de parcourir un tableau de façon automatique.Cette boucle fonctionne uniquement sur les tableaux et les objets et retourne une erreur si vous tentez de parcourir une variable d'un autre type ou non initialisée.

debug($tab); // Pour voir le contenu du tableau.

foreach($tab as $pays){ // Quand il y a qu'une variable après le mot clé as,celle ci parcours la colonne des valeurs du tableau.Ici on parcours $tab et on prends chaque valeur (pays) à chaque tout de boucle dans la varible $pays.
    echo $pays . '<br>'; // Affiche successivement toutes les valeurs (les pays) du tableau $tab.
}

foreach ($tab as $indice => $pays){ // Quand il y a 2 variables après le mot clé as, celle de gauche parcours la colonne des indices tandis que celle de droite parcours la colonne des valeurs.
    echo $indice. 'correspond à ' . $pays . '<br>' ;
}

//--------
//Excercice : déclarez un tableau associatif avec les indices prenom,nom,email,téléphone et mettez y des valeurs pour un seul contact.Puis avec une boucle foreach,vous affichez les valeurs dans des <p> sauf le prenom qui doit être afficher dans un <h3>.

/* ma version (marche correctement)
$table = array(
    'prenom' => 'John', 
    'nom' => 'Doe',
    'email' => 'jdoe@gmail.com',
    'telephone' => '0612345678',
);

foreach ($table as $data => $value ){
    if($data == 'prenom'){
        echo '<h3>Bonjour' . $table['prenom'] . '</h3>';
    }else {
        echo '<p>' . $value .'</p>' ;
    }
}
*/

$contact = array(
    'prenom' => 'John',
    'nom' => 'Doe',
    'email' => 'jdoe@gmail.com',
    'telephone' => '0612345678'
);
debug($contact);

foreach($contact as $indice => $valeur){
    if($indice == 'prenom'){
        echo '<h3>Hello ' . $valeur . '</h3>';
    }else {
        echo '<p>' . $valeur . '</p>';
    }
}

// -------------------------------
echo '<h2> Tableau multidimensionnel </h2>';
// -------------------------------
/*  On parle de tableau multidimmensionnel quand un tableau est contenu dans un autre tableau.
Chaque Tableau représente une dimension.
*/

// Déclaration d'un tableau à plusieurs dimensions :
$tab_multi = array(
    array(
        'prenom' => 'Julien',
        'nom' => 'Dupont',
        'telephone' => '0612345678'
        ),
    array(
        'prenom' => 'Nicolas',
        'nom' => 'Duran',
        'telephone' => '0698465432'
        ),
    array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac',
        ),
);

debug ($tab_multi); // debug comme toujours pour vérifier.

// On veut afficher "Julien" :
echo $tab_multi[0]['prenom'] . '<br>'; // pour afficher "Julien", nous entrons d'abord dans l'indice [0] de $tab_multi, pour ensuite aller à l'indice ['prenom']. Notez que les [] sont successifs.

echo '<hr>';

// Parcourir le tableau multidimensionnel avec une boucle for
// On peut utiliser une for car les indices sont numériques. 
for ($i = 0; $i < count($tab_multi); $i++){ // tant que $i est inférieur aux éléments de $tab_multi(3 içi), on entre dans la boucle.
    echo $tab_multi[$i]['prenom'] . '<br>'; //$i varie successivement de 0, à 1 puis à 2.On affiche donc chaque prénom à chaque tour de boucle.
}

// Exercice : Afficher les trois prénoms de $tab_multi dans un foreach

foreach($tab_multi as $indice => $valeur){ // debug($valeur); // on voit que $valeur est lui même un tableau qui comporte l'indice ['prenom']
    /* echo $valeur['prenom'] . '<br>' ; // On écrit donc $valeur['prenom'] pour accéder aux  valeurs "Julien", "Nicolas" et "Pierre".*/

    // ou autre réponse :
    echo $tab_multi[$indice]['prenom'] . '<br>' ; // $indice prend successivement 0 puis 1 puis 2.
}

// Exercice : vous déclarez un tableau simple appelé tailels avec les valeurs S, M, L et XL.Puis vous affichez les tailles dans un menu déroulant avec une boucle foreach.

$tailles =array('S', 'M','L','XL'
);
echo '<select>';
foreach($tailles as $taille ){
 echo '<option>'. $valeur .'</option>';
}
echo '</select><br>' ;

// ------------------------------
echo '<h2> Inclusion de fichiers </h2>';
// ------------------------------

echo 'Première inclusion : ';
include 'exemple.inc.php'; // Le fichier dont le chemin est spécifié est inclus ici.Comme si nous avions copié son code à cet endroit.En cas d'erreur lors de l'inclusion, include génère une erreur de type "warning" et pouruis l'exécution du script.

echo '<br> Deuxième inclusion : ';
include_once 'exemple.inc.php'; // Le "once" vérifie si le fichier a déjà été inclus.Si c'est le cas il ne le réinclu pas, cela permet entre autres d'éviter les doublons.

echo '<br> Troisième inclusion : ';
require 'exemple.inc.php'; // Le fichier est obligatoire pour le fonctionnement du site.En cas d'erreur lors de l'inclusion, require génère une erreur fatale et arrête l'exécution du script.

echo '<br> Quatrième inclusion : ';
require_once 'exemple.inc.php'; // le "once" vérifie si le fichier a déjà été inclus.Si c'est le cas il ne le réd-inclut pas.

// ----------------------------------------
echo '<h2> Introductions aux objets </h2>';
// ----------------------------------------

// Un objet (object en anglais) est un autre type de données.Il représente un objet réel(Par exemple une voiture, une table, un un membre, panier etc...) auquel on peut associer des variables, appelées propriétés.

// Pour créer des objets, il nous faut un "plan de construction" : c'est le rôle de la classe.

// Pour l'exemple, nous déclarons une classe pour fabriquer des membles :
class Meuble{ // Les classes s'écrivent avec une majuscule.
    public $marque = 'ikea'; // $marque est une propriété. "public" p^récise qu'elle sera accessible partout, y compris en dehors de la classe.

    public function prix(){ // prix () est une méthode 
        return '150 €';
    }
}

// Syntaxe objet en PHP :
$etagere = new Meuble(); // "new" est un mot clé permettant d'instancier la classe et d'en faire un objet.$etagere est donc de type objet.

debug($etagere); // $etagere est bien un objet.

echo 'La marque de notre étagère est : ' . $etagere->marque . '<br>'; // Pour accéder à la propriété d'un objet on écrit après une flèche ainsi représenté : "->".

echo 'Le prix de notre étagère est de :' . $etagere->prix() . '<br>'; // Pour accéder à la méthode d'un objet, on écrit celle-ci après la flèche "->" suivie d'une paire de ().

// ---------------FIN--------------//
