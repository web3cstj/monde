<?php
include_once "Monde.class.php";
include_once "Pays.class.php";
$stmt = Pays::all();
$affichage = Pays::html_index($stmt);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="monde.css" />
	<title>Affichage des pays</title>
</head>

<body>
	<div id="interface">
		<?php include "header.inc.php"; ?>
		<?php include "footer.inc.php"; ?>
		<nav class="principal">
			<ul>
				<li class="courant"><a href="index.php">Accueil</a></li>
				<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
				<li><a href="ajouter.php">Ajouter un pays</a></li>
			</ul>
		</nav>
		<div class="contenu">
			<h2>Liste des pays</h2>
			<?php echo $affichage; ?>
		</div>
	</div>
</body>
</html>
