<?php

// Independent configuration
require  'medoo.min.php';
 
$database = new medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'test',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',
 
	// optional
	'port' => 3306,
	'charset' => 'utf8',
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);
 
$database->insert("account", [
	"username" => "foo",
	"password" => "bar"
]);
 
$result = $database->select("account",["id","username"], 
[
	"username" => "parthi",

]);

var_dump($result);


$result_2 = $database->select("details",["variable", "value"], 
[
	"user_id" => $result[0]["id"],
	
]);

var_dump($result_2);
