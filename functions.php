<?php
function close_session($user_id)
	{
	global $database;
	$database->update("session", array("logout_timestamp" => date('Y-m-d H:i:s',time())),
		array(
		"AND" => array(
			"user_id" => $user_id
			)
		));	
	return "ok";
	}

function create_session($user_id)
	{
	global $database;
	$token = generateRandomString(32);
	$database->insert("session", array(
		"user_id" => $user_id,
		"user_token" => $token,
		"login_timestamp" => date('Y-m-d H:i:s',time())
		));	
	return $token;
	}


function login_check($username,$password)
	{
	global $database;
	$result = $database->select("account",array("id","username","password"), 
		array(
		"AND" => array(
			"username" => $username
			)
		));	
	
	if (count($result) > 0)
		{
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
	else
		{
		return "error: wrong username/password";
		}
	}


function update_variable($username,$password,$param,$value)
	{
	global $database;
	$id = login_check($username,$password);
	
	$result = $database->select("details",array("variable","value"), 
		array(
		"AND" => array(
			"user_id" => $id,
			"variable" => $param
			)
		));	

	if (count($result) > 0) // return
		{
		$database->update("details", array("value" => $value),
			array(
			"AND" => array(
				"user_id" => $id,
				"variable" => $param
				)
			));	
		return "ok: updated";	
		}
	else
		{
		$database->insert("details", array(
			"user_id" => $id,
			"variable" => $param,
			"value" =>  $value
			));
		return "ok: added";		
		}
	}



function remove_variable($username,$password,$param,$value)
	{
	global $database;
	$id = login_check($username,$password);
	
	$result = $database->select("details",array("id"), 
		array(
		"AND" => array(
			"user_id" => $id,
			"variable" => $param,
			"value" => $value
			)
		));	

	
	if (count($result) > 0) // return
		{
		$param_id =  $result[0]['id'];
		$database->delete("details", array("id" => $param_id));
		return "ok: deleted";	
		}
	
	}




function register($username,$password,$email)
	{
	global $database;
	$result = $database->select("account",array("username"), 
		array(
		"username" => $username
		));	

	if (count($result) > 0) // return
		{
		return "error: username already taken";
		}
	else
		{
		$database->insert("account", array(
			"username" => $username,
			"password" =>  password_hash($password, PASSWORD_DEFAULT),
			"email" => $email
			));
		return login_check( $username,$password);
		}
	}



function fetch_all_info($userid)
	{
	global $database;
	$result = $database->select("details",array("variable","value"), 
		array(
		"AND" => array(
			"user_id" => $userid
			)
		));	
		
	return $result;
	}
