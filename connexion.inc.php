<?php
if (file_exists("../pdo.inc.php")) {
	include("../pdo.inc.php");
	$cfg['dbname'] = 'mboudrea_monde2';
} else {
	$cfg['host'] = 'localhost';
	$cfg['username'] = 'root';
	$cfg['password'] = '';
	$cfg['dbname'] = 'monde';
}
$cfg['dsn'] = "mysql:host=".$cfg['host'].";charset=utf8;";
$db = new PDO($cfg['dsn'], $cfg['username'], $cfg['password']);
$res = $db->exec("USE ".$cfg['dbname']);
if ($res === false) {
	$db->exec(file_get_contents("monde.sql"));
}
unset($res);
?>
