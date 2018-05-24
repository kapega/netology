<?php
session_start();


function login($login, $password) {
	$user = getUser($login);
	if ($user && $user['password'] === $password) {
		$_SESSION['user'] = $user;
		return true;
	}
	else {
		return false;
	}
}


function getUser ($login){
	$users = getUsers();
	foreach ($users as $user) {
		if ($login == $user['login']) {
			return $user;
		}
	}
	return NULL;
}


function getUsers() {
	$userData = file_get_contents(__DIR__ . '/users.json');
	if (!$userData){
		return [];
	}
	
	$users = json_decode($userData, true);
	
	if (!$users) {
		return [];
	}
	
	return $users;
}


function isAuthorized() {
	return !empty($_SESSION['user']);
}


function isAdmin() {
	return isAuthorized() && $_SESSION['user']['is_admin'];
}