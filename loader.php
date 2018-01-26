<?php

//zeobić sprawdzanie czy zalogowany
	session_start();
	if((isset($_SESSION['czy_zalogowany']))&&($_SESSION['czy_zalogowany']==true)&&isset($_POST['Zmienna']))
{	
	
	$user=$_SESSION['login'];
	$wynik=$_POST['Zmienna'];
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);

	$rezultat=$polaczenie->query("UPDATE  uzytkownicy SET punkty=(punkty+$wynik) WHERE user='$user' ");


	$polaczenie->close();
	





	}else{ 
	header('Location:index.php');
	}



?>