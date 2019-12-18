<?php

session_start();
require_once 'database.php';

if(!isset($_SESSION['logged_id_nauczyciel']))
{
	if(isset($_GET['login']))
	{
		$login = filter_input(INPUT_GET, 'login');
		$password = filter_input(INPUT_GET, 'haslo');
	    echo $login . " " .$password;
    
		$userQuery = $db->prepare('SELECT id, haslo FROM nauczyciele WHERE login = :login');
		$userQuery->bindValue(':login', $login, PDO::PARAM_STR);
		$userQuery->execute();
		
		$user = $userQuery->fetch();
		
		echo $user['id'] . " " . $user['haslo'];
		
		if($user)/* && password_verify($password, $user['haslo']))*/
		{
			$_SESSION['logged_id_nauczyciel'] = $user['id'];
			$_SESSION['actual_user'] = 'nauczyciel';
			UNSET($_SESSION['bad_attempt']);
		}
		else
		{
			$_SESSION['bad_attempt']=true;
			header('Location: logowanie.php'); 
			exit();
		}	
	}
	else
	{
		header('Location: logowanie.php?b=23'); 
		exit();	
	}
} 
$userssQuery = $db->query('SELECT uczniowie.Imie, uczniowie.Nazwisko, klasy.nazwa FROM uczniowie LEFT JOIN klasy ON uczniowie.klasa = klasy.id ');
$users = $userssQuery->fetchAll();	
?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title> Panel nauczyciela </title>
	<link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head> 
<body>
	<div class="container">
		<header> 
			<h2>Dziennik</h2> 
		</header>
		<main>
		<div>
			<div class="przycisk" >
				<a href="ocenaf.php">Wstaw ocenę </a>
			</div>
			<div class="przycisk" >
				<p><a href="logout.php?user=nauczyciel">Wyloguj się!</a></p>
			</div>
			
			<div class="divclear">
            </div>			
		</div>
		    <div style=" height: 300px; overflow: scroll;">
			<table>
					<thead>
						<tr><th colspan="3">Łącznie rekordów: <?= $userssQuery->rowCount() ?></th></tr>
						<tr><th>Imie</th><th>Nazwisko</th><th>Klasa</th></tr>
					</thead>
					<tbody>
						<?php
						foreach ($users as $user) {
							echo "<tr>
									<td>{$user['Imie']}</td>
									<td>{$user['Nazwisko']}</td>
									<td>{$user['nazwa']}</td>
								  </tr>";
						}
						?>
					</tbody>
				</table>
			</div>	
		</main>
	</div>
</body>
</html>