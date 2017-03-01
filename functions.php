<?php 
require('connection.php');
session_start();

function create($data) {
if(checkToken($data['token'])){
	insertDb($data['todo']);
}
}
function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
function setToken() {
	$token = sha1(uniqid(mt_tand(), true));
	$_SESSION['token'] = $token;
}
function checkToken($data) {
	if (empty($_SESSION['token']) || ($_SESSION['token'] != $data)){
		$_SESSION['err'] = '不正な操作です';
		header('location: '.$_SERVER['HTTP_REFERER'].'');
	}
	return true;
}
function unsetSession() {
	if(!empty($_SESSION['err'])) $_SESSION['err'] = '';
}
function index() {
	return $todos = selectAll();
}

function checkReferer() {
	$httpArr = parse_url($_SERVER['HTTP_REFERER']);
	return $res = transition($httpArr['path']);
}

function transition($path) {
	$data = $_POST;
	if($path === '/index.php' && $data['type'] === 'delete'){
		deleteData($data['id']);
		return 'index';
	}elseif($path === '/new.php'){
		create($data);
	}elseif($path === '/edit.php'){
		update($data);
	}
}

function update($data) {
	updateDb($data['id'], $data['todo']);
}
function detail($id) {
	return getSelectData($id);
}
function deleteData($id) {
	deleteDb($id);
}