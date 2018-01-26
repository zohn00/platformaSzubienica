<?php



session_start();


require_once "connect.php";

//sposób raportowania błędów
mysqli_report(MYSQLI_REPORT_STRICT);

try{ 
$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0)
	{throw new Exception(mysqli_connect_errno());}
	else{
		
		
		$login=$_POST['login'];
		$haslo=$_POST['haslo'];
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		
		
		$rezultat=$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",mysqli_real_escape_string($polaczenie,$login)));
		$ile_userow=$rezultat->num_rows;
		$wiersz=$rezultat->fetch_assoc();
		if($ile_userow>0 &&(password_verify($haslo,$wiersz['pass']))){
		
		
		$_SESSION['czy_zalogowany']=true;
		$_SESSION['login']=$wiersz['user'];
		$_SESSION['punkty']=$wiersz['punkty'];
		$_SESSION['dnipremium']=$wiersz['dnipremium'];
		
		
		header('Location:gra_zalogowany.php');
		
		$rezultat->free_result();
		
		}else{
			$_SESSION['blad_logowania']='Podano nieprawidłowy login lub hasło</br>';
			header('Location:index.php');
		}
		
		
		$polaczenie->close();
	}

	
	
	
}catch(Exception $e)
{
	echo 'nie udalo sie '.$e;
	
}



?>



