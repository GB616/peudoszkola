<?php

session_start();
require_once 'database.php';

if(!isset($_SESSION['logged_id_uczen']))
{
	if(isset($_GET['login']))
	{
		$login = filter_input(INPUT_GET, 'login');
		$password = filter_input(INPUT_GET, 'haslo');
	    echo $login . " " .$password;
    	
		$userQuery = $db->prepare('SELECT id, haslo FROM uczniowie WHERE login = :login');
		$userQuery->bindValue(':login', $login, PDO::PARAM_STR);
		$userQuery->execute();
		
		$user = $userQuery->fetch();
				
		if($user)/* && password_verify($password, $user['haslo']))*/
		{
			$_SESSION['logged_id_uczen'] = $user['id'];
			$_SESSION['actual_user'] = 'uczen';
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
		header('Location: logowanie.php'); 
		exit();		
	}	
} 

$idu = $_SESSION['logged_id_uczen'];
$userssQuery = $db->query("SELECT oceny.wartosc, oceny.data, CONCAT(nauczyciele.imie,' ' ,nauczyciele.nazwisko) Nauczyciel  
                           FROM oceny  LEFT JOIN nauczyciele ON oceny.id_nauczyciela = nauczyciele.id 
						   WHERE id_ucznia = {$idu}");
$oceny = $userssQuery->fetchAll();	

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title> Panel ucznia </title>
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
					<p><a href="logutn.php?user=uczen">Wyloguj się!</a></p>
				</div>
				<div class="divclear">
				</div>
			</div>
			<div style=" height: 300px; overflow: scroll;">
				<table>
					<thead>
						<tr><th colspan="3">Łącznie rekordów: <?= $userssQuery->rowCount() ?></th></tr>
						<tr><th>Ocena</th><th>Data</th><th>Nauczyciel</th></tr>
					</thead>
					<tbody>
						<?php
						foreach ($oceny as $ocena) {
							echo "<tr>
									<td>{$ocena['wartosc']}</td>
									<td>{$ocena['data']}</td>
									<td>{$ocena['Nauczyciel']}</td>
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