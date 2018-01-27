<?php
	session_start();
	require_once 'dbcon.php';

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("Location: index.php");
		exit();
	}

	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	} elseif (isset($_SESSION['user'])!="") {
		header("Location: home.php");
		exit;
	}

?>