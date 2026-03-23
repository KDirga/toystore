<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

  
	include 'includes/header.php';
	require_once 'includes/session.php';


	logout();											// Call the logout function to terminate session
	header('Location: index.php');						// Redirect to index page
?>