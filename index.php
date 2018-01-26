<?php
session_start();
if((isset($_SESSION['czy_zalogowany']))&&($_SESSION['czy_zalogowany']==true))
{	header('Location:gra_zalogowany.php');
exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Szubienica</title>
	


<link rel="stylesheet" href="style.css"/>
<link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nosifer" rel="stylesheet">
<script src="logo.js" type="text/javascript"></script>


	
</head>
<body>

<div id="pojemnik">

	<div id="index_powitanie">Witaj w grze 
    </div>
			<div id="logo">
			    <ul>
			        <li>S</li>
			        <li>Z</li>
			        <li>U</li>
			        <li>B</li>
			        <li>I</li>
			        <li>E</li>
			        <li>N</li>
			        <li>I</li>
			        <li>C</li>
			        <li>A</li> 
			    </ul>
			    
			</div>
	<div id="rejestracja_index">
        Zaloguj się aby rewalizować z innymi graczami! 
        </br></br>
        <form method="POST" action="zaloguj.php">
            login: <input type="text" name="login"></input></br></br>
            haslo: <input type="password" name="haslo"></input></br>
                <div class="komunikat">
                    <?php if(isset($_SESSION['blad_logowania']))
                        echo $_SESSION['blad_logowania'];
                        unset($_SESSION['blad_logowania']);
                    ?>
                </div>
            <input type="submit" value="zaloguj" style="margin-left:120px;"></input></br>
        </form>
        </br></br>a jeżeli nie masz jeszcze konta
            </div>
                <div id="rejestracja_index1">
                lub 
            </div>
	<div id="rejestracja_index1">
	     <a class="gra" href="gra.php">GRAJ JUŻ TERAZ
	     </a>
	</div>
		<div style="clear:both;"></div>
		<div id="menu_g" style="text-align:left;">
		    <div id="rejestracja">
		        <a class="gra" href="zarejestruj.php">ZAREJESTRUJ SIĘ!</a>
		    </div>		
		</div>
</div>
	
</body>
</html>