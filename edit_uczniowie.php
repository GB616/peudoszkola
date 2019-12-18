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
			
			$userQuery = $db->prepare('UPDATE uczniowie SET  Imie = :imie, Nazwisko = :nazwisko, 
			                           Klasa = :klasa, Login = :login, Haslo = :haslo  
                           			   WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->bindValue(':imie', $_POST['imie'], PDO::PARAM_STR);
			$userQuery->bindValue(':nazwisko', $_POST['nazwisko'], PDO::PARAM_STR);
			$userQuery->bindValue(':klasa', $_POST['klasa']);
			$userQuery->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
			$userQuery->bindValue(':haslo', $_POST['haslo'], PDO::PARAM_STR);
			$userQuery->execute();	
			
			header('Location: see_uczniowie.php');
		}
		else
		{		
			$idget = filter_input(INPUT_GET, 'id');
		
		
			$userQuery = $db->prepare('SELECT id, Imie, Nazwisko, Klasa, Login, Haslo FROM uczniowie WHERE id = :id');
			$userQuery->bindValue(':id', $idget, PDO::PARAM_STR);
			$userQuery->execute();
			
			$klasyQuery = $db->prepare('SELECT * FROM klasy');
			$klasyQuery->execute();
			
			$dane = $userQuery->fetch();
		    $klasy = $klasyQuery->fetchAll();
		
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
	<title> Panel derektora </title>
	<link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head> 
<body>
	<div class="container">
		<header> 
			<h2>Dodaj ucznia</h2> 
		</header>
		<main>
			<article>
				<form method="post" > <!--action="addUdb.php?id=php $idget; ?>"-->
					<label> Imie <input type="text" name="imie" value="<?php echo $dane['Imie'];?>"></label>
					<label> Nazwiko <input type="text" name="nazwisko" value="<?php echo $dane['Nazwisko'];?>"></label>
					<label> Login <input type="text" name="login" value="<?php echo $dane['Login'];?>"></label>
					<label> Hasło <input type="text" name="haslo" value="<?php echo $dane['Haslo'];?>"></label>
					<select name="klasa" >
						<?php
							foreach ($klasy as $klasa) {
								if($klasa['id'] == $dane['Klasa'])
									echo "<option selected value= {$klasa['id']} >{$klasa['Nazwa']} {$klasa['Opis']}  </option>";
								else									
									echo "<option value= {$klasa['id']} >{$klasa['Nazwa']} {$klasa['Opis']}  </option>";
							}
						?>
					</select>	
					<input type="submit" value="Zaktualiuj">				
				</form>
			</article>
		</main>
	</div>
</body>
</html>