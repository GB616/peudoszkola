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
	<title> Dodaj naucyciela </title>
	<link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
</head> 
<body>
	<div class="container">
		<header> 
			<h2>Dodaj naucyciela</h2> 
		</header>
		<main>
			<article>
				<form method="post" action="addNdb.php">				
					<label> Imie <input type="text" name="imie"></label>
					<label> Nazwiko <input type="text" name="nazwisko"></label>
					<label> Login <input type="text" name="login"></label>
					<label> Hasło <input type="password" name="haslo"></label>
					<input type="submit" value="wstaw">
				</form>
			</article>
		</main>
	</div>
</body>
</html>