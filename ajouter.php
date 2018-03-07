<?php
include_once "Monde.class.php";
$erreurs = array();
$messageErreurs = "";
// Traitement du formulaire
if (isset($_POST['ajouter'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:index.php");
		exit;
	}

	Pays::traitementAjouter(0);
} else {
	$id = '';
	$nom = '';
	$nom2 = '';
	$continent = '';
	$capitale = '';
	$population = '';
	$nomHabitants = '';
	$superficie = '';
	$densite = '';
	$popUrbaine = '';
	$frontieres = '';
	$cotes = '';
	$eauxTerritoriales = '';
	$heure = '';
	$moisFroids = '';
	$moisFroidsTemp = '';
	$moisChauds = '';
	$moisChaudsTemp = '';
}

// Composition de l'affichage
$affichage = '';
$affichage .= $messageErreurs;
$affichage .= '<h2>Ajouter un pays</h2>';
$affichage .= '<form action="" method="post">';
$affichage .= '<table class="details">';
$affichage .= '<tbody>';
$affichage .= '<tr>';
$affichage .= '<th><label for="id">ISO</th>';
$affichage .= '<td><input type="text" name="id" id="id" value="' . $id . '" />'.  affichageErreur('id', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="nom">Nom</th>';
$affichage .= '<td><input type="text" name="nom" id="nom" value="' . $nom . '" />'.  affichageErreur('nom', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="nom2">Autre nom</th>';
$affichage .= '<td><input type="text" name="nom2" id="nom2" value="' . $nom2 . '" />'.  affichageErreur('nom2', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="continent">Continent</th>';
$affichage .= '<td><input type="text" name="continent" id="continent" value="' . $continent . '" />'.  affichageErreur('continent', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="capitale">Capitale</th>';
$affichage .= '<td><input type="text" name="capitale" id="capitale" value="' . $capitale . '" />'.  affichageErreur('capitale', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="population">Population</th>';
$affichage .= '<td><input type="text" name="population" id="population" value="' . $population . '" />&nbsp;habitants'.  affichageErreur('population', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="nomHabitants">Gentilé</th>';
$affichage .= '<td><input type="text" name="nomHabitants" id="nomHabitants" value="' . $nomHabitants . '" />'.  affichageErreur('nomHabitants', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="superficie">Superficie</th>';
$affichage .= '<td><input type="text" name="superficie" id="superficie" value="' . $superficie . '" />&nbsp;km'.  affichageErreur('superficie', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="densite">Densité</th>';
$affichage .= '<td><input type="text" name="densite" id="densite" value="' . $densite . '" />&nbsp;habitants par km&sup2;'.  affichageErreur('densite', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="popUrbaine">Population urbaine</th>';
$affichage .= '<td><input type="text" name="popUrbaine" id="popUrbaine" value="' . $popUrbaine . '" />&nbsp;%'.  affichageErreur('popUrbaine', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="frontieres">Frontières</th>';
$affichage .= '<td><input type="text" name="frontieres" id="frontieres" value="' . $frontieres . '" />&nbsp;km&sup2;'.  affichageErreur('frontieres', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="cotes">Côtes</th>';
$affichage .= '<td><input type="text" name="cotes" id="cotes" value="' . $cotes . '" />&nbsp;km'.  affichageErreur('moisChauds', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="eauxTerritoriales">Eaux territoriales</th>';
$affichage .= '<td><input type="text" name="eauxTerritoriales" id="eauxTerritoriales" value="' . $eauxTerritoriales . '" />&nbsp;km&sup2;'.  affichageErreur('eauxTerritoriales', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="heure">Heure</th>';
$affichage .= '<td><input type="text" name="heure" id="heure" value="' . $heure . '" />'.  affichageErreur('heure', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="moisFroids">Mois froids</th>';
$affichage .= '<td><input type="text" name="moisFroids" id="moisFroids" size="5" value="' . $moisFroids . '" /> mois <input type="text" name="moisFroidsTemp" id="moisFroidsTemp" size="5" value="' . $moisFroidsTemp . '" />&deg;'.  affichageErreur('moisFroidsTemp', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '<tr>';
$affichage .= '<th><label for="moisChauds">Mois chauds</th>';
$affichage .= '<td><input type="text" name="moisChauds" id="moisChauds" size="5" value="' . $moisChauds . '" /> mois <input type="text" name="moisChaudsTemp" id="moisChaudsTemp" size="5" value="' . $moisChaudsTemp . '" />&deg;'.  affichageErreur('moisChauds', $erreurs).'</td>';
$affichage .= '</tr>';
$affichage .= '</tbody>';
$affichage .= '</table>';
$affichage .= '<div>';
$affichage .= '<input type="hidden" name="ajouter" />';
$affichage .= '<input type="submit" />';
$affichage .= '<input type="submit" name="annuler" value="Annuler" />';
$affichage .= '</div>';
$affichage .= '</form>';
function affichageErreur($nom, $erreurs) {
	if (!isset($erreurs[$nom])) return '';
	$resultat = '';
	$resultat .= '<span class="erreur">* '.$erreurs[$nom].'</span>';
	return $resultat;
}
?>
<html>
	<head>
		<title>Affichage des pays</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="reset.css" />
		<link rel="stylesheet" type="text/css" href="monde.css" />
	</head>

	<body>
		<div id="interface">
			<header><h1>Mes pays</h1></header>
			<nav class="principal">
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
					<li><a href="ajouter.php">Ajouter un pays</a></li>
					<li><span>Modifier</span></li>
					<li><a href="supprimer.php?id=<?php echo $id; ?>">Supprimer</a></li>
				</ul>
			</nav>
			<div class="contenu"><?php echo $affichage; ?></div>
			<footer>&copy;</footer>
		</div>
	</body>
</html>
