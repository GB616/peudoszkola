<?php
session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_admin']) || !isset($_GET['id'])){
		header('Location: admin.php');
		exit();
	}
	else
	{
		if(isset($_POST['nazwa']))
		{
			$idget = filter_input(INPUT_GET, 'id');
			
			$userQuery = $db->prepare('UPDATE klasy SET  Nazwa = :nazwa, Opis = :opis WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->bindValue(':nazwa', $_POST['nazwa'], PDO::PARAM_STR);
			$userQuery->bindValue(':opis', $_POST['opis'], PDO::PARAM_STR);
	
			$userQuery->execute();	
			
			header('Location: see_klasy.php');
		}
		else
		{		
			$idget = filter_input(INPUT_GET, 'id');
			
			$userQuery = $db->prepare('SELECT * FROM klasy WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->execute();
			
			$dane = $userQuery->fetch();
	
			if(!$dane)
			{
				header('Location: see_klasy.php');
				exit();
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title> Edytuj naucyciela </title>
	<link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head> 
<body>
	<div class="container">
		<header> 
			<h2>Edytuj nauczyciela</h2> 
		</header>
		<main>
			<article>
				<form method="post" >		
					<label> Imie <input type="text" name="nazwa"  value="<?php echo $dane['Nazwa'];?>"></label>
					<label> Nazwiko <input type="text" name="opis"  value="<?php echo $dane['Opis'];?>"></label>			
					<input type="submit" value="Edytuj">
				</form>
			</article>
		</main>
	</div>
</body>
</html>