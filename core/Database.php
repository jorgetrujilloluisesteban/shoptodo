<?php

class Database{

	/*static public function getConnection(){
		$link = new PDO("mysql:host=localhost;dbname=drupal_7",
						"drupal_a",
						"esteban13",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;

	}*/
		static public function getConnection(){
		$link = new PDO("mysql:host=localhost;dbname=shoptodo",
						"root",
						"",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;
	}

}
