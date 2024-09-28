<?php
	require_once('../models/dbFunctions.php');
	session_start();

	$action = $_POST['action'];

	if($action == 'login')
		header('location:../views/login.php');

	else if($action == 'signup')
		header('location:../views/register.php');
?>