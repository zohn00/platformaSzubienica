
var h1=$('#field').val();


//var haslo=h1;
var haslo=h1;


haslo=haslo.toUpperCase();
var haslo1="";
var ile=0;
var dlugosc=haslo.length;
var yes=new Audio("m/yes.wav");
var no=new Audio("m/no.wav");
var win=new Audio("m/win.mp3");
var lose=new Audio("m/lose.mp3");
for(i=0;i<dlugosc;i++)
{ 
	if(haslo.charAt(i)==" "){haslo1=haslo1+" ";}
	else{haslo1=haslo1+"-";}
}
function wypiszhaslo()
{	
	
	document.getElementById("plansza").innerHTML=haslo1;
}

window.onload=start;

var litery= new Array(35);
litery[0] = "A";
litery[1] = "Ą";
litery[2] = "B";
litery[3] = "C";
litery[4] = "Ć";
litery[5] = "D";
litery[6] = "E";
litery[7] = "Ę";
litery[8] = "F";
litery[9] = "G";
litery[10] = "H";
litery[11] = "I";
litery[12] = "J";
litery[13] = "K";
litery[14] = "L";
litery[15] = "Ł";
litery[16] = "M";
litery[17] = "N";
litery[18] = "Ń";
litery[19] = "O";
litery[20] = "Ó";
litery[21] = "P";
litery[22] = "Q";
litery[23] = "R";
litery[24] = "S";
litery[25] = "Ś";
litery[26] = "T";
litery[27] = "U";
litery[28] = "V";
litery[29] = "W";
litery[30] = "X";
litery[31] = "Y";
litery[32] = "Z";
litery[33] = "Ż";
litery[34] = "Ź";

document.onkeyup=function(event){
	var key_press=String.fromCharCode(event.keyCode);
	var key_code=event.keyCode;
	for(k=0;k<35;k++)
	{
		if(litery[k]==key_press)
		{sprawdz(k);}
	}
}

function start()
{
	var tresc_diva="";
	
	for(i=0;i<35;i++)
	{ 	var element="lit"+i;
		tresc_diva=tresc_diva+'<div onclick="sprawdz('+i+')" class="litera" id="'+element+'">'+litery[i]+'</div>';
		if((i+1)%7==0){tresc_diva=tresc_diva+'<div style="clear:both;"></div>';	
		}
	}
	document.getElementById("alfabet").innerHTML=tresc_diva;
		
	wypiszhaslo();
}

String.prototype.ustawZnak=function(miejsce,znak)
{
	if(miejsce>this.lenght-1) return this.toString();
	else return this.substr(0,miejsce)+znak+this.substr(miejsce+1);
	
}





var wynik_gry=90;

function sprawdz(nr)
{ 

	var trafiona=false;
	for(i=0;i<dlugosc;i++)
	{
		if(haslo.charAt(i)==litery[nr])
		{
			haslo1=haslo1.ustawZnak(i,litery[nr]);
			trafiona=true;
		}
		
	}
	if(trafiona==true)
		{	yes.play();
		var element="lit"+nr;
		document.getElementById(element).style.background="#003300";
		document.getElementById(element).style.color="#93f788";
		document.getElementById(element).style.border="3px solid #93f788";
		document.getElementById(element).style.cursor="default";
		
		wypiszhaslo();}
		else{ wynik_gry=wynik_gry-10;
			no.play();
			var element="lit"+nr;
		document.getElementById(element).style.background="#5e0b16";
		document.getElementById(element).style.color="#db253d";
		document.getElementById(element).style.border="3px solid #db253d";
		document.getElementById(element).style.cursor="default";
		document.getElementById(element).setAttribute("onclick",";");
		
		ile++;
		var obraz="img/s"+ile+".jpg";
		document.getElementById("szubienica").innerHTML='<img src="'+obraz+'" alt="" />' 
		
		}
		
		if(haslo==haslo1)
		{	
			$.ajax({	
	url:'../gra/loader.php',
	type:'post',
	data:{Zmienna: wynik_gry},
	
	
});
			win.play();
			document.getElementById("alfabet").innerHTML="BRAWO! WYGRAŁEŚ!</br></br> Prawidłowe hasło to: "+haslo+'</br></br> <span class="reset" onclick="location.reload()"  style="cursor:pointer; color:green;" >Jeszcze raz?</span>';}
		    
		
		if (ile>8)
			{lose.play();
				document.getElementById("alfabet").innerHTML="Niestety przegrałeś!</br></br> Prawidłowe hasło to: "+haslo+' </br></br> <span class="reset" onclick="location.reload()"  style="cursor:pointer; color:red;">Jeszcze raz?</span>';}
	litery[nr]=litery[nr]+litery[nr];

}
















