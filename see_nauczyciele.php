<?php

session_start();
require_once 'database.php';

if(!isset($_SESSION['logged_id_admin']))
{
	if(isset($_POST['login']))
	{
		$login = filter_input(INPUT_POST, 'login');
		$password = filter_input(INPUT_POST, 'pass');
	    echo $login . " " .$password;
    			
		$userQuery = $db->prepare('SELECT id, haslo FROM admin WHERE login = :login');
		$userQuery->bindValue(':login', $login, PDO::PARAM_STR);
		$userQuery->execute();
		
		$user = $userQuery->fetch();
		
		echo $user['id'] . " " . $user['haslo'];
		
		if($user)/* && password_verify($password, $user['haslo']))*/
		{
			$_SESSION['logged_id_admin'] = $user['id'];
			$_SESSION['actual_user'] = 'admin';
			UNSET($_SESSION['bad_attempt']);
		}
		else
		{
			isset($_SESSION['bad_attempt']);
			header('Location: admin.php'); 
			exit();
		}
	}
	else
	{
		
        isset($_SESSION['bad_attempt']);
		header('Location: admin.php'); 
		exit();
	}	
} 

$userssQuery = $db->query('SELECT * FROM nauczyciele');
$users = $userssQuery->fetchAll();	

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
					<tr><th colspan="5">Łącznie rekordów: <?= $userssQuery->rowCount() ?></th></tr>
					<tr><th>ID</th><th>Imie</th><th>Nazwisko</th><th>Edytuj</th><th>Usuń</th></tr>
				</thead>
					<tbody>
						<?php
						foreach ($users as $user) {
							echo "<tr>
									<td>{$user['id']}</td>
									<td>{$user['Imie']}</td>
									<td>{$user['Nazwisko']}</td>
									<td><a href=\"edit_nauczyciele.php?id={$user['id']}&table=nauczyciele\"> Edytuj</a></td>
									<td><a href=\"delete.php?id={$user['id']}&table=nauczyciele\">Usuń</a></td>
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