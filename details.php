<?php
include_once "Monde.class.php";
include_once "Pays.class.php";
$id = Pays::prendreId();
$pays = Pays::find($id);
$affichage = Pays::html_details($pays);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="monde.css" />
	<title><?php echo $pays['nom2'] ?></title>
</head>

<body>
	<div id="interface">
		<?php include "header.inc.php"; ?>
		<?php include "footer.inc.php"; ?>
		<nav class="principal">
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<?php if ($id === "alea") { ?>
				<li class="courant"><a href="details.php?id=alea">Un pays aléatoire</a></li>
				<?php } else { ?>
				<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
				<?php } ?>
				<li><a href="ajouter.php">Ajouter un pays</a></li>
				<li><a href="modifier.php?id=<?php echo $id; ?>">Modifier</a></li>
				<li><a href="supprimer.php?id=<?php echo $id; ?>">Supprimer</a></li>
			</ul>
		</nav>
		<div class="contenu">
			<?php echo $affichage; ?>
		</div>
	</div>
</body>

</html>
