<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_admin'])){
		header('Location: admin.php');
		exit();
	}
	else
	{
		$nazwa = filter_input(INPUT_POST, 'nazwa');
		$opis = filter_input(INPUT_POST, 'opis');
		
		$userQuery = $db->prepare("INSERT INTO klasy (id, nazwa, opis) VALUES(null,:nazwa, :opis)");
		$userQuery->bindValue(':nazwa', $nazwa, PDO::PARAM_STR);
		$userQuery->bindValue(':opis', $opis, PDO::PARAM_STR);
		$userQuery->execute();
		
		header('Location: see_klasy.php');
		exit();
	}	
?>
