<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Szubienica</title>
	

</script>
<link rel="stylesheet" href="style.css"/>
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&amp;subset=latin-ext" rel="stylesheet">


</script>
	
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


?>
 
<div id="pojemnik">
<input type="hidden" id="field" value="<?php echo $losowehaslo; ?>">
	
	<div id="menu_g">
		<div class="menu1"><a class="gra" href="index.php">zaloguj się!</a></div>
		<div class="menu1"><a class="gra" href="zarejestruj.php">Zarejestruj się!</a></div>
		<div style="clear:both;"></div>
	</div>
	<div id="plansza"></div>
	<div id="szubienica"><img src="img/s0.jpg" alt="szubienica"/> </div>
	<div id="alfabet"></div>
	<div style="clear:both;"></div>

</div>
<script src="jquery-3.2.1.min.js"></script>	
<script type="text/javascript" src="szubienica.js"></script>	
</body>
</html>