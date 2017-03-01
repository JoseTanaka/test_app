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
function selectAll(){
	$dbh = connectPdo();
	$sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
	$todo = array();
	foreach($dbh->query($sql) as $row) {
		array_push($todo, $row);
	} 
	return $todo;
}
function getSeletData($id) {
	$dbh = connectPdo();
	$sql = 'SELECT todo FROM todos WHERE id = :id AND deleted_at IS NULL';
	$stmt->execute(array(':id' => (int)$id));
	$data = $stmt->fetch();
	return $data['todo'];
}
function insertDB($data) {
	$dbh = connectPdo();
	$sql = 'INSERT INTO todos (todo) VALUES (:todo)';
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':todo', $data, PDO::PARAM_STR);
	$stmt->execute();
}
function updateDb($id, $data) {
	$dbh = connectPdo();
	$sql = 'UPDATE todos SET todo = :todo WHERE id = :id';
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(':todo', $data, PDO::PARAM_STR);
	$stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
	$stmt->execute();
}
