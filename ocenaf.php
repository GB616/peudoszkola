<?php
	session_start();
	require_once 'database.php';
	
	if(!isset($_SESSION['logged_id_nauczyciel'])){
		header('Location: logowanie.php');
		exit();
	}
	else
	{
		$klasyQuery = $db->query('SELECT * FROM klasy');
        $klasyy = $klasyQuery->fetchAll();
		
		$czy =false;
		
		if(isset($_POST['klasy']))
		{
			$dane = $_POST['klasy'];
									
			$uczniowieQuery = $db->query('SELECT uczniowie.id, uczniowie.Imie, uczniowie.Nazwisko, klasy.Nazwa 
				                          FROM uczniowie LEFT JOIN klasy ON  uczniowie.Klasa = klasy.id 
										  WHERE Klasa =' . $dane . '');
			$uczniowie = $uczniowieQuery->fetchAll();
			$czy = true;
		}							
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Wstawianie ocen</title>
   
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">

    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <header>
            Wstawianie Oceny
        </header>
        <main>
            <article>
                <form method="post" ">
                    <select name="klasy" >
						<option value="0" selected="selected"> Choose</option>
						<?php
							foreach ($klasyy as $klasa) {
								$svalue = $klasa["id"];
								echo "<option value= {$svalue} >{$klasa['Nazwa']} {$klasa['Opis']}  </option>";
							}
						?>
					</select>
					<input type="submit" value="Wybierz">		
					</form>
					<form method="post" action="zapisz_ocene.php">
						<div style=" height: 300px; overflow: scroll;">	
							<table>
								<tbody>
									<thead>
										<tr><th colspan="4">Łącznie rekordów: </th></tr>
										<tr><th>Imie</th><th>Nazwisko</th><th>Wybierz</th></tr>
									</thead>
									<?php		
									if($czy)
									{
										foreach ($uczniowie as $uczen) {
											echo "<tr>
												<td>{$uczen['Imie']}</td>
												<td>{$uczen['Nazwisko']}</td>
												<td><input type=\"radio\" name=\"uczen\" value=\"{$uczen['id']}\">Wybierz<br></td>
											  </tr>";
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<label> Ocena
							<input type="text" name="ocena">
						</label>
						<input type="submit" value="Wpisz">
					</form>
            </article>
        </main>
    </div>
</body>
</html>