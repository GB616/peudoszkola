<?php

session_start();
require_once 'database.php';

if(isset($_SESSION['logged_id_admin']))
{
	$userssQuery = $db->query('SELECT uczniowie.id, uczniowie.Imie, uczniowie.Nazwisko, 
	                           uczniowie.Klasa, uczniowie.Login, uczniowie.Haslo, klasy.Nazwa  
		                       FROM uczniowie  LEFT JOIN klasy   ON uczniowie.klasa = klasy.id');
	$users = $userssQuery->fetchAll();
} 
else
{
		header('Location: admin.php'); 
		exit();
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
	<div class="container" style="width: 900px">
		<header> 
			<h2>Osoby w szkole</h2> 
		</header>
		<main>	
		    <?php require_once 'szablon_html.php';?>
			<div style=" height: 300px; overflow: scroll;">	
			<table>			
				<thead>
					<tr><th colspan="6">Łącznie rekordów: <?= $userssQuery->rowCount() ?></th></tr>
					<tr><th>ID</th><th>Imie</th><th>Nazwisko</th><th>Klasa</th><th>Edytuj</th><th>Usuń</th></tr>
				</thead>					
				<tbody>
					<?php
					foreach ($users as $user) {
						echo "<tr>
								<td>{$user['id']}</td>
								<td>{$user['Imie']}</td>
								<td>{$user['Nazwisko']}</td>
								<td>{$user['Nazwa']}</td>
								<td><a href=\"edit_uczniowie.php?id={$user['id']}\"> Edytuj</a></td>
								<td><a href=\"delete.php?id={$user['id']}&table=uczniowie\">Usuń</a></td>
							  </tr>";
					}
					?>
				</tbody>					
			</table>
			<div>		
		</main>
</body>
</html>