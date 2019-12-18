<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_nauczyciel'])){
		header('Location: logowanie.php');
		exit();
	}
	else
	{
		$id_nauczyciel = $_SESSION['logged_id_nauczyciel'];
		$id_ucznia = filter_input(INPUT_POST, 'uczen');
		$ocena = filter_input(INPUT_POST, 'ocena');
		$komentarz = filter_input(INPUT_POST, 'komentarz');
		$dzien = date("Y-m-d");
		
		$userQuery = $db->prepare("INSERT INTO oceny (id, wartosc, data, id_nauczyciela, id_ucznia) 
		                           VALUES(null,:ocena, :dzien,:id_nauczyciel,:id_ucznia) ");
		$userQuery->bindValue(':ocena', $ocena, PDO::PARAM_STR);
		$userQuery->bindValue(':dzien', $dzien, PDO::PARAM_STR);
		$userQuery->bindValue(':id_nauczyciel', $id_nauczyciel, PDO::PARAM_STR);
		$userQuery->bindValue(':id_ucznia', $id_ucznia, PDO::PARAM_STR);
		$userQuery->execute();
		
		header('Location: szkola.php');
		exit();
	}
?>