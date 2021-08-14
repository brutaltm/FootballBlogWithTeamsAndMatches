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
			function setEdycjaMeczu() {
				//var tytul, tresc;
				$("#edytujMecz").click(function() {
					if ($(".wynikA").attr("contenteditable")=="true") {
						$(".nazwaligi span").text($( "#ligasel option:selected" ).text());
						$(".stadion span").text($( "#stadionsel option:selected" ).text());
						$("#nazwateamuA span").text($( "#selteamA option:selected" ).text());
						$("#nazwateamuB span").text($( "#selteamB option:selected" ).text());
						$(".datameczu span").text($("input[name=data]").val());
						$("#wynikA").attr("contenteditable","false");
						$("#wynikB").attr("contenteditable","false");
						$(".nazwagraczaA span").attr("contenteditable","false");
						$(".nazwagraczaB span").attr("contenteditable","false");
						$(".nazwagraczakartkiA span").attr("contenteditable","false");
						$(".nazwagraczakartkiB span").attr("contenteditable","false");
						$("#statsyA span").attr("contenteditable","false");
						$("#statsyB span").attr("contenteditable","false");
						$(".nazwagraczaA span").css("background-color","inherit").css("border","0").css("width","100%");
						$(".nazwagraczaB span").css("background-color","inherit").css("border","0").css("width","100%");
						$(".nazwagraczakartkiA span").css("background-color","inherit").css("border","0").css("width","100%");
						$(".nazwagraczakartkiB span").css("background-color","inherit").css("border","0").css("width","100%");
						$("#wynikA").css("background-color","inherit").css("border","0");
						$("#wynikB").css("background-color","inherit").css("border","0");
						$("#statsyA span").css("background-color","inherit").css("border","0");
						$("#statsyB span").css("background-color","inherit").css("border","0");
						//$(".nazwagraczakartkiA").css("background-color","inherit").css("border","0").css("width","100%");
						//$(".nazwagraczakartkiB").css("background-color","inherit").css("border","0").css("width","100%");
					}
					else {
						$("#wynikA").attr("contenteditable","true");
						$("#wynikB").attr("contenteditable","true");
						$(".nazwagraczaA span").attr("contenteditable","true");
						$(".nazwagraczaB span").attr("contenteditable","true");
						$(".nazwagraczakartkiA span").attr("contenteditable","true");
						$(".nazwagraczakartkiB span").attr("contenteditable","true");
						$("#statsyA span").attr("contenteditable","true");
						$("#statsyB span").attr("contenteditable","true");
						$(".nazwagraczaA span").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$(".nazwagraczaB span").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$(".nazwagraczakartkiA span").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$(".nazwagraczakartkiB span").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$("#wynikA").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$("#wynikB").css("background-color","rgb(10,80,150)").css("width","100%").css("border","1px solid black");
						$("#statsyA span").css("background-color","rgb(10,80,150)").css("border","1px solid black");
						$("#statsyB span").css("background-color","rgb(10,80,150)").css("border","1px solid black");
						//$("#tytulPosta").focus();
					}
					$("#submit").toggle();
					$("#ligasel").toggle();
					$("#stadionsel").toggle();
					$("#selteamA").toggle();
					$("#selteamB").toggle();
					$(".datameczu span").toggle();
					$('input[name=data]').toggle();
					$(".nazwaligi span").toggle();
					$(".stadion span").toggle();
					$("#nazwateamuA span").toggle();
					$("#nazwateamuB span").toggle();
				});
				$("#submit").toggle();
				$("#ligasel").toggle();
				$("#stadionsel").toggle();
				$("#selteamA").toggle();
				$("#selteamB").toggle();
				$('input[name=data]').toggle();
			}
		</script>
		<script>
			function startchangeevent() {
				var wynikAE = document.getElementById("wynikA");
				var wynikBE = document.getElementById("wynikB");
				var goleAE = document.getElementById("nazwagraczaAspan");
				var goleBE = document.getElementById("nazwagraczaBspan");
				var kartkiAE = document.getElementById("nazwagraczakartkiAspan");
				var kartkiBE = document.getElementById("nazwagraczakartkiBspan");
				var statsyAE = document.getElementById("statsyAspan");
				var statsyBE = document.getElementById("statsyBspan");
				
				var wynikA = "",wynikB = "",goleA = "",goleB = "",kartkiA = "",kartkiB = "";
				
				statsyA = statsyAE.innerHTML; statsyA = statsyA.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
				$("input[name=statystykiA]").val(statsyA);
				
				statsyB = statsyBE.innerHTML; statsyB = statsyB.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
				$("input[name=statystykiB]").val(statsyB);
					
				wynikAE.addEventListener('input', function(event) {
					wynikA = wynikAE.innerHTML;
					wynikA = wynikA.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=wynikA]").val(wynikA);
				});
				wynikBE.addEventListener('input', function(event) {
					wynikB = wynikBE.innerHTML;
					wynikB = wynikB.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=wynikB]").val(wynikB);
				});
				goleAE.addEventListener('input', function(event) {
					goleA = goleAE.innerHTML;
					goleA = goleA.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=goleA]").val(goleA);
				});
				goleBE.addEventListener('input', function(event) {
					goleB = goleBE.innerHTML;
					goleB = goleB.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=goleB]").val(goleB);
				});
				kartkiAE.addEventListener('input', function(event) {
					kartkiA = kartkiAE.innerHTML;
					kartkiA = kartkiA.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=kartkiA]").val(kartkiA);
				});
				kartkiBE.addEventListener('input', function(event) {
					kartkiB = kartkiBE.innerHTML;
					kartkiB = kartkiB.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=kartkiB]").val(kartkiB);
				});
				statsyAE.addEventListener('input', function(event) {
					statsyA = statsyAE.innerHTML;
					statsyA = statsyA.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=statystykiA]").val(statsyA);
				});
				statsyBE.addEventListener('input', function(event) {
					statsyB = statsyBE.innerHTML;
					statsyB = statsyB.replace(/<div><br>/ig,"<br>").replace(/<\/div>/ig,"").replace(/<div>/ig,"<br>");
					$("input[name=statystykiB]").val(statsyB);
				});
			}
		</script>
		<script>
			$(document).ready(function(){
				$('#selteamA').on('change', function() {
					$('input[name=idA]').val($('#selteamA option:selected').val());
					//var teaminfoa = $('<div>');
					$('#temp').load("teaminfo.php", {id: $('input[name=idA]').val(), id2: $('input[name=idB]').val()},function() {
						$('#logoa').attr('src',$('#temp').find("#logoaa").html());
						$('#ligasel').html($('#temp').find('#ligasel').html());
						$('#stadionsel').html($('#temp').find('#stadionsel').html());		
					});
				});
				$('#selteamB').on('change', function() {
					$('input[name=idB]').val($('#selteamB option:selected').val());
					//var teaminfob = $('<div>');
					$('#temp').load("teaminfo.php", {id: $('input[name=idA]').val(), id2: $('input[name=idB]').val()},function() {
						$('#logob').attr('src',$('#temp').find("#logobb").html());
						$('#ligasel').html($('#temp').find('#ligasel').html());
						$('#stadionsel').html($('#temp').find('#stadionsel').html());						
					});
				});
				
				$('input[name=idA]').val($('#nazwateamuA option:selected').val())
				$('input[name=idB]').val($('#nazwateamuB option:selected').val())
				setPrzycisklog();
				setPrzyciskrej();
				setEdycjaMeczu();
				startchangeevent();
				$("#edytujMecz").click();
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
	echo "<div><div class='mecz'><form id='edycja' action='insertMatch.php' method='post' enctype='multipart/form-data'>" .
				"<table class='meczetabela'>
					<tr>
						<td class='nazwaligi'>
							<select id='ligasel' name='liga'>";
		$sql = "SELECT * FROM druzyny LIMIT 0,2";
		$result = $conn->query($sql);
		$teamy = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$teamy[] = $row["id"];// 0 - 8
				$teamy[] = $row["liga"]; // 1
				$teamy[] = $row["pucharkrajowy"];// 2
				$teamy[] = $row["pucharogolny"];// 3
				$teamy[] = $row["pucharogolny2"];// 4
				$teamy[] = $row["nazwa"];// 5
				$teamy[] = $row["stadion"];// 6
				$teamy[] = $row["logo"]; // 7
			}
			$opcja = 0;
			for ($i=1; $i<5; $i++) {
				if ($teamy[$i]==$teamy[$i+8]) {
					$opcja++;
					echo "<option value='" . $teamy[$i] . "'";
					if ($opcja == 1)
						echo " selected"; 
					echo ">" . $teamy[$i] . "</option>";	
				}
			}//$result->data_seek(0);	
		}
		echo "<option value='Mecz Towarzyski'>Mecz Towarzyski</option></select>" . 
							"<span></span>
						</td>
						<td colspan=3 class='stadion'>" .
							"<select id='stadionsel' name='stadion'>";
		if ($teamy[6] == $teamy[14])
			echo "<option selected value='" . $teamy[6] . "'>" . $teamy[6] . "</option>";
		else {
			echo "<option selected value='" . $teamy[6] . "'>" . $teamy[6] . "</option>" . 
				 "<option value='" . $teamy[14] . "'>" . $teamy[14] . "</option>";
		}
		echo "</select>";
					echo	"<span></span>
						</td>
						<td class='datameczu'>
							<input type='date' name='data'>
							<a id='edytujMecz' style='margin-left:4px;float:right;cursor: pointer;'><img src='edit.png' style='width:15px;height:15px;'> </a>
							<span></span>
						</td>" .
					"<tr style=''>" .
						"<td class='teamalogo' style=''>" .
							"<a style='display:block; width:100%; height:200px;'>
								<img class='logoa' id='logoa' src='" . $teamy[7] . "');
							</a>" .
						"</td>" .
						"<td class='wynikAtd'><span class='wynikA' id='wynikA' style=''></span></td>" .
						"<td class='vs'>-</td>" .
						"<td class='wynikBtd'><span class='wynikB' id='wynikB' style=''></span></td>" .
						"<td class='teamblogo' style=''>" .
							"<a style='display:block; width:100%; height:200px;'>
								<img class='logoa' id='logob' src='" . $teamy[15] . "');
							</a>" .
						"</td>" .
					"</tr>" .
					"<tr>" .
						"<td class='nazwateamu' id='nazwateamuA'><span>" . $row[5] . "</span>";
		$sql = "SELECT id, nazwa FROM druzyny ORDER BY liga";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "<select id='selteamA'>";
			while($row = $result->fetch_assoc()) {
				echo "<option ";
				if ($row["id"] == $teamy[0]) 
					echo "selected ";
				echo "value='" . $row["id"] . "'>" . $row["nazwa"] . "</option>";
			}
			echo "</select>";
		}
		echo			"</td><td>  </td>" .
						"<td></td>" .
						"<td>  </td>" .
						"<td class='nazwateamu' id='nazwateamuB'><span>" . $row[13] . "</span>";
		$result->data_seek(0);
		if ($result->num_rows > 0) {
			echo "<select id='selteamB'>";
			while($row = $result->fetch_assoc()) {
				echo "<option ";
				if ($row["id"] == $teamy[8]) 
					echo "selected ";
				echo "value='" . $row["id"] . "'>" . $row["nazwa"] . "</option>";
			}
			echo "</select>";
		}
		echo		"</td></tr>" . 
					"<tr class='golewmeczu' style='border-top: 0px solid white;'>" .
						"<td colspan=1 class='nazwagraczaA' id='nazwagraczaA'><span id='nazwagraczaAspan'></span></td>
						<td></td>" .
						"<td class='ikonagole'><img class='pilkaikona' src='pilka.png'></td>
						<td></td>" .
						"<td colspan=1 class='nazwagraczaB' id='nazwagraczaB'><span id='nazwagraczaBspan'></span></td>" .
					"</tr>" .
					"<tr class='kartkiwmeczu' style='border-top: 0px solid white;'>" .
						"<td colspan=1 class='nazwagraczakartkiA' id='nazwagraczakartkiA'><span id='nazwagraczakartkiAspan'></span></td><td></td>" .
						"<td class='ikonagole'><img class='pilkaikona' src='redcard2.png'></td><td></td>" .
						"<td colspan=1 class='nazwagraczakartkiB' id='nazwagraczakartkiB'><span id='nazwagraczakartkiBspan'></span></td>" .
					"</tr>" . 
					"<tr>" .
					"<td class='statsy' id='statsyA'><span id='statsyAspan'>5<br>5<br>50%<br>500<br>80%<br>5<br>5<br>0<br>5<br>5</span></td>" .
					"<td class='statsy' colspan=3>Strzały<br>Strzały na bramkę<br>Posiadanie piłki<br>Podania<br>Celność podań<br>Faule<br>" .
						"Żółte kartki<br>Czerwone kartki<br>Spalone<br>Rzuty rożne" .
					"</td>" .
					"<td class='statsy' id='statsyB'><span id='statsyBspan'>5<br>5<br>50%<br>500<br>80%<br>5<br>5<br>0<br>5<br>5</span></td>" .
					"</tr>" .
					"<input type='hidden' name='idA' value='" . $teamy[0] . "'><input type='hidden' name='idB' value='" . $teamy[8] . "'>" .
					"<input type='hidden' name='wynikA'><input type='hidden' name='wynikB'>" .
					"<input type='hidden' name='goleA'><input type='hidden' name='goleB'>" .
					"<input type='hidden' name='kartkiA'><input type='hidden' name='kartkiB'>" . 
					"<input type='hidden' name='statystykiA'><input type='hidden' name='statystykiB'>" .
					"<tr><td colspan=5 style='text-align: right;padding-right: 30px;padding-bottom: 5px;'><input type='submit' id='submit' value='Potwierdź'></td></tr>" .
					"</table></form>" .
					"</div></div><br>";		
	$conn->close();
	?>
				 
<br><br>
<div id='temp' style='display: none;'></div>
<footer>
<a>Bartosz Ruta - Projekt Podstawy Technologii WWW</a>
</footer>
</body>
</html>