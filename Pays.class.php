<?php
class Pays {
	static public function recuperer($source) {
		$resultat = [];
		// Récupération des données
		$resultat['id'] = trim($source['id']);
		$resultat['ISO'] = trim($source['ISO']);
		$resultat['nom'] = trim($source['nom']);
		$resultat['nom2'] = trim($source['nom2']);
		$resultat['continent'] = trim($source['continent']);
		$resultat['capitale'] = trim($source['capitale']);
		$resultat['population'] = trim($source['population']);
		$resultat['nomHabitants'] = trim($source['nomHabitants']);
		$resultat['superficie'] = trim($source['superficie']);
		$resultat['densite'] = trim($source['densite']);
		$resultat['popUrbaine'] = trim($source['popUrbaine']);
		$resultat['frontieres'] = trim($source['frontieres']);
		$resultat['cotes'] = trim($source['cotes']);
		$resultat['eauxTerritoriales'] = trim($source['eauxTerritoriales']);
		$resultat['heure'] = trim($source['heure']);
		$resultat['moisFroids'] = trim($source['moisFroids']);
		$resultat['moisFroidsTemp'] = trim($source['moisFroidsTemp']);
		$resultat['moisChauds'] = trim($source['moisChauds']);
		$resultat['moisChaudsTemp'] = trim($source['moisChaudsTemp']);
		return $resultat;
	}
	static public function valider($pays) {
		$erreurs = [];
		// Validation
		if ($pays['nom'] == '') {
			$erreurs['nom'] = "Vous devez fournir un nom.";
		}
		if ($pays['nom2'] == '') {
			$erreurs['nom2'] = "Vous devez fournir un autre nom.";
		}
		if ($pays['continent'] == '') {
			$erreurs['continent'] = "Vous devez fournir un continent.";
		}
		if ($pays['capitale'] == '') {
			$erreurs['capitale'] = "Vous devez fournir une capitale.";
		}
		if ($pays['population'] == '') {
			$erreurs['population'] = "Vous devez fournir la population.";
		}
		if ($pays['nomHabitants'] == '') {
			$erreurs['nomHabitants'] = "Vous devez fournir le gentilé.";
		}
		if ($pays['superficie'] == '') {
			$erreurs['superficie'] = "Vous devez fournir la superficie.";
		}
		if ($pays['densite'] == '') {
			$erreurs['densite'] = "Vous devez fournir la densite.";
		}
		if ($pays['popUrbaine'] == '') {
			$erreurs['popUrbaine'] = "Vous devez fournir le pourcentage de population urbaine.";
		}
		//TODO Compléter pour frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp

		// Sauvegarde des données
		if (count($erreurs) > 0) {
			$erreurs['_global_'] = '<div class="erreur">Il y a une erreur dans le formulaire</div>';
		}
		return $erreurs;
	}
	static public function prendreId() {
		// Récupération de la clé primaire
		if (!isset($_GET['id'])) {
			header("location:index.php");
			exit;
		}
		return $_GET['id'];
	}
	static public function traitementAjouter($pays) {
		extract($pays);
		$db = Monde::connect();

		// Composition du SQL
		$CHAMPS = "id, ISO, nom, nom2, continent, capitale, population, nomHabitants, superficie, densite, popUrbaine, frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp";
		$VALUES = ":id, :ISO, :nom, :nom2, :continent, :capitale, :population, :nomHabitants, :superficie, :densite, :popUrbaine, :frontieres, cotes=:cotes, :eauxTerritoriales, :heure, :moisFroids, :moisFroidsTemp, :moisChauds, moisChaudsTemp=:moisChaudsTemp";
		$SQL = "INSERT INTO pays ($CHAMPS) VALUES ($VALUES);";
		$stmt = $db->prepare($SQL);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":ISO", $ISO);
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
	static public function traitementModifier($pays) {
		extract($pays);
		$db = Monde::connect();

		// Composition du SQL
		$SET = "SET ISO=:ISO, nom=:nom, nom2=:nom2, continent=:continent, capitale=:capitale, population=:population, nomHabitants=:nomHabitants, superficie=:superficie, densite=:densite, popUrbaine=:popUrbaine, frontieres=:frontieres, cotes=:cotes, eauxTerritoriales=:eauxTerritoriales, heure=:heure, moisFroids=:moisFroids, moisFroidsTemp=:moisFroidsTemp, moisChauds=:moisChauds, moisChaudsTemp=:moisChaudsTemp";
		$WHERE = "WHERE id=:id";
		$SQL = "UPDATE pays $SET $WHERE";
		$stmt = $db->prepare($SQL);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":ISO", $ISO);
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
	static public function traitementSupprimer($pays) {
		// Récupération des données
		$id = $pays['id'];

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
	}
	static public function all() {
		//$lesPays = Monde::all();
		$db = Monde::connect();

		// Composition du SQL
		$SQL = "SELECT id, ISO, nom2 FROM pays ORDER BY nom2;";
		$resultat = $db->prepare($SQL);

		// Exécution de la requête
		try {
			$resultat->execute();
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
		return $resultat;
	}
	static public function find($id) {
		$db = Monde::connect();

		// Composition du SQL
		$champs = "id, ISO, nom, nom2, continent, capitale, population, nomHabitants, superficie, densite, popUrbaine, frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp";
		if ($id == "alea") {
			$SQL = "SELECT $champs FROM pays ORDER BY RANDOM() LIMIT 1";
			//Version plus performante :
			//SELECT * FROM table WHERE id IN (SELECT id FROM table ORDER BY RANDOM() LIMIT x)
		} else {
			$SQL = "SELECT $champs FROM pays WHERE id=:id OR ISO=:ISO";
		}
		$stmt = $db->prepare($SQL);
		if ($id !== "alea") {
			$stmt->bindParam(":id", $id);
			$stmt->bindParam(":ISO", $id);
		}
//		$stmt->bindColumn("id", $id);
//		$stmt->bindColumn("nom", $nom);
//		$stmt->bindColumn("nom2", $nom2);
//		$stmt->bindColumn("continent", $continent);
//		$stmt->bindColumn("capitale", $capitale);
//		$stmt->bindColumn("population", $population);
//		$stmt->bindColumn("nomHabitants", $nomHabitants);
//		$stmt->bindColumn("superficie", $superficie);
//		$stmt->bindColumn("densite", $densite);
//		$stmt->bindColumn("popUrbaine", $popUrbaine);
//		$stmt->bindColumn("frontieres", $frontieres);
//		$stmt->bindColumn("cotes", $cotes);
//		$stmt->bindColumn("eauxTerritoriales", $eauxTerritoriales);
//		$stmt->bindColumn("heure", $heure);
//		$stmt->bindColumn("moisFroids", $moisFroids);
//		$stmt->bindColumn("moisFroidsTemp", $moisFroidsTemp);
//		$stmt->bindColumn("moisChauds", $moisChauds);
//		$stmt->bindColumn("moisChaudsTemp", $moisChaudsTemp);

		// Exécution de la requête
		try {
			$stmt->execute();
			$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			throw new Exception($e->getMessage());
		}
		if (false && $stmt->rowCount() == 0) {
			header("location:index.php");
			exit;
		}
		return $resultat;
	}
	static public function html_index($stmt) {
		// Composition de l'affichage
		$resultat = '';
		$resultat .= '<table class="liste">';
		$resultat .= '<col class="drapeau" />';
		$resultat .= '<col class="nom" />';
		$resultat .= '<col class="options" />';
		$resultat .= '<thead>';
		$resultat .= '<tr>';
		$resultat .= '<th>&nbsp;</th>';
		$resultat .= '<th>Nom</th>';
		$resultat .= '<th>Options</th>';
		$resultat .= '</thead>';
		$resultat .= '<tbody>';
		if (false && $stmt->rowCount() == 0) {
			$resultat .= '<tr>';
			$resultat .= '<td colspan="3">Aucun pays trouvé</td>';
			$resultat .= '</tr>';
		} else {
			while (($pays = $stmt->fetch(PDO::FETCH_ASSOC)) != false) {
				extract($pays);
				$resultat .= '<td><a href="details.php?id='.$id.'"><img class="drapeau" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($ISO).'.svg" alt="" height="16"/></a></td>';
				$resultat .= '<td><a href="details.php?id='.$id.'">'.$nom2.'</a></td>';
				$resultat .= '<td class="options">';
				$resultat .= '<a href="details.php?id='.$id.'">Détails</a>';
				$resultat .= '<a href="modifier.php?id='.$id.'">Modifier</a>';
				$resultat .= '<a href="supprimer.php?id='.$id.'">Supprimer</a>';
				$resultat .= '</td>';
				$resultat .= '</tr>';
			}
		}
		$resultat .= '</tbody>';
		$resultat .= '</table>';
		return $resultat;
	}
	static public function html_modifier($pays, $erreurs) {
		extract($pays);
		// Composition de l'affichage
		$resultat = '';
		if (isset($erreurs['_global_'])) {
			$resultat .= $erreurs['_global_'];
		}
		$resultat .= '<h2>'.$nom2.'</h2>';
		$resultat .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($ISO).'.svg" alt="Drapeau"/>';
		$resultat .= '<form action="" method="post">';
		$resultat .= '<table class="details">';
		$resultat .= '<tbody>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="id">ISO</th>';
		$resultat .= '<td>'.$ISO.'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nom">Nom</th>';
		$resultat .= '<td><input type="text" name="nom" id="nom" value="'.$nom.'" />'.affichageErreur('nom', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nom2">Autre nom</th>';
		$resultat .= '<td><input type="text" name="nom2" id="nom2" value="'.$nom2.'" />'.affichageErreur('nom2', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="continent">Continent</th>';
		$resultat .= '<td><input type="text" name="continent" id="continent" value="'.$continent.'" />'.affichageErreur('continent', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="capitale">Capitale</th>';
		$resultat .= '<td><input type="text" name="capitale" id="capitale" value="'.$capitale.'" />'.affichageErreur('capitale', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="population">Population</th>';
		$resultat .= '<td><input type="text" name="population" id="population" value="'.$population.'" />&nbsp;habitants'.affichageErreur('population', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nomHabitants">Gentilé</th>';
		$resultat .= '<td><input type="text" name="nomHabitants" id="nomHabitants" value="'.$nomHabitants.'" />'.affichageErreur('nomHabitants', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="superficie">Superficie</th>';
		$resultat .= '<td><input type="text" name="superficie" id="superficie" value="'.$superficie.'" />&nbsp;km'.affichageErreur('superficie', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="densite">Densité</th>';
		$resultat .= '<td><input type="text" name="densite" id="densite" value="'.$densite.'" />&nbsp;habitants par km&sup2;'.affichageErreur('densite', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="popUrbaine">Population urbaine</th>';
		$resultat .= '<td><input type="text" name="popUrbaine" id="popUrbaine" value="'.$popUrbaine.'" />&nbsp;%'.affichageErreur('popUrbaine', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="frontieres">Frontières</th>';
		$resultat .= '<td><input type="text" name="frontieres" id="frontieres" value="'.$frontieres.'" />&nbsp;km&sup2;'.affichageErreur('frontieres', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="cotes">Côtes</th>';
		$resultat .= '<td><input type="text" name="cotes" id="cotes" value="'.$cotes.'" />&nbsp;km'.affichageErreur('moisChauds', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="eauxTerritoriales">Eaux territoriales</th>';
		$resultat .= '<td><input type="text" name="eauxTerritoriales" id="eauxTerritoriales" value="'.$eauxTerritoriales.'" />&nbsp;km&sup2;'.affichageErreur('eauxTerritoriales', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="heure">Heure</th>';
		$resultat .= '<td><input type="text" name="heure" id="heure" value="'.$heure.'" />'.affichageErreur('heure', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="moisFroids">Mois froids</th>';
		$resultat .= '<td><input type="text" name="moisFroids" id="moisFroids" size="5" value="'.$moisFroids.'" /> mois <input type="text" name="moisFroidsTemp" id="moisFroidsTemp" size="5" value="'.$moisFroidsTemp.'" />&deg;'.affichageErreur('moisFroidsTemp', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="moisChauds">Mois chauds</th>';
		$resultat .= '<td><input type="text" name="moisChauds" id="moisChauds" size="5" value="'.$moisChauds.'" /> mois <input type="text" name="moisChaudsTemp" id="moisChaudsTemp" size="5" value="'.$moisChaudsTemp.'" />&deg;'.affichageErreur('moisChauds', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '</tbody>';
		$resultat .= '</table>';
		$resultat .= '<div>';
		$resultat .= '<input type="hidden" name="id" value="'.$id.'" />';
		$resultat .= '<input type="hidden" name="modifier" />';
		$resultat .= '<input type="submit" />';
		$resultat .= '<input type="submit" name="annuler" value="Annuler" />';
		$resultat .= '</div>';
		$resultat .= '</form>';
		return $resultat;
	}
	static public function html_ajouter($pays, $erreurs) {
		extract($pays);
		// Composition de l'affichage
		$resultat = '';
		if (isset($erreurs['_global_'])) {
			$resultat .= $erreurs['_global_'];
		}
		$resultat .= '<h2>Ajouter un pays</h2>';
		$resultat .= '<form action="" method="post">';
		$resultat .= '<table class="details">';
		$resultat .= '<tbody>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="id">ISO</th>';
		$resultat .= '<td><input type="text" name="id" id="id" value="'.$id.'" />'.affichageErreur('id', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nom">Nom</th>';
		$resultat .= '<td><input type="text" name="nom" id="nom" value="'.$nom.'" />'.affichageErreur('nom', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nom2">Autre nom</th>';
		$resultat .= '<td><input type="text" name="nom2" id="nom2" value="'.$nom2.'" />'.affichageErreur('nom2', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="continent">Continent</th>';
		$resultat .= '<td><input type="text" name="continent" id="continent" value="'.$continent.'" />'.affichageErreur('continent', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="capitale">Capitale</th>';
		$resultat .= '<td><input type="text" name="capitale" id="capitale" value="'.$capitale.'" />'.affichageErreur('capitale', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="population">Population</th>';
		$resultat .= '<td><input type="text" name="population" id="population" value="'.$population.'" />&nbsp;habitants'.affichageErreur('population', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="nomHabitants">Gentilé</th>';
		$resultat .= '<td><input type="text" name="nomHabitants" id="nomHabitants" value="'.$nomHabitants.'" />'.affichageErreur('nomHabitants', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="superficie">Superficie</th>';
		$resultat .= '<td><input type="text" name="superficie" id="superficie" value="'.$superficie.'" />&nbsp;km'.affichageErreur('superficie', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="densite">Densité</th>';
		$resultat .= '<td><input type="text" name="densite" id="densite" value="'.$densite.'" />&nbsp;habitants par km&sup2;'.affichageErreur('densite', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="popUrbaine">Population urbaine</th>';
		$resultat .= '<td><input type="text" name="popUrbaine" id="popUrbaine" value="'.$popUrbaine.'" />&nbsp;%'.affichageErreur('popUrbaine', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="frontieres">Frontières</th>';
		$resultat .= '<td><input type="text" name="frontieres" id="frontieres" value="'.$frontieres.'" />&nbsp;km&sup2;'.affichageErreur('frontieres', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="cotes">Côtes</th>';
		$resultat .= '<td><input type="text" name="cotes" id="cotes" value="'.$cotes.'" />&nbsp;km'.affichageErreur('moisChauds', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="eauxTerritoriales">Eaux territoriales</th>';
		$resultat .= '<td><input type="text" name="eauxTerritoriales" id="eauxTerritoriales" value="'.$eauxTerritoriales.'" />&nbsp;km&sup2;'.affichageErreur('eauxTerritoriales', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="heure">Heure</th>';
		$resultat .= '<td><input type="text" name="heure" id="heure" value="'.$heure.'" />'.affichageErreur('heure', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="moisFroids">Mois froids</th>';
		$resultat .= '<td><input type="text" name="moisFroids" id="moisFroids" size="5" value="'.$moisFroids.'" /> mois <input type="text" name="moisFroidsTemp" id="moisFroidsTemp" size="5" value="'.$moisFroidsTemp.'" />&deg;'.affichageErreur('moisFroidsTemp', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '<tr>';
		$resultat .= '<th><label for="moisChauds">Mois chauds</th>';
		$resultat .= '<td><input type="text" name="moisChauds" id="moisChauds" size="5" value="'.$moisChauds.'" /> mois <input type="text" name="moisChaudsTemp" id="moisChaudsTemp" size="5" value="'.$moisChaudsTemp.'" />&deg;'.affichageErreur('moisChauds', $erreurs).'</td>';
		$resultat .= '</tr>';
		$resultat .= '</tbody>';
		$resultat .= '</table>';
		$resultat .= '<div>';
		$resultat .= '<input type="hidden" name="ajouter" />';
		$resultat .= '<input type="submit" />';
		$resultat .= '<input type="submit" name="annuler" value="Annuler" />';
		$resultat .= '</div>';
		$resultat .= '</form>';
		return $resultat;
	}
	static public function html_details($pays) {
		extract($pays);
		$resultat = '';
		$resultat .= '<h2>'.$nom2.'</h2>';
		$resultat .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($ISO).'.svg" alt="Drapeau"/>';
		$resultat .= '<table class="details">';
		$resultat .= '<tbody>';
		$resultat .= '<tr><th>ISO</th><td>'.$id.'</td></tr>';
		$resultat .= '<tr><th>Nom</th><td>'.$nom.'</td></tr>';
		$resultat .= '<tr><th>Autre nom</th><td>'.$nom2.'</td></tr>';
		$resultat .= '<tr><th>Continent</th><td>'.$continent.'</td></tr>';
		$resultat .= '<tr><th>Capitale</th><td>'.$capitale.'</td></tr>';
		$resultat .= '<tr><th>Population</th><td>'.$population.'&nbsp;habitants</td></tr>';
		$resultat .= '<tr><th>Gentilé</th><td>'.$nomHabitants.'</td></tr>';
		$resultat .= '<tr><th>Superficie</th><td>'.$superficie.'&nbsp;km</td></tr>';
		$resultat .= '<tr><th>Densité</th><td>'.$densite.'&nbsp;habitants par km&sup2;</td></tr>';
		$resultat .= '<tr><th>Population urbaine</th><td>'.$popUrbaine.'&nbsp;%</td></tr>';
		$resultat .= '<tr><th>Frontières</th><td>'.$frontieres.'&nbsp;km&sup2;</td></tr>';
		$resultat .= '<tr><th>Côtes</th><td>'.$cotes.'&nbsp;km</td></tr>';
		$resultat .= '<tr><th>Eaux territoriales</th><td>'.$eauxTerritoriales.'&nbsp;km&sup2;</td></tr>';
		$resultat .= '<tr><th>Heure</th><td>'.$heure.'</td></tr>';
		$resultat .= '<tr><th>Mois froids</th><td>'.$moisFroids.' ('.$moisFroidsTemp.'°)</td></tr>';
		$resultat .= '<tr><th>Mois chauds</th><td>'.$moisChauds.' ('.$moisChaudsTemp.'°)</td></tr>';
		$resultat .= '</tbody>';
		$resultat .= '</table>';
		return $resultat;
	}
	static public function html_supprimer($pays) {
		extract($pays);
		// Composition de l'affichage
		$affichage = '';
		$affichage .= '<h2>Supprimer un pays</h2>';
		$affichage .= '<img style="float:right;width:20em;border:1px solid black;" src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/'.strtolower($ISO).'.svg" alt="Drapeau"/>';
		$affichage .= '<form action="" method="post">';
		$affichage .= '<table class="details">';
		$affichage .= '<tbody>';
		$affichage .= '<tr><th>ISO</th><td>'.$id.'</td></tr>';
		$affichage .= '<tr><th>Nom</th><td>'.$nom.'</td></tr>';
		$affichage .= '<tr><th>Autre nom</th><td>'.$nom2.'</td></tr>';
		$affichage .= '</tbody>';
		$affichage .= '</table>';
		$affichage .= '<div>';
		$affichage .= '<input type="hidden" name="id" value="'.$id.'" />';
		$affichage .= '<input type="hidden" name="supprimer" />';
		$affichage .= '<input type="submit" value="Supprimer" />';
		$affichage .= '<input type="submit" name="annuler" value="Annuler" />';
		$affichage .= '</div>';
		$affichage .= '</form>';
		return $affichage;
	}
}
