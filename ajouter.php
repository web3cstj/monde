<?php
include_once "Monde.class.php";
include_once "Pays.class.php";
$erreurs = [];
$messageErreurs = "";
// Traitement du formulaire
if (isset($_POST['ajouter'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:index.php");
		exit;
	}
	$pays = Pays::recuperer($_POST);
	$erreurs = Pays::valider($pays);
	if (count($erreurs) === 0) {
		Pays::traitementAjouter($pays);
	}
} else {
	$pays['id'] = '';
	$pays['nom'] = '';
	$pays['nom2'] = '';
	$pays['continent'] = '';
	$pays['capitale'] = '';
	$pays['population'] = '';
	$pays['nomHabitants'] = '';
	$pays['superficie'] = '';
	$pays['densite'] = '';
	$pays['popUrbaine'] = '';
	$pays['frontieres'] = '';
	$pays['cotes'] = '';
	$pays['eauxTerritoriales'] = '';
	$pays['heure'] = '';
	$pays['moisFroids'] = '';
	$pays['moisFroidsTemp'] = '';
	$pays['moisChauds'] = '';
	$pays['moisChaudsTemp'] = '';
}

// Composition de l'affichage
$affichage = '';
$affichage .= Pays::html_ajouter($pays, $erreurs);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="monde.css" />
	<title>Ajouter un pays</title>
</head>

<body>
	<div id="interface">
		<?php include "header.inc.php"; ?>
		<?php include "footer.inc.php"; ?>
		<nav class="principal">
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
				<li class="courant"><a href="ajouter.php">Ajouter un pays</a></li>
			</ul>
		</nav>
		<div class="contenu">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>
