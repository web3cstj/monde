<?php
include_once "Monde.class.php";
// Récupération de la clé primaire
if (!isset($_GET['id'])) {
	header("location:index.php");
	exit;
}
$id = $_GET['id'];
// Connexion
$db = Monde::connect();

// Composition du SQL
$champs = "id, nom, nom2, continent, capitale, population, nomHabitants, superficie, densite, popUrbaine, frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp";
if ($id=="alea") {
	$SQL = "SELECT $champs FROM pays ORDER BY rand() LIMIT 1";
} else {
	$SQL = "SELECT $champs FROM pays WHERE id=:id";
}
$stmt = $db->prepare($SQL);
$stmt->bindParam(":id", $id);
$stmt->bindColumn("id", $id);
$stmt->bindColumn("nom", $nom);
$stmt->bindColumn("nom2", $nom2);
$stmt->bindColumn("continent", $continent);
$stmt->bindColumn("capitale", $capitale);
$stmt->bindColumn("population", $population);
$stmt->bindColumn("nomHabitants", $nomHabitants);
$stmt->bindColumn("superficie", $superficie);
$stmt->bindColumn("densite", $densite);
$stmt->bindColumn("popUrbaine", $popUrbaine);
$stmt->bindColumn("frontieres", $frontieres);
$stmt->bindColumn("cotes", $cotes);
$stmt->bindColumn("eauxTerritoriales", $eauxTerritoriales);
$stmt->bindColumn("heure", $heure);
$stmt->bindColumn("moisFroids", $moisFroids);
$stmt->bindColumn("moisFroidsTemp", $moisFroidsTemp);
$stmt->bindColumn("moisChauds", $moisChauds);
$stmt->bindColumn("moisChaudsTemp", $moisChaudsTemp);

// Exécution de la requête
try {
	$stmt->execute();
} catch (PDOException $e) {
	throw new Exception($e->getMessage());
}
if ($stmt->rowCount() == 0) {
	header("location:index.php");
	exit;
}

// Composition de l'affichage
$stmt->fetch();
$affichage = '';
$affichage .= '<h2>' . $nom2 . '</h2>';
$affichage .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($id).'.svg" alt="Drapeau"/>';
$affichage .= '<table class="details">';
$affichage .= '<tbody>';
$affichage .= '<tr><th>ISO</th><td>' . $id . '</td></tr>';
$affichage .= '<tr><th>Nom</th><td>' . $nom . '</td></tr>';
$affichage .= '<tr><th>Autre nom</th><td>' . $nom2 . '</td></tr>';
$affichage .= '<tr><th>Continent</th><td>' . $continent . '</td></tr>';
$affichage .= '<tr><th>Capitale</th><td>' . $capitale . '</td></tr>';
$affichage .= '<tr><th>Population</th><td>' . $population . '&nbsp;habitants</td></tr>';
$affichage .= '<tr><th>Gentilé</th><td>' . $nomHabitants . '</td></tr>';
$affichage .= '<tr><th>Superficie</th><td>' . $superficie . '&nbsp;km</td></tr>';
$affichage .= '<tr><th>Densité</th><td>' . $densite . '&nbsp;habitants par km&sup2;</td></tr>';
$affichage .= '<tr><th>Population urbaine</th><td>' . $popUrbaine . '&nbsp;%</td></tr>';
$affichage .= '<tr><th>Frontières</th><td>' . $frontieres . '&nbsp;km&sup2;</td></tr>';
$affichage .= '<tr><th>Côtes</th><td>' . $cotes . '&nbsp;km</td></tr>';
$affichage .= '<tr><th>Eaux territoriales</th><td>' . $eauxTerritoriales . '&nbsp;km&sup2;</td></tr>';
$affichage .= '<tr><th>Heure</th><td>' . $heure . '</td></tr>';
$affichage .= '<tr><th>Mois froids</th><td>' . $moisFroids . ' (' . $moisFroidsTemp . '°)</td></tr>';
$affichage .= '<tr><th>Mois chauds</th><td>' . $moisChauds . ' (' . $moisChaudsTemp . '°)</td></tr>';
$affichage .= '</tbody>';
$affichage .= '</table>';
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
			<li><a href="modifier.php?id=<?php echo $id; ?>">Modifier</a></li>
			<li><a href="supprimer.php?id=<?php echo $id; ?>">Supprimer</a></li>
		</ul>
		</nav>
		<div class="contenu"><?php echo $affichage; ?></div>
		<footer>&copy;</footer>
	</div>
	</body>
</html>
