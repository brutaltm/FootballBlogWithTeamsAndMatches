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
				if (<?php if (isset($_SESSION["nick"])) 
						echo 'true'; 
					else 
						echo 'false'; ?>)
					$("#wrapperPokazwiecej").prepend("<a id='nowypost' href='insertPostForm.php'><span> Utwórz nowy post </span></a>");
				$("#pokazwiecej").click(function(){
					$("#resztatabela").append($('<tbody>').load("zaladujposty.php", {lim1:limit1, lim2:limit2}));
					limit1 = limit1 + limit2;
				});
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
		if ($czyUstawioneID && $_GET["id"]==$j)
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

$sql = "SELECT p.id, p.tytul, k.nazwa, p.data FROM posty p, kategorie k WHERE p.idKategorii = k.id";
if (isset($_GET["id"])) {
	$sql .= " AND p.idKategorii = {$_GET["id"]}";
}
$sql .= " ORDER BY p.data DESC LIMIT 0,5";
$result = $conn->query($sql);
$row_cnt = $result->num_rows;

if ($result->num_rows > 0) {
	$i = 1;
	while ($row = $result->fetch_assoc()) {
		if ($i == 1) {
			echo 
			"<div id='latest'>
				<table id='latesttable'>
					<tr style=''>" .
						"<td rowspan='2' style='width: 66.67%; height: 450px ; background-image: url(" . $row["id"] . ".jpg);'>" .
							"<a style='width: 100%; height: 100%;' 
							href='post.php?id=" . $row["id"] . "'><span style='padding: 0 5px; position: absolute;bottom: 0;font-size: 200%'>" .
								$row["nazwa"] . ": " . $row["tytul"] . "<br><span style='color: white;font-size: 50%;'>" . 
								$row["data"] . "</span></span>" . 
							"</a>" .
						"</td>";
			$i++;
		}
		else if ($i == 2) {
			echo
					    "<td style='width: 33.33%; background-image: url(" . $row["id"] . ".jpg);'>" .
							"<a style='width: 100%; height: 100%;' href='post.php?id=" . $row["id"] . "'><span class='latestspan' style='padding: 0 5px;position: absolute;bottom: 0;font-size: 125%'>" .
								$row["nazwa"] . ": " . $row["tytul"] . "<br><span style='color: white;font-size: 60%;'>" . 
								$row["data"] . "</span></span>" . 
							"</a>" .
						"</td>" .
					"</tr>";
			$i++;
		}
		else if ($i == 3) {
			echo
					"<tr>" .
						"<td style='width: 33.33%; background-image: url(" . $row["id"] . ".jpg);'>" .
							"<a style='width: 100%; height: 100%;' href='post.php?id=" . $row["id"] . "'><span style='padding: 0 5px;position: absolute;bottom: 0;font-size: 125%';>" .
								$row["nazwa"] . ": " . $row["tytul"] . "<br><span style='color: white;font-size: 60%;'>" . 
								$row["data"] . "</span></span>" . 
							"</a>" .
						"</td>" .
					"</tr>" .
				"</table>" .
			"</div>";
			if ($row_cnt==$i) 
				echo "<br><div id='wrapperPokazwiecej'></div>";
			$i++;
		}
		else if ($i == 4) {
			echo 
			"<br><div id='reszta'>" .
				"<table id='resztatabela'>" .
					"<tr>" .
						"<td style='width: 35%;min-width: 200px; height: 150px;border-right: 0;border-bottom: 0;'>" .
							"<a style='display: block; width: 100%; height: 100%;background-image: url(" . $row["id"] . ".jpg);' href='post.php?id=" . $row["id"] . "'>" .
							"</a>" .
						"</td>" .
						"<td style='width: 65%;height: 150px;border-bottom: 0;border-right: 0;'>" .
							"<a style='display: block;width: 100%; height: 100%;' href='post.php?id=" . $row["id"] . "'>" .
								"<span style='width: 85%;font-size: 125%;margin: 0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);'>" . $row["nazwa"] . ": " . $row["tytul"] . "<br><span style='color: white; font-size: 60%;'>" .
								$row["data"] . "</span></span>" .
							"</a>" .
						"</td>" .
					"</tr>";	
			if ($row_cnt==$i) {
				echo "</table><br><div id='wrapperPokazwiecej'>></div></div>";
			}
			$i++;
		}
		else {
			echo 
					"<tr>" .
						"<td style='width: 35%;min-width: 200px; height: 150px;border-right: 0;border-bottom: 0;'>" .
							"<a style='display: block; width: 100%; height: 100%;background-image: url(" . $row["id"] . ".jpg);' href='post.php?id=" . $row["id"] . "'>" .
							"</a>" .
						"</td>" .
						"<td style='width: 65%; height: 150px;border-bottom: 0;border-right: 0;'>" .
							"<a style='display: block;;width: 100%; height: 100%;margin: 0 auto;' href='post.php?id=" . $row["id"] . "'>" .
								"<span style='width: 85%;font-size: 125%;margin: 0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);'>" . $row["nazwa"] . ": " . $row["tytul"] . "<br><span style='color: white; font-size: 60%;'>" .
								$row["data"] . "</span></span></div>" .
							"</a>" .
						"</td>" .
					"</tr>";
			if ($row_cnt==$i && ($i%5)==0) {
				echo "</table><br>" .
				"<div style='width: 100%;'><div id='wrapperPokazwiecej'><a id='pokazwiecej'><span> Pokaz starsze wpisy </span></a></div></div></div>";
			}
			else if ($row_cnt==$i) 
				echo "</table><div id='wrapperPokazwiecej'></div></div>";
			$i++;
		}
	}
} else {
    echo "Brak postów";
}
$conn->close();
?>
<br><br>
<footer>
<a>Bartosz Ruta - Projekt Podstawy Technologii WWW</a>
</footer>
</body>
</html>
