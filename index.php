<?php
// Connexion
include_once "Monde.class.php";
$db = Monde::connect();

// Composition du SQL
$SQL = "SELECT id, nom2 FROM pays ORDER BY nom2;";
$stmt = $db->prepare($SQL);
$stmt->bindColumn("id", $id);
$stmt->bindColumn("nom2", $nom2);

// Exécution de la requête
try {
	$stmt->execute();
} catch (PDOException $e) {
	throw new Exception($e->getMessage());
}

// Composition de l'affichage
$tblPays = '';
$tblPays .= '<table class="liste">';
$tblPays .= '<col class="drapeau" />';
$tblPays .= '<col class="nom" />';
$tblPays .= '<col class="options" />';
$tblPays .= '<thead>';
$tblPays .= '<tr>';
$tblPays .= '<th>&nbsp;</th>';
$tblPays .= '<th>Nom</th>';
$tblPays .= '<th>Options</th>';
$tblPays .= '</thead>';
$tblPays .= '<tbody>';
if ($stmt->rowCount() == 0) {
	$tblPays .= '<tr>';
	$tblPays .= '<td colspan="3">Aucun pays trouvé</td>';
	$tblPays .= '</tr>';
} else {
	while ($stmt->fetch()) {
		$tblPays .= '<tr>';
		$tblPays .= '<td><a href="details.php?id=' . $id . '"><img class="drapeau" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($id).'.svg" alt="" height="16"/></a></td>';
		$tblPays .= '<td><a href="details.php?id=' . $id . '">' . $nom2 . '</a></td>';
		$tblPays .= '<td class="options">';
		$tblPays .= '<a href="details.php?id=' . $id . '">Détails</a>';
		$tblPays .= '<a href="modifier.php?id=' . $id . '">Modifier</a>';
		$tblPays .= '<a href="supprimer.php?id=' . $id . '">Supprimer</a>';
		$tblPays .= '</td>';
		$tblPays .= '</tr>';
	}
}
$tblPays .= '</tbody>';
$tblPays .= '</table>';
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
			<footer>&copy; Intégration Web III</footer>
			<nav class="principal">
				<ul>
					<li class="courant"><a href="index.php">Accueil</a></li>
					<li><a href="details.php?id=alea">Un pays aléatoire</a></li>
					<li><a href="ajouter.php">Ajouter un pays</a></li>
				</ul>
			</nav>
			<div class="contenu">
				<h2>Liste des pays</h2>
				<?php echo $tblPays; ?>
			</div>
		</div>
	</body>
</html>
