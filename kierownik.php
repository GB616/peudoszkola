<?php
if($_POST['osoba'] == 'nauczyciel')
{
	echo"baksada";
	header("Location: szkola.php?login={$_POST['login']}&haslo={$_POST['pass']}"); 
}
else if($_POST['osoba'] == 'uczen')
{
	header("Location: uczen.php?login={$_POST['login']}&haslo={$_POST['login']}"); 
}
else
{
	header('Location: logowanie.php'); 
    exit();
}
?>