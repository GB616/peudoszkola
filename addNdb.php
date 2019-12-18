<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_admin'])){
		header('Location: admin.php');
		exit();
	}
	else
	{
		$imie = filter_input(INPUT_POST, 'imie');
		$nazwisko = filter_input(INPUT_POST, 'nazwisko');
		$login = filter_input(INPUT_POST, 'login');
		$haslo = filter_input(INPUT_POST, 'haslo');
		
		$userQuery = $db->prepare("INSERT INTO nauczyciele (id, imie, nazwisko, login, haslo)
		                           VALUES(null,:imie, :nazwisko,:login,:haslo) ");
		$userQuery->bindValue(':imie', $imie, PDO::PARAM_STR);
		$userQuery->bindValue(':nazwisko', $nazwisko, PDO::PARAM_STR);
		$userQuery->bindValue(':login', $login, PDO::PARAM_STR);
		$userQuery->bindValue(':haslo', $haslo, PDO::PARAM_STR);
		$userQuery->execute();
		
		header('Location: see_nauczyciele.php');
		exit();
	}
?>

