<?php

session_start();
if($_GET['user'] == 'admin')
{
	unset($_SESSION['logged_id_admin']);
	header('Location: admin.php');
	exit();
}
if($_GET['user'] == 'nauczyciel')
{
	unset($_SESSION['logged_id_nauczyciel']);
	header('Location: logowanie.php');
	exit();
}
if($_GET['user'] == 'uczen')
{
	unset($_SESSION['logged_id_uczen']);
	header('Location: logowanie.php');
	exit();
}



