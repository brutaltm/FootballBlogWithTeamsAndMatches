<?php session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="styles.css">
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
			//function setPokazMecz() {
					//$(".mecz").hover(function() {
						//$(".wynikA").show();
						//$(".wynikB").show();
						//$(".golewmeczu").show();
						//$(".kartkiwmeczu").show();
					//	},function() {
						//$(".wynikA").hide();
						//$(".wynikB").hide();
						//$(".golewmeczu").hide();
						//$(".kartkiwmeczu").hide();
					//	});
			//}
		</script>
		<script>
			function załadujStatsy() {
				var tr1 = document.createElement('TR');
				$(this).find('.meczetabela').append($(tr1).load("statystyki.php", {id: $(this).data("id")}));
				$(".wynikA").show();
				$(".wynikB").show();
				$(this).one("click",usun);
			}
		</script>
		<script>
			function usun() {
				$(this).find('.meczetabela tr').last().remove();
				$(this).one("click", załadujStatsy);
			}
		</script>
		<script>
			function setPokazWiecej() {
				$("#pokazwiecej").click(function(){
					$("#resztatabela").append($(('<tbody>').load("zaladujposty.php", {lim1:limit1, lim2:limit2})).html());
					limit1 = limit1 + 5;
					limit2 = limit2 + 5;
					//$(this).click(function() {
					//	setPokazWiecej;
					//});
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
			$(document).ready(function(){
				var limit1 = 5;
				var limit2 = 5;
				setPrzycisklog();
				setPrzyciskrej();
				if ($("#przycisklog").hasClass("active")) {
					$("#rejestracja").hide();
					$("#logowanie").show();
				}
				else if ($("#przyciskrej").hasClass("active")) {
					$("#logowanie").hide();
					$("#rejestracja").show();
				}
				else {
					$("#logowanie").hide();
					$("#rejestracja").hide();
				}
					limit1 = limit1 + 5;
					//$(this).click(function() {
					//	setPokazWiecej;
					//});
				//setPokazMecz();
				$(".mecz").one('click',załadujStatsy);
			});
		</script>
		<script>
			$(document).ready(function(){
				var hash = window.location.hash;
				if (hash == "#bad_login")
					$("#logowanie").append("Błędne dane");
				else if (hash == "#conn_err")
					$("#logowanie").append("Błąd połączenia");
			});
		</script>
        <title>Blog: Piłka Nożna</title>
		<style>
			
		</style>
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

if ($result->num_rows > 0) {
    echo "<div id='divMenu'><nav id='navMenu'><ul id='ulMenu'><li><a ";
	echo "href='index.php'>Aktualności</a></li>";
    while($row = $result->fetch_assoc()) {
		echo "<li><a ";
		if ($row["nazwa"]=="Mecze") {
			echo "class='menuaktywny' href='mecze.php'>" . $row["nazwa"] . "</a></li>";
		}
		else
			echo "href='index.php?id=" . $row["id"] . "'>" . $row["nazwa"] . "</a></li>";
    }
	echo "</ul></nav></div></header><br><br>";
} else {
    echo "Brak kategorii</nav></div></header>";
}

$sql = "SELECT id, data, stadion, liga, teamalogo, teamblogo, wynikteama, wynikteamb, redcardsteama, redcardsteamb, goleteama, goleteamb, teama, teamb FROM mecze";
$sql .= " ORDER BY data DESC LIMIT 0,5";
$result = $conn->query($sql);
$row_cnt = $result->num_rows;

if ($result->num_rows > 0) {
	$i = 1;
	while ($row = $result->fetch_assoc()) {
			echo 
			
			"<div><div class='mecz' data-id=" . $row["id"] . ">" .
				"<table class='meczetabela'>
					<tr>
						<td class='nazwaligi'>
							<span >" . $row["liga"] . "</span>
						</td>
						<td colspan=3 class='stadion'>
							<span >" . $row["stadion"] . "</span>
						</td>
						<td class='datameczu'><span>" . date("d/m/Y", strtotime($row["data"])) . "</span></td>" .
					"<tr style=''>" .
						"<td class='teamalogo' style=''>" .
							"<a style='display:block; width:100%; height:200px;'>
								<img class='logoa' src='" . $row["teamalogo"] . "');
							</a>" .
						"</td>" .
						"<td class='wynikAtd'><span class='wynikA' style=''>" . $row["wynikteama"] . "</span></td>" .
						"<td class='vs'>-</td>" .
						"<td class='wynikBtd'><span class='wynikB' style=''>" . $row["wynikteamb"] . "</span></td>" .
						"<td class='teamblogo' style=''>" .
							"<a style='display:block; width:100%; height:200px;'>
								<img class='logoa' src='" . $row["teamblogo"] . "');
							</a>" .
						"</td>" .
					"</tr>" .
					"<tr>" .
						"<td class='nazwateamu'>" . $row["teama"] . "</td>" .
						"<td></td>" .
						"<td></td>" .
						"<td></td>" .
						"<td class='nazwateamu'>" . $row["teamb"] . "</td>" .
					"</tr>";
					if ($row["goleteama"]!="" || $row["goleteamb"]!="") {
						echo 
							 "<tr class='golewmeczu' style='border-top: 0px solid white;'>" .
								"<td colspan=1 class='nazwagraczaA'>" . $row["goleteama"] . "</td><td></td>" .
								"<td class='ikonagole'><img class='pilkaikona' src='pilka.png'></td><td></td>" .
								"<td colspan=1 class='nazwagraczaB'>" . $row["goleteamb"] . "</td>" .
							 "</tr>";
					}
					if ($row["redcardsteama"]!="" || $row["redcardsteamb"]!="") {
						echo 
							 "<tr class='kartkiwmeczu' style='border-top: 0px solid white;'>" .
								"<td colspan=1 class='nazwagraczakartkiA'>" . $row["redcardsteama"] . "</td><td></td>" .
								"<td class='ikonagole'><img class='pilkaikona' src='redcard2.png'></td><td></td>" .
								"<td colspan=1 class='nazwagraczakartkiB'>" . $row["redcardsteamb"] . "</td>" .
							 "</tr>";
					}
					
				echo "</table>" .
					"</div></div><br>";				
	}
} else {
    echo "Brak meczów";
}
if (isset($_SESSION["nick"])) {
	echo "<br><div id='wrapperPokazwiecej'><a id='nowypost' href='insertMatchForm.php'><span>Dodaj nowy mecz</span></a></div>";
}
$conn->close();
?>

<br><br>
<footer>
<a>Bartosz Ruta - Projekt Podstawy Technologii WWW</a>
</footer>
</body>
</html>