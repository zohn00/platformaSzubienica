<?php
session_start();

if((isset($_SESSION['czy_zalogowany']))&&($_SESSION['czy_zalogowany']==true))
{	header('Location:gra_zalogowany.php');
exit();
}
if(isset($_POST['mail'])){
	
$udana_rejestracja=true;


		$login=$_POST['login'];
		if((strlen($login)<3) || (strlen($login)>20))
		{
			$_SESSION['e_login']="login musi zawierać od 4 do 20 znaków";
			$udana_rejestracja=false;
		}
		
		if(!ctype_alnum($login)){
			$_SESSION['e_login']="login może składać się tylko ze znaków alfanumerycznych";
			$udana_rejestracja=false;
		}


//Sprawdzamy mail
		$mail=$_POST['mail'];
		$mailB=filter_var($mail,FILTER_SANITIZE_EMAIL);
		if((filter_var($mailB,FILTER_VALIDATE_EMAIL)==false)||($mail!=$mailB))
		{
			$_SESSION['e_mail']="podano nieprawidłowy adres e-mail";
			$udana_rejestracja=false;
		}



		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		if((strlen($haslo1)<6)||(strlen($haslo1)>30))
		{
			$_SESSION['e_haslo']="haslo musi posiadać od 6 do 30 znaków";
			$udana_rejestracja=false;
		}
		if($haslo1!=$haslo2)
		{
			$_SESSION['e_haslo']="podane hasla są różne";
			$udana_rejestracja=false;
		}
		
		
		$haslo_hash=password_hash($haslo1,PASSWORD_DEFAULT);
		

		
		
		if(!isset($_POST['regulamin'])){
			 
			$_SESSION['e_checkbox']="proszę zaakceptować regulamin";
			//$udana_rejestracja=false;
		}
		
		$sekret='6Lceei8UAAAAAAF-EbOGtsfxq-4fTwY2Wb3IV8Hz';
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odp=json_decode($sprawdz);
		if(!($odp->success))
		{
			$_SESSION['e_recaptcha']="potwierdź, że nie jesteś robotem";
			$udana_rejestracja=false;
		}
		
		$_SESSION['l_login']=$login;
		$_SESSION['l_mail']=$mail;
		$_SESSION['l_haslo1']=$haslo1;
		$_SESSION['l_haslo2']=$haslo2;
		if(isset($_POST['regulamin'])) $_SESSION['l_regulamin']=true;
		
		
		
	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	
	try{
		
		$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);
		if($polaczenie->connect_errno!=0){
			throw new Exception(mysqli_connect_errno);
				}else{
					$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$mail'");
					if(!$rezultat) throw new Exception($polaczenie->error);
					$ile_maili=$rezultat->num_rows;
					
					if($ile_maili>1) {
						$_SESSION['e_mail']="podany mail juz istnieje w bazie";
						$udana_rejestracja=false;
					}
					
					$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$login'");
					if(!$rezultat) throw new Exception($polaczenie->error);
					$ile_loginow=$rezultat->num_rows;
					if($ile_loginow>1){
						$_SESSION['e_login']="podany mail jest juz zajety";
						$udana_rejestracja=false;
					}

					if($udana_rejestracja==true)
					{
						if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL, '$login', '$haslo_hash', '$mail',100,100,100,14)"))
							header("Location:gra.php");
						else{ throw new Exception($polaczenie->error);}
					}
					$polaczenie->close();
							}
			}
			catch(Exception $e){
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
				echo "Deweloper inf: ".$e;
			}

			}




?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Szubienica</title>
	


<link rel="stylesheet" href="style.css"/>
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&amp;subset=latin-ext" rel="stylesheet">


<script src='https://www.google.com/recaptcha/api.js'></script>
	
</head>
<body>

