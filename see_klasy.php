<?php

session_start();
require_once 'database.php';

if(isset($_SESSION['logged_id_admin']))
{
	$klasyQuery = $db->query('SELECT * FROM klasy');
	$klasy = $klasyQuery->fetchAll();	
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
	<div class="container" style="width: 800px">
		<header> 
			<h2>Klasy w szkole</h2> 
		</header>
		<main>
            <?php require_once 'szablon_html.php';?>
			<div style=" height: 300px; overflow: scroll;">
				<table>
					<thead>
						<tr><th colspan="6">Łącznie rekordów: <?= $klasyQuery->rowCount() ?></th></tr>
						<tr><th>ID</th><th>Nazwa</th><th>Opis</th><th>Edytuj</th><th>Usuń</th></tr>
					</thead>
					<tbody>
						<?php
						foreach ($klasy as $klasa) {
							echo "<tr>
									<td>{$klasa['id']}</td>
									<td>{$klasa['Nazwa']}</td>
									<td>{$klasa['Opis']}</td>
									<td><a href=\"edit_klasy.php?id={$klasa['id']}\"> Edytuj</a></td>
									<td><a href=\"delete.php?id={$klasa['id']}&table=klasy\">Usuń</a></td>
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