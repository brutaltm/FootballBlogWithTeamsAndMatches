<?php session_start();?>
<!DOCTYPE html>
<html lang="pl">
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$uprawnienia = false;

if (isset($_SESSION["nick"])) {
	$uprawnienia = true;
	$sql = "SELECT id, nick FROM users WHERE nick = '{$_SESSION["nick"]}'";
	$result = $conn->query($sql);
	$sessionid = "";
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sessionid = $row["id"];
		}
	}
		
}
else {
	$conn->close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}
?>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="styles.css">
        <title>Tworzenie nowego posta</title>
		<style>

#formularz {
	margin: 0 auto;
	margin-top: 20px;
	border: 0;
}

#artykul {
	padding: 10px;
	width: 99%;
	max-width: 1008px;
	margin: 0 auto;
	border: 1px solid white;
	//background-color: rgb(10,80,150);
	background: linear-gradient(135deg,rgb(10,80,150),rgb(8,44,80),rgb(10,80,150));
	box-sizing: border-box;
}

.kom {
	width: 100%;
	max-width: 1008px;
	margin: 0 auto;
    margin-top: 0px;
	margin-top: 20px;
	border: 1px solid black;
	overflow: hidden;
	//background-color: rgb(255,150,50);
	//background-color: rgb(75,100,245);
	//background: linear-gradient(0deg,rgb(10,80,150),rgb(8,44,80),rgb(10,80,150));
	background: linear-gradient(0deg,rgb(10,80,150),rgb(8,44,80),rgb(8,44,80));
	box-sizing: border-box;
}

.tytul {
	width: 250px;
	border-radius: 50px;
}

.gora {
	width: 100%;
	height: 30px;
	margin: 0 auto;
	border: 0;
	border-bottom: 1px solid black;
	//background-color: rgb(40,80,255);
	background: linear-gradient(180deg,rgb(10,80,150),rgb(8,44,80));
}

article p {
	font-size: 100%;
	//margin-left: 10px;
	margin-bottom: 10px;
}
	
