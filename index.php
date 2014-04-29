<?php

// Independent configuration
require 'medoo.min.php';
require 'connection.php';
require 'support_functions.php';
require 'functions.php';

$available_system = array();
//array_push($system,array("myutm",'ifN08EwiaF0OoUXVhtDtMWIMnquerhvlui3g4y98gt3lkwae34uy9r38uyhfn38y4f98o34');
$available_system["myutm"] = array('http://localhost/oauth/sistem1_sso.php','ifN08EwiaF0OoUXVhtDtMWIMnquerhvlui3g4y98gt3lkwae34uy9r38uyhfn38y4f98o34');
$available_system["sample"] = array('http://localhost/oauth/sistem2_sso.php','ifN08EwiaF0OoUXVhtDtMWIMnqrH2vagiwhglkwae34uy9r38uyhfn38y4f98o34');

		
$system = isset($_GET['system']) ? $_GET['system'] : "" ;		
$logout = isset($_GET['logout']) ? $_GET['logout'] : "" ;			
//var_dump($logout);
if ($logout == "true")
{
close_session($_COOKIE['user_id']);
setcookie("username","",time()-3600);
setcookie("userToken","",time()-3600);
setcookie("user_id","",time()-3600);
redirect("index.php");
}

		
if ($system == "")
	{
	$system = "myutm";
	}
		
if (@$_COOKIE['username'] != null) // already logged in
	{

	
	$the_system = $available_system[$system];
	
	$redirect = $the_system[0];
	$secret = $the_system[1];
	
	$username = $_COOKIE['username'];
	$userToken = $_COOKIE['userToken'];

	if(@$_GET['handshake'] == 'true')
		{
		redirect($_GET['redirect']."?check=".md5(get_client_ip()).$secret.$username.$userToken);
		}
	else
		{
		redirect($redirect."?token=".$userToken."&username=".$username);
		}
	}
else // not logged in
	{
	$username = isset($_POST['username']) ? $_POST['username'] : "" ;
	$password = isset($_POST['password']) ? $_POST['password'] : "" ;  
	if ($username == "" or $password == "")
		{
		include "login.php";
		}
	else
		{
		$userid = login_check($username,$password);
		if ($userid != "error: wrong username/password")
			{
			$token = create_session($userid);
			setcookie("username",$username);
			setcookie("userToken",$token);
			setcookie("user_id",$userid);	
			}
		redirect("index.php");
		}
	}
/*
echo register("misterpah","123","misterpah@gmail.com");

$user_data = fetch_all_info($userid);
echo "<pre>";
var_dump($user_data);
echo update_variable("misterpah","123","G++","misterpah");
$user_data = fetch_all_info($userid);
echo "<pre>";
var_dump($user_data);
echo remove_variable("misterpah","123","G++","misterpah");
$user_data = fetch_all_info($userid);
echo "<pre>";
var_dump($user_data);
*/
