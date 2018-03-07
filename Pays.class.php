<?php
class Pays {
	static public function traitementAjouter ($source) {
		// Récupération des données
		$id = trim($source['id']);
		$nom = trim($source['nom']);
		$nom2 = trim($source['nom2']);
		$continent = trim($source['continent']);
		$capitale = trim($source['capitale']);
		$population = trim($source['population']);
		$nomHabitants = trim($source['nomHabitants']);
		$superficie = trim($source['superficie']);
		$densite = trim($source['densite']);
		$popUrbaine = trim($source['popUrbaine']);
		$frontieres = trim($source['frontieres']);
		$cotes = trim($source['cotes']);
		$eauxTerritoriales = trim($source['eauxTerritoriales']);
		$heure = trim($source['heure']);
		$moisFroids = trim($source['moisFroids']);
		$moisFroidsTemp = trim($source['moisFroidsTemp']);
		$moisChauds = trim($source['moisChauds']);
		$moisChaudsTemp = trim($source['moisChaudsTemp']);

		// Validation
		if ($nom == '')
			$erreurs['id'] = "Vous devez fournir un code ISO.";
		if ($nom == '')
			$erreurs['nom'] = "Vous devez fournir un nom.";
		if ($nom2 == '')
			$erreurs['nom2'] = "Vous devez fournir un autre nom.";
	/* 	if ($continent == '')
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
	 */	//TODO Compléter pour frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp

		// Traitement des données
		// ... Ici, on ne fait rien pour l'instant

		// Sauvegarde des données
		if (count($erreurs) > 0) {
			$messageErreurs = '<div class="erreur">Il y a une erreur dans le formulaire</div>';
		} else {
			$db = Monde::connect();

			// Composition du SQL
			$CHAMPS = "id, nom, nom2, continent, capitale, population, nomHabitants, superficie, densite, popUrbaine, frontieres, cotes, eauxTerritoriales, heure, moisFroids, moisFroidsTemp, moisChauds, moisChaudsTemp";
			$VALUES = ":id, :nom, :nom2, :continent, :capitale, :population, :nomHabitants, :superficie, :densite, :popUrbaine, :frontieres, cotes=:cotes, :eauxTerritoriales, :heure, :moisFroids, :moisFroidsTemp, :moisChauds, moisChaudsTemp=:moisChaudsTemp";
			$SQL = "INSERT INTO pays ($CHAMPS) VALUES ($VALUES);";
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
	}
}
