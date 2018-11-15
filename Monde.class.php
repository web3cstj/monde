<?php
class Monde {
	static public $pdo = null;
	static public function connect() {
		if (self::$pdo === null) {
			$host = 'localhost';
			$dbname = 'monde';
			$charset = 'utf8';
			$dsn = "sqlite:monde.sqlite";
			self::$pdo = new PDO($dsn);
			$rep = self::$pdo->exec('USE '.$dbname.';');
			if ($rep === false) {
				self::$pdo->exec('CREATE DATABASE IF NOT EXISTS '.$dbname.' DEFAULT CHARSET utf8;');
				self::$pdo->exec('USE '.$dbname.';');
				self::$pdo->exec(file_get_contents("monde.sql"));
			}
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;
	}
}
function affichageErreur($nom, $erreurs) {
	if (!isset($erreurs[$nom])) return '';
	$resultat = '';
	$resultat .= '<span class="erreur">* '.$erreurs[$nom].'</span>';
	return $resultat;
}
