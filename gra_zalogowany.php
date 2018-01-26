<?php
session_start();
if(!isset($_SESSION['czy_zalogowany']))
{header('Location:index.php');
	exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Szubienica</title>
	
<script src="jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="style.css"/>
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&amp;subset=latin-ext" rel="stylesheet">


</head>
<body>
<?php 
require_once "connect.php";



$polaczenie=new mysqli($host,$db_user,$db_password,$db_name1);
$polaczenie->query("SET NAMES 'UTF8'");
$rezultat=$polaczenie->query("SELECT * FROM hasla ORDER BY RAND() LIMIT 1");

$wiersz=$rezultat->fetch_assoc();
$haslo=$wiersz['haslo'];
$losowehaslo=$haslo;
$polaczenie->close();

?>
<div id="pojemnik">

	<div id="menu_g">
	<div id="wynik" >
			<input type="hidden" id="field" value="<?php echo $losowehaslo; ?>">

			<div class="sekcja">
				<?php 

				echo $_SESSION['login'];?>
			</div>
			<div class="sekcja">
				 <?php
				$login=$_SESSION['login'];
$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);

$rezultat=$polaczenie->query("SELECT * FROM uzytkownicy WHERE user='$login' ");

$wiersz=$rezultat->fetch_assoc();
$wynik=$wiersz['punkty'];

$polaczenie->close();
echo "wynik ".$wynik;
				 ?>
			</div>
			<div class="logout">
				<a href="logout.php">wyloguj się</a>
			</div>
			<div style="clear:both;">
			</div>
		

	</div>
	</div>
	<div id="plansza"></div>
	<div id="szubienica"><img src="img/s0.jpg" alt="szubienica"/> </div>

	<div id="alfabet"></div>
	<div style="clear:both;"></div>

</div>

	<script type="text/javascript" src="szubienica.js"></script>

</body>
</html>