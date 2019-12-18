<?php
	session_start();
	
	if(!isset($_SESSION['logged_id_admin'])){
		header('Location: admin.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title> Dodaj klasy </title>
	<link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head> 
<body>
	<div class="container">
		<header> 
			<h2>Dodaj klasy</h2> 
		</header>
		<main>
			<article>
				<form method="post" action="add_klasy_db.php">				
					<label> Nazwa <input type="text" name="nazwa"></label>
					<label> Opis <input type="text" name="opis"></label>
					<input type="submit" value="wstaw">
				</form>
			</article>
		</main>
	</div>
</body>
</html>