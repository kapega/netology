<?php

/**
   Использовать так:
   $dbh = DBH::getInstance()->db;
 */
class DBH
{
	private static $instance = null;
	
	public $db;
	
	private function __construct()
	{
		$db_options = require __DIR__.'/db_params.php';
		$this->db = new mysqli($db_options['host'], $db_options['user'], $db_options['password'], $db_options['dbname']);
	}
	
	public static function getInstance()
	{
		if (is_null(self::$instance))
			self::$instance = new self();
		return self::$instance;
	}
}
