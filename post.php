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
$sql = "SET NAMES 'UTF8'";
$conn->query($sql);
$sql = "SELECT * FROM posty WHERE id = {$_GET["id"]}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$tytul = $row["tytul"];
		$tresc = $row["tresc"];
		$data = $row["data"];
		$userid = $row["userid"];
		$idKategorii = $row["idKategorii"];
	}
} else {
	echo "Brak posta o danym id";
	header("Location: index.php");
}
$sql = "SELECT * FROM Kategorie WHERE id = $idKategorii";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$nazwaKategorii = $row["nazwa"];
	}
}
else {
	echo "Nie znaleziono pasującej kategorii";
}

$uprawnienia = false;

if (isset($_SESSION["nick"])) {
	$sql = "SELECT id, nick FROM users WHERE nick = '{$_SESSION["nick"]}'";
	$result = $conn->query($sql);
	$sessionid = "";
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sessionid = $row["id"];
		}
	}
	
	if ($userid == $sessionid || $_SESSION["typ"] == "admin") 
		$uprawnienia = true;
}	
?>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="styles.css">
        <title><?php echo $tytul ?></title>
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
						$("#tytulPosta").attr("contenteditable","false");
						$("#tytulPosta").css("background-color","inherit");
						$("#tytulPosta").css("border","0");
						$("#tytulPosta").css("width","100%");
						
					}
					else {
						//$("#hiddentytul").val($("#tytulPosta").text());
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
						//$("#hiddentresc").val($("#trescPosta").text());
						$("#trescPosta").attr("contenteditable","true");
						$("#trescPosta").css("background-color","rgb(10,80,150)");
						$("#trescPosta").css("border","1px solid black");
					}
					//$("#trescPostaedycja").toggle();
					$("#submit").toggle();
					$("#kategoriaselect").toggle();
					$("#kategoria").toggle();
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
				var a = document.getElementById("tytulPosta").innerHTML;
				var b = document.getElementById("trescPosta").innerHTML;
				a = a.replace(/&lt;br&gt;/gi,'<br>');
				document.getElementById("tytulPosta").innerHTML = a;
				b = b.replace(/&lt;br&gt;/gi,'<br>');
				document.getElementById("trescPosta").innerHTML = b;
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
	$czyUstawioneID = false;
	$j=1;
	if (isset($_GET["id"]))
		$czyUstawioneID = true;
    echo "<div id='divMenu'><nav id='navMenu'><ul id='ulMenu'><li><a ";
	if (!$czyUstawioneID)
		echo "class='menuaktywny' ";
	echo "href='index.php'>Aktualności</a></li>";
    while($row = $result->fetch_assoc()) {
		echo "<li><a ";
		if ($czyUstawioneID && $idKategorii==$j)
			echo "class='menuaktywny' ";
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
			echo '<form id="edycja" action="editPost.php" method="post" enctype="multipart/form-data">' .
			'<p style="display:none;" id="kategoriaselect" class="nick"><select name="kategoria">';
			$result->data_seek(0);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { 
					echo '<option ';
					if($idKategorii==$row["id"])
						echo "selected "; 
					echo 'value="' . $row["id"] . '">' . $row["nazwa"] . '</option>';
				}
				echo '</select></p>';
			}
		}
