<?php
include_once "Monde.class.php";
include_once "Pays.class.php";
// Traitement du formulaire
if (isset($_POST['supprimer'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:details.php?id=$id");
		exit;
	}
	$pays = $_POST;
	Pays::traitementSupprimer($pays);
} else {
	$id = Pays::prendreId();
	$pays = Pays::find($id);
}

$affichage = Pays::html_supprimer($pays);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="monde.css" />
	<title>Supprimer &mdash; <?php echo $pays['nom2'] ?></title>
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
				<li><a href="modifier.php?id=<?php echo $id; ?>">Modifier</a></li>
				<li class="courant"><span>Supprimer</span></li>
			</ul>
		</nav>
		<div class="contenu">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>
