<?php
include_once "Monde.class.php";
$erreurs = array();
$messageErreurs = "";
// Traitement du formulaire
if (isset($_POST['supprimer'])) {
	$id = $_POST['id'];
	if (isset($_POST['annuler'])) {
		header("location:details.php?id=$id");
		exit;
	}
	// Récupération des données
	$id = $_POST['id'];

	// Sauvegarde des données
	$db = Monde::connect();

	// Composition du SQL
	$WHERE = "WHERE id=:id";
	$SQL = "DELETE FROM pays $WHERE LIMIT 1";
	$stmt = $db->prepare($SQL);
	$stmt->bindParam(":id", $id);

	// Exécution de la requête
	try {
		$stmt->execute();
	} catch (PDOException $e) {
		throw new Exception($e->getMessage());
	}
	header("location:index.php");
	exit;
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
$affichage .= '<h2>Supprimer un pays</h2>';
$affichage .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/' . strtolower($id) . '.svg" alt="Drapeau"/>';
$affichage .= '<form action="" method="post">';
$affichage .= '<table class="details">';
$affichage .= '<tbody>';
$affichage .= '<tr><th>ISO</th><td>' . $id . '</td></tr>';
$affichage .= '<tr><th>Nom</th><td>' . $nom . '</td></tr>';
$affichage .= '<tr><th>Autre nom</th><td>' . $nom2 . '</td></tr>';
$affichage .= '</tbody>';
$affichage .= '</table>';
$affichage .= '<div>';
$affichage .= '<input type="hidden" name="id" value="' . $id . '" />';
$affichage .= '<input type="hidden" name="supprimer" />';
$affichage .= '<input type="submit" value="Supprimer" />';
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
					<li><a href="modifier.php?id=<?php echo $id; ?>">Modifier</a></li>
					<li><span>Supprimer</span></li>
				</ul>
			</nav>
			<div class="contenu">
				<?php echo $affichage; ?>
			</div>
			<footer>&copy;</footer>
		</div>
	</body>
</html>