.nick {
	width: auto;
	font-weight: bold;
	text-align: left;
	float: left;
	margin: 5px;
	height: auto;
	text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
.data {
	width: 55%;
	float: right;
	text-align: right;
	margin: 5px;
	height: auto;
	text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.komentarz {
	float: left;
	width: 100%;
	margin: 5px;
    height: auto;
}
}

.obrazek {
	border: 1px solid black;
}

		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			function setPrzycisklog() {
				$("#przycisklog").click(function(){
					if (!($("#przycisklog").hasClass("active"))) {
						$("#przyciskrej").removeClass("active");
						$("#przycisklog").addClass("active");
						$("#rejestracja").hide();
						$("#logowanie").show();
					}
					else {
						$("#przycisklog").removeClass("active");
						$("#logowanie").toggle();
					}
				});
			}
		</script>
		<script>
			function setPrzyciskrej() {
				$("#przyciskrej").click(function(){
					if (!($("#przyciskrej").hasClass("active"))) {
						$("#przycisklog").removeClass("active");
						$("#przyciskrej").addClass("active");
						$("#logowanie").hide();
						$("#rejestracja").show();
					}
					else {
						$("#przyciskrej").removeClass("active");
						$("#rejestracja").toggle();
					}
				});
			}
		</script>
		<script>
			function setEdycjaPosta() {
				//var tytul, tresc;
				$("#edytujPosta").click(function() {
					if ($("#tytulPosta").attr("contenteditable")=="true") {
						$("#kategoria").text($( "#kategoriasel option:selected" ).text());
						$("#tytulPosta").attr("contenteditable","false");
						$("#tytulPosta").css("background-color","inherit");
						$("#tytulPosta").css("border","0");
						$("#tytulPosta").css("width","100%");
					}
					else {
						$("#tytulPosta").attr("contenteditable","true");
						$("#tytulPosta").css("background-color","rgb(10,80,150)");//"rgb(40,80,255)"
						$("#tytulPosta").css("border","1px solid black");
						$("#tytulPosta").focus();
					}
					if ($("#trescPosta").attr("contenteditable")=="true") {
						$("#trescPosta").attr("contenteditable","false");
						$("#trescPosta").css("background-color","inherit");
						$("#trescPosta").css("border","0");
					}
					else {
						$("#trescPosta").attr("contenteditable","true");
						$("#trescPosta").css("background-color","rgb(10,80,150)");
						$("#trescPosta").css("border","1px solid black");
					}
					$("#submit").toggle();
					$("#kategoriaselect").toggle();
					$("#kategoria").toggle();
					$("#datapost").load("data.php");
					$("#zdjeciein").toggle();
				});
			}
		</script>
		<script>
			function startchangeevent() {
				var tytulEV = document.getElementById("tytulPosta");
				var trescEV = document.getElementById("trescPosta");
				var tytul="",tresc="";
				tytulEV.addEventListener('input', function(event) {
					tytul = tytulEV.innerHTML;
					//if (window.event.keyCode == 13)
						//tytul = tytul.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					document.getElementById("hiddentytul").value = tytul;
				});
				trescEV.addEventListener('input', function(event) {
					tresc = trescEV.innerHTML;
					//if (window.event.keyCode == 13)
						tresc = tresc.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					document.getElementById("hiddentresc").value = tresc;
				});
			}
		</script>
		<script>
			$(document).ready(function(){
				setPrzycisklog();
				setPrzyciskrej();
				setEdycjaPosta();
				//$("#datapost").prepend($("<div>").load("data.php")).html();
				$("#edytujPosta").click();
				$("#hiddentytul").val($("#tytulPosta").html());
				$("#hiddentresc").val($("#trescPosta").html());
				startchangeevent();
				
			});
		</script>
	</head>
<body>
	<header>
	<div id="outer"><br><div id="nazwastrony"><h1>Blog: Piłka Nożna</h1></div></div>
<?php
if (isset($_SESSION["nick"])) {
	echo "<h4>Jesteś zalogowany jako: <i>" . $_SESSION["nick"] . "<br></i>  <a style='float: right;' id='wyloguj' href='wyloguj.php'>Wyloguj</a></h4><br><br><br><br><br><br>";
}
else {
	echo
		'<div id="logrejform"><table class="logrejform" id="header1"><tr><th colspan="2"><span id="logrej"><a id="przycisklog">Logowanie</a> / <a id="przyciskrej">Rejestracja</a></span></th></tr></table>
				<div id="logowanie"><table class="logrejform"><form action="loguj.php" method="post">
					<tr><td><label>Nick:</label></td><td><span><input type="text" minlength="3" name="nick" required></td></tr>
					<tr><td><label>Hasło:</label></td><td><span><input type="password" minlength="5" name="haslo" required></td></tr>
					<tr><td colspan="2"><input type="submit" value="Zaloguj"></td></tr>
				</form></table></div>
				<div id="rejestracja"><table class="logrejform"><form action="zarejestruj.php" method="post">
					<tr><td><label>Email:</label></td><td><span><input type="email" name="email" required></span></td></tr>
					<tr><td><label>Nick:</label></td><td><span><input type="text" minlength="3" name="nick" required></span></td></tr>
					<tr><td><label>Hasło:</label></td><td><span><input type="password" minlength="5" name="haslo" required></td></tr>
					<tr><td colspan="2"><input type="submit" value="Zarejestruj"></td></tr>
				</form></table></div>
		</div><br><br><br><br><br><br>';
}

$sql = "SET NAMES 'UTF8'";
$conn->query($sql);
$sql = "SELECT * FROM kategorie";
$result = $conn->query($sql);
$kategorie = $result;
if ($result->num_rows > 0) {
	$j=1;
    echo "<div id='divMenu'><nav id='navMenu'><ul id='ulMenu'><li><a ";
	echo "href='index.php'>Aktualności</a></li>";
    while($row = $result->fetch_assoc()) {
		echo "<li><a ";
		if ($row["nazwa"]=="Mecze") 
			echo "href='mecze.php'>" . $row["nazwa"] . "</a></li>";
		else
		echo "href='index.php?id=" . $row["id"] . "'>" . $row["nazwa"] . "</a></li>";
		$j++;
    }
	echo "</ul></nav></div></header><br><br>";
} else {
    echo "Brak kategorii</nav></div></header>";
}
	echo '<div id="artykul">';
		if ($uprawnienia == true) {
			echo '<form id="edycja" action="insertPost.php" method="post" enctype="multipart/form-data">' .
			'<p style="display:none;" id="kategoriaselect" class="nick"><select id="kategoriasel" name="kategoria">';
			$result->data_seek(0);
			if ($result->num_rows > 0) {
				$i = 1;
				while($row = $result->fetch_assoc()) { 
					if($i!=8) {
						echo '<option ';
						if($i==1)
							echo "selected "; 
						
						echo 'value="' . $row["id"] . '">' . $row["nazwa"] . '</option>';
						$i++;
					}
				}
				echo '</select></p>';
			}
		}
?>
		<p id="kategoria" class="nick" style=""></p>
		<p class="data">
		<?php 
		if ($uprawnienia)
			echo "<a href='index.php' style='float:right;margin-left:4px;'><img src='delete.png'></a><a id='edytujPosta' style='margin-left:4px;float:right;cursor: pointer;'><img src='edit.png' style='width:15px;height:15px;'> </a>";
		?>
		<span style="display:inline;float:right;margin-top:1px;" id="datapost"></span></p><br><br>
		<?php
			echo '<div style="width:100%;"><h1 style="display: block;text-align: center;" id="tytulPostah1">
			<span style="display: block;" id="tytulPosta">Tytuł twojego posta</span></h1></div>';
		
		//str_replace("&lt;" . "br" . "&gt;","<br>",$tytul)
		?>
		<article>
			<?php 
			echo "<a style='' href=''>" . "<img style='min-height=150px; border: 1px solid black;' class='obrazek' src='placeholder.png' alt='twoje zdjecie' " . 
				 "width='100%' ></a>" . 
				 "<div style='display:none;' id='zdjeciein'>Zdjęcie: <input type='file' name='zdjecie' style='width: 100%;'><br></div>";
			echo 
			'<p id="trescPosta">Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta Treść twojego posta</p>';
			//str_replace("&lt;" . "br" . "&gt;","<br>",$tresc)
			echo 
				'<input id="hiddentytul" type="hidden" name="tytul">' . // value="' . $tytul . '">' . 
				'<input id="hiddentresc" type="hidden" name="tresc">' . // value="' . $tresc . '">' . 
				'<input type="hidden" name="userid" value="' . $sessionid . '">' . 
				'<input id="submit" type="submit" value="Potwierdź" style="display:none;">
				</form>';
			?>
			<span style="float: right;"><?php echo $_SESSION["nick"];?></span><br>
		</article>
	</div>
	<br><br><div style="background: linear-gradient(30deg,rgb(8,44,80),rgb(10,80,150),rgb(10,80,150),rgb(8,44,80));width: 250px; height: 65px; margin: 0 auto; border: 1px solid white; border-radius: 50px;"><h1 style="text-align: center; font-size: 225%;">Komentarze:</h2></div>
	<div class='kom'><div class='gora'><p class='nick'>Przykładowynick</p>
	<p class='data'><?php echo date("d F Y - H:i");?>
	</p></div><p class='komentarz'>Bardzo ciekawy artykuł</p></div>
	
	<div class='kom'><div class='gora'><p class='nick'>Nick2</p>
	<p class='data'><?php echo date("d F Y - H:i");$conn->close();?>
	</p></div><p class='komentarz'>Bla bla bla blabla</p></div>
				 
<br><br><br>
<br><br>
<footer>
<a>Bartosz Ruta - Projekt Podstawy Technologii WWW</a>
</footer>
</body>
</html>