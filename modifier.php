<?php
include_once "Monde.class.php";
include_once "Pays.class.php";
$erreurs = array();
// Traitement du formulaire
if (isset($_POST['modifier'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:details.php?id=$id");
		exit;
	}
	$pays = Pays::recuperer($_POST);
	$erreurs = Pays::valider($pays);
	if (count($erreurs) === 0) {
		Pays::traitementModifier($pays);
	}
} else {
	$id = Pays::prendreId();
	$pays = Pays::find($id);
}

// Composition de l'affichage
$affichage = '';
$affichage .= Pays::html_modifier($pays, $erreurs);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="monde.css" />
	<title>Modifier &mdash; <?php echo $pays['nom2'] ?></title>
</head>

<body>
	<div id="interface">
		<?php include "header.inc.php"; ?>
		<?php include "footer.inc.php"; ?>
		<nav class="principal">
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
				<li><a href="ajouter.php">Ajouter un pays</a></li>
				<li class="courant"><span>Modifier</span></li>
				<li><a href="supprimer.php?id=<?php echo $id; ?>">Supprimer</a></li>
			</ul>
		</nav>
		<div class="contenu">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>
