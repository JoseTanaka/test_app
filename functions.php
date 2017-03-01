<?php
require('connection.php');

function create($data) {
	insertDb($data['todo']); 
}
function index() {
  return $todos = selectAll();
}