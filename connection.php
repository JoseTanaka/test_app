<?php 
require_once('config.php');

function connectPdo() {
	try{
		return new PDO(DSN,DB_USER,DB_PASSWORD);
	}	catch (PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}
function insertDb($data) {
	$dbh = connectPdo();
	$sql = 'INSERT INTO todos (todo) VALUES (:todo)';
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':todo', $data, PDO::PARAM_STR);
	$stmt->execute();
}