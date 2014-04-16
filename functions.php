<?php

function login_check($username,$password)
	{
	global $database;
	$result = $database->select("account",["id","username","password"], 
		[
		"AND" => [
			"username" => $username
			]
		]);	
		
	$password_db = $result[0]['password'];
	if (password_verify($password,$password_db))
		{
		return $result[0]['id'];
		}
	else
		{
		return "error: wrong username/password";
		}
	}


function update_variable($username,$password,$param,$value)
	{
	global $database;
	$id = login_check($username,$password);
	
	$result = $database->select("details",["variable","value"], 
		[
		"AND" => [
			"user_id" => $id,
			"variable" => $param
			]
		]);	

	if (count($result) > 0) // return
		{
		$database->update("details", ["value" => $value],
			[
			"AND" => [
				"user_id" => $id,
				"variable" => $param
				]
			]);	
		return "ok: updated";	
		}
	else
		{
		$database->insert("details", [
			"user_id" => $id,
			"variable" => $param,
			"value" =>  $value
			]);
		return "ok: added";		
		}
	}



function remove_variable($username,$password,$param,$value)
	{
	global $database;
	$id = login_check($username,$password);
	
	$result = $database->select("details",["id"], 
		[
		"AND" => [
			"user_id" => $id,
			"variable" => $param,
			"value" => $value
			]
		]);	

	
	if (count($result) > 0) // return
		{
		$param_id =  $result[0]['id'];
		$database->delete("details", ["id" => $param_id]);
		return "ok: deleted";	
		}
	
	}




function register($username,$password,$email)
	{
	global $database;
	$result = $database->select("account",["username"], 
		[
		"username" => $username
		]);	

	if (count($result) > 0) // return
		{
		return "error: username already taken";
		}
	else
		{
		$database->insert("account", [
			"username" => $username,
			"password" =>  password_hash($password, PASSWORD_DEFAULT),
			"email" => $email
			]);
		return login_check( $username,$password);
		}
	}



function fetch_all_info($userid)
	{
	global $database;
	$result = $database->select("details",["variable","value"], 
		[
		"AND" => [
			"user_id" => $userid
			]
		]);	
		
	return $result;
	}
