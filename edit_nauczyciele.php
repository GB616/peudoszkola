<?php
session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_admin']) || !isset($_GET['id'])){
		header('Location: admin.php');
		exit();
	}
	else
	{
		if(isset($_POST['imie']))
		{
			$idget = filter_input(INPUT_GET, 'id');
			
			$userQuery = $db->prepare('UPDATE nauczyciele SET  Imie = :imie, Nazwisko = :nazwisko,  
			                           Login = :login, Haslo = :haslo  WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
			$userQuery->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
			$userQuery->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
			$userQuery->bindValue(':haslo', $_POST['haslo'], PDO::PARAM_STR);
			$userQuery->execute();	
			
			header('Location: see_nauczyciele.php');
		}
		else
		{		
			$idget = filter_input(INPUT_GET, 'id');
			
			$userQuery = $db->prepare('SELECT id, Imie, Nazwisko,  Login, Haslo FROM nauczyciele WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->execute();
			
			$dane = $userQuery->fetch();
	
			if(!$dane)
			{
				header('Location: see_uczniowie.php');
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
				<form method="post" action="addNdb.php">
					<label> Imie <input type="text" name="imie"  value="<?php echo $dane['Imie'];?>"></label>
					<label> Nazwiko <input type="text" name="nazwisko"  value="<?php echo $dane['Nazwisko'];?>"></label>
					<label> Login <input type="text" name="login"  value="<?php echo $dane['Login'];?>"></label>
					<label> Hasło <input type="text" name="haslo"  value="<?php echo $dane['Haslo'];?>"></label>
					<input type="submit" value="Edytuj">			
				</form>
			</article>
		</main>
	</div>
</body>
</html>