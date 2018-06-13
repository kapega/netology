<?php

require_once __DIR__.'/ar.php';

class User extends AR
{
	const TABLE_NAME = 'user';
	const ATTRIBUTES = ['id' => 'i', 'login' => 's', 'password' => 's'];
	protected $id, $login, $password;
	
	// + авторизация с session_start()
}