?>
		<p id="kategoria" class="nick"><?php echo $nazwaKategorii ?></p>
		
		<p class="data"><?php echo date("d F Y - H:i", strtotime($data))?>
		<?php 
		if ($uprawnienia)
			echo "<a id='edytujPosta' style='cursor: pointer;'><img src='edit.png' style='width:15px;height:15px;'> </a><a href='deletePost.php?id=" . $_GET["id"] . "'><img src='delete.png'></a>";
		?>
		</p><br><br>
		<?php
			echo '<div style="width:100%;"><h1 style="display: block;text-align: center;" id="tytulPostah1">
			<span style="display: block;" id="tytulPosta">' . $tytul . '</span></h1></div>';
		
		//str_replace("&lt;" . "br" . "&gt;","<br>",$tytul)
		?>
		<article>
			<?php 
			$obrazeksrc = "'" . $_GET["id"] . ".jpg'";
			echo "<a href=" . $obrazeksrc . ">" . "<img style='border: 1px solid black;' class='obrazek' src=" . $obrazeksrc . " alt='" . $tytul .
				 "' width='100%'></a>"; 
			if ($uprawnienia == true)
				echo "<div style='display:none;' id='zdjeciein'>Zdjęcie: <input type='file' name='zdjecie' style='width: 100%;'><br></div>";
			echo 
			'<p id="trescPosta">' . $tresc . '</p>';
			//str_replace("&lt;" . "br" . "&gt;","<br>",$tresc)
			if ($uprawnienia == true) {
				echo 
				'<input id="hiddentytul" type="hidden" name="tytul">' . // value="' . $tytul . '">' . 
				'<input id="hiddentresc" type="hidden" name="tresc">' . // value="' . $tresc . '">' . 
				'<input type="hidden" name="id" value="' . $_GET["id"] . '">' . 
				'<input id="submit" type="submit" value="Potwierdź" style="display:none;">
				</form>';
			}
			?>
			<span style="float: right;"><?php 
			$sql = "SELECT nick FROM users WHERE id = " . $userid;
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo $row["nick"];
				}
			}?>
			</span><br>
		</article>
	</div>
	<br><br><div style="background: linear-gradient(30deg,rgb(8,44,80),rgb(10,80,150),rgb(10,80,150),rgb(8,44,80));width: 250px; height: 65px; margin: 0 auto; border: 1px solid white; border-radius: 50px;"><h1 style="text-align: center; font-size: 225%;">Komentarze:</h2></div>
	
	<div id="formularz">
	<?php if (isset($_SESSION["nick"])) {
		echo 
		"<form action='insert.php' method='post'><br>" .
			"<div class='kom'><div class='gora'><p class='nick'>" . $_SESSION["nick"] . "</p>" .
			"</div><p class='komentarz'>" .
			"<textarea style='width: 98.5%; max-width: 1008px;' name='komentarz' rows='2' cols='100' placeholder='Komentarz' required></textarea>" .
			"<input type='hidden' name='id' value='" . $_GET["id"] . "'>" . 
			"<input type='submit' value='Dodaj'>" .
			"</p></div><br>" . 
		"</form>";
	}
	else {
		echo "<div style='width: 100%; max-width: 1008px; margin: 0 auto;'><p text-align: center;>Aby dodawać komentarze, musisz być zalogowany.</p></div>";
	}?>
	</div>
<?php
$sql = "SELECT k.id, k.idPosta, k.userid, k.tresc, k.data, u.nick FROM komentarze k, users u " .
	   "WHERE k.idPosta = {$_GET["id"]} AND k.userid = u.id ORDER BY k.data DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
	if (isset($_SESSION["nick"])) { 
		while($row = $result->fetch_assoc()) {
			echo "<div class='kom'><div class='gora'><p class='nick'>" . $row["nick"]. "</p>" .
				 "<p class='data'>" . date("d F Y - H:i", strtotime($row["data"]));
			if ($row["userid"] == $sessionid || $_SESSION["typ"] == "admin") {
				echo " <a href='delete.php?id=" . $row["id"] . 
					 "'><img src='delete.png'> </a>";
			}
			echo "</p></div><p class='komentarz'>" . $row["tresc"] . "</p></div>";
		}
	}
	else {
		while($row = $result->fetch_assoc()) {
			echo "<div class='kom'><div class='gora'><p class='nick'>" . $row["nick"]. "</p>" .
				 "<p class='data'>" . date("d F Y - H:i", strtotime($row["data"])) .
				 "</p></div><p class='komentarz'>" . $row["tresc"] . "</p></div>";
				 
		}
	}
} else {
    //echo "Nie ma jeszcze komentarzy";
}
$conn->close();
?>
<br><br><br>
<br><br>
<footer>
<a>Bartosz Ruta - Projekt Podstawy Technologii WWW</a>
</footer>
</body>
</html>