<?php
include_once "Monde.class.php";
$erreurs = array();
$messageErreurs = "";
// Traitement du formulaire
if (isset($_POST['modifier'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:details.php?id=$id");
		exit;
	}
	// Récupération des données
	$id = trim($_POST['id']);
	$nom = trim($_POST['nom']);
	$nom2 = trim($_POST['nom2']);
	$continent = trim($_POST['continent']);
	$capitale = trim($_POST['capitale']);
	$population = trim($_POST['population']);
	$nomHabitants = trim($_POST['nomHabitants']);
	$superficie = trim($_POST['superficie']);
	$densite = trim($_POST['densite']);
	$popUrbaine = trim($_POST['popUrbaine']);
	$frontieres = trim($_POST['frontieres']);
	$cotes = trim($_POST['cotes']);
	$eauxTerritoriales = trim($_POST['eauxTerritoriales']);
	$heure = trim($_POST['heure']);
	$moisFroids = trim($_POST['moisFroids']);
	$moisFroidsTemp = trim($_POST['moisFroidsTemp']);
	$moisChauds = trim($_POST['moisChauds']);
	$moisChaudsTemp = trim($_POST['moisChaudsTemp']);

	// Validation
	if ($nom == '')
		$erreurs['nom'] = "Vous devez fournir un nom.";
	if ($nom2 == '')
		$erreurs['nom2'] = "Vous devez fournir un autre nom.";
	if ($continent == '')
		$erreurs['continent'] = "Vous devez fournir un continent.";
	if ($capitale == '')
		$erreurs['capitale'] = "Vous devez fournir une capitale.";
	if ($population == '')
		$erreurs['population'] = "Vous devez fournir la population.";
	if ($nomHabitants == '')
		$erreurs['nomHabitants'] = "Vous devez fournir le gentilé.";
	if ($superficie == '')
		$erreurs['superficie'] = "Vous devez fournir la superficie.";
	if ($densite == '')
		$erreurs['densite'] = "Vous devez fournir la densite.";
	if ($popUrbaine == '')
		$erreurs['popUrbaine'] = "Vous devez fournir le pourcentage de population urbaine.";
	//TODO Compléter pour frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp

	// Traitement des données
	// ... Ici, on ne fait rien pour l'instant

	// Sauvegarde des données
	if (count($erreurs) > 0) {
		$messageErreurs = '<div class="erreur">Il y a une erreur dans le formulaire</div>';
	} else {
		$db = Monde::connect();

		// Composition du SQL
		$SET = "SET nom=:nom, nom2=:nom2, continent=:continent, capitale=:capitale, population=:population, nomHabitants=:nomHabitants, superficie=:superficie, densite=:densite, popUrbaine=:popUrbaine, frontieres=:frontieres, cotes=:cotes, eauxTerritoriales=:eauxTerritoriales, heure=:heure, moisFroids=:moisFroids, moisFroidsTemp=:moisFroidsTemp, moisChauds=:moisChauds, moisChaudsTemp=:moisChaudsTemp";
		$WHERE = "WHERE id=:id";
		$SQL = "UPDATE pays $SET $WHERE";
		$stmt = $db->prepare($SQL);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":nom", $nom);
		$stmt->bindParam(":nom2", $nom2);
		$stmt->bindParam(":continent", $continent);
		$stmt->bindParam(":capitale", $capitale);
		$stmt->bindParam(":population", $population);
		$stmt->bindParam(":nomHabitants", $nomHabitants);
		$stmt->bindParam(":superficie", $superficie);
		$stmt->bindParam(":densite", $densite);
		$stmt->bindParam(":popUrbaine", $popUrbaine);
		$stmt->bindParam(":frontieres", $frontieres);
		$stmt->bindParam(":cotes", $cotes);
		$stmt->bindParam(":eauxTerritoriales", $eauxTerritoriales);
		$stmt->bindParam(":heure", $heure);
		$stmt->bindParam(":moisFroids", $moisFroids);
		$stmt->bindParam(":moisFroidsTemp", $moisFroidsTemp);
		$stmt->bindParam(":moisChauds", $moisChauds);
		$stmt->bindParam(":moisChaudsTemp", $moisChaudsTemp);

		// Exécution de la requête
		try {
			$stmt->execute();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
		if ($stmt->rowCount() == 0) {
			header("location:index.php");
			exit;
		} else {
			header("location:details.php?id=$id");
			exit;
		}
	}
} else {

	// Récupération de la clé primaire
	if (!isset($_GET['id'])) {
		header("location:index.php");
		exit;
	}
	$id = $_GET['id'];
	// Connexion
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'monde';
	$charset = 'utf8';
	$dsn = "mysql:host=$host;charset=$charset;dbname=$dbname;";
	try {
		$db = new PDO($dsn, $username, $password);
	} catch (PDOException $exc) {
		$db = new PDO("mysql:host=$host;charset=$charset;", $username, $password);
		$db->exec(file_get_contents("monde.sql"));
		exit("Base de données installée. Rafraîchir la page.");
	}
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Composition du SQL
	$champs = "id, nom, nom2, continent, capitale, population, nomHabitants, superficie, densite, popUrbaine, frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp";
	if ($id == "alea") {
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
		$stmt->fetch();
	} catch (PDOException $e) {
		throw new Exception($e->getMessage());
	}
	if ($stmt->rowCount() == 0) {
		header("location:index.php");
		exit;
	}
}

// Composition de l'affichage
$affichage = '';
$affichage .= $messageErreurs;
$affichage .= '<h2>' . $nom2 . '</h2>';
$affichage .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/' . strtolower($id) . '.svg" alt="Drapeau"/>';
$affichage .= '<form action="" method="post">';
$affichage .= '<table class="details">';
$affichage .= '<tbody>';
$affichage .= '<tr>';
$affichage .= '<th><label for="id">ISO</th>';
$affichage .= '<td>' . $id . '</td>';
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
$affichage .= '<input type="hidden" name="id" value="' . $id . '" />';
$affichage .= '<input type="hidden" name="modifier" />';
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