<div id="pojemnik">

	<div id="index_powitanie" style="text-align:center;">rejestracja </div>
	
	<form  method="POST">
	<div class="zarejestruj">
	<div class="pole_rejestracji">login: </div>
		<div class="pole_rejestracji_formularze"><input type="text" name="login" value=<?php if(isset($_SESSION['l_login'])){
			echo $_SESSION['l_login'];
		unset($_SESSION['l_login']);}?>></input></div>
		<div style="clear:both;"></div>
		<div class="komunikat"> 
				<?php if(isset($_SESSION['e_login']))
					echo $_SESSION['e_login'];
					unset($_SESSION['e_login']);
				?>
		</div>
	</div>
	
	<div class="zarejestruj">
		<div class="pole_rejestracji">e-mail:</div>
			<div class="pole_rejestracji_formularze"> <input type="text" name="mail" value=<?php if(isset($_SESSION['l_mail'])) 
			{
				echo $_SESSION['l_mail'];
				unset($_SESSION['l_mail']);
			}
			
			
			?>></input></div><div style="clear:both;"></div>
			<div class="komunikat"> 
				<?php if(isset($_SESSION['e_mail']))
					echo $_SESSION['e_mail'];
					unset($_SESSION['e_mail']);
				?>
		</div>
	</div>
	
	<div class="zarejestruj">
		<div class="pole_rejestracji">hasło:</div>
			<div class="pole_rejestracji_formularze"> <input type="password" name="haslo1" value=<?php if(isset($_SESSION['l_haslo1'])) 
			{
				echo $_SESSION['l_haslo1'];
				unset($_SESSION['l_haslo1']);
			}
			
			
			?>></input></div><div style="clear:both;"></div>
			<div class="komunikat"> 
				<?php if(isset($_SESSION['e_haslo']))
					echo $_SESSION['e_haslo'];
					unset($_SESSION['e_haslo']);
				?>
		</div>
	</div>
	
	<div class="zarejestruj">
		<div class="pole_rejestracji">powtórz hasło:</div>
			<div class="pole_rejestracji_formularze"> <input type="password" name="haslo2" value=<?php if(isset($_SESSION['l_haslo2'])) 
			{
				echo $_SESSION['l_haslo2'];
				unset($_SESSION['l_haslo2']);
			}
			
			
			?>></input></div>
			<div style="clear:both;"></div>
	</div>

	
	
	<div class="zarejestruj" style="min-height:60px;">
		<div class="pole_rejestracji"><input type="checkbox" name="regulamin" <?php 
		if(isset($_SESSION['l_regulamin']))
		{
			echo "checked";
			unset($_SESSION['l_regulamin']);
		}
		?>
		
		></input></div>
			<div class="pole_rejestracji_formularze"><span style="font-size:18px;" >
					oświadczam, że akceptuję regulamin, zgadzam się na przetwarzanie moich danych, chcę już grać!</span></div>
			<div style="clear:both;"></div>
			<div class="komunikat"  style="margin-top:58px;"> 
				<?php if(isset($_SESSION['e_checkbox']))
					echo $_SESSION['e_checkbox'];
					unset($_SESSION['e_checkbox']);
				?>
		</div>
	</div>

	
<div class="zarejestruj">
		<div class="pole_rejestracji" style="font-size:22px;">udowodnij, że nie jesteś botem</div>
			<div class="pole_rejestracji_formularze"> <div class="g-recaptcha" data-sitekey="6Lceei8UAAAAACdItfDKqRWpsDrvxfhWP9AwRGOM"></div></div>
			<div style="clear:both;"></div>
			<div class="komunikat"  style="margin-top:15px;"> 
				<?php if(isset($_SESSION['e_recaptcha']))
					echo $_SESSION['e_recaptcha'];
					unset($_SESSION['e_recaptcha']);
				?>
		</div>
	</div>


		<div class="zarejestruj" >
		<div class="pole_rejestracji"></div>
			<div class="pole_rejestracji_formularze"> <input type="submit" value="zarejestruj"></input></div>
			<div style="clear:both;"></div>
	</div>
	
	
	
	
	
	</form>
	
		<div id="wroc" >
		<a class="gra" href="index.php" >wróć</a>
		</div>
	</div>
	

	
</body>
</html>