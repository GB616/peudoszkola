<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_GET['id'])){
		header('Location: seeU.php');
		exit();
	}
	else
	{		
		$idget = filter_input(INPUT_GET, 'id');
			
		$ifIsQuery = $db->prepare('Select * FROM uczniowie WHERE id = :id');
		$ifIsQuery->bindValue(':id', $idget, PDO::PARAM_STR);
		$ifIsQuery->execute();
		
		$uczen = $ifIsQuery->fetch();
		
		if($uczen)
		{
			$userQuery = $db->prepare('DELETE FROM uczniowie WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->execute();
			
			header('Location: seeU.php');
		}
		else
			header('Location: seeU.php');
	}