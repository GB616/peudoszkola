<?php
	session_start();
	
	if(isset($_SESSION['logged_id_admin'])){
		
		header('Location: see_nauczyciele.php');
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
	<div class="container">
		<header> 
			<h2>Dyrektor</h2> 
		</header>
		<main>
			<article>
				<form method="post" action="see_nauczyciele.php">
					<label> Login <input type="text" name="login"></label>
					<label> Hasło <input type="password" name="pass"></label>
					<input type="submit" value="zaloguj">
					<?php					
					if (isset($_SESSION['bad_attempt'])) {
						
						echo "<p> Niepoprawny login lub hasło </p>";
						
						unset($_SESSION['bad_attempt']);
					}
					?>
				</form>
				
			</article>
		</main>
	</div>
</body>
</html>