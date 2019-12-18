<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_GET['id'])){
		header('Location:see_' . $_GET['table'] . '.php');
		exit();
	}
	else
	{		
		$idget = filter_input(INPUT_GET, 'id');
		$tableget = filter_input(INPUT_GET, 'table');
			
		$ifIsQuery = $db->prepare("Select * FROM {$tableget} WHERE id = :id");
		$ifIsQuery->bindValue(':id', $idget, PDO::PARAM_STR);
		$ifIsQuery->execute();
		
		$rekord = $ifIsQuery->fetch();
		
		if($rekord)
		{
			
			$deleteQuery = $db->prepare("DELETE FROM {$tableget} WHERE id = :id");
			$deleteQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$deleteQuery->execute();
			
			header('Location:see_' . $tableget . '.php');
		}
		else
		{
			header('Location:see_' . $tableget . '.php');
		}
	}