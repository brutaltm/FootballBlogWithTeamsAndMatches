<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projektdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
} 
if (isset($_SESSION["nick"])) {
	$sql = "SELECT id, nick FROM users WHERE nick = '{$_SESSION["nick"]}'";
	$result = $conn->query($sql);
	$sessionid = "";
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sessionid = $row["id"];
		}
	}
	$sql = "SELECT userid, id FROM posty WHERE id = {$_GET["id"]}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$userid = $row["userid"];
		}
		if ($userid==$sessionid || $_SESSION["typ"] == "admin") {
			$sql = "DELETE FROM posty WHERE id=" . $_GET["id"];
			if ($conn->query($sql) === TRUE) {
				echo "Usunieto komentarz";
			} else {
				echo "Błąd usuwania: " . $conn->error;
			}
			$imgname = getcwd() . "/" . $_GET["id"] . '.jpg';
			if(file_exists($imgname)) {
				chmod("$imgname",0755); //Change the file permissions if allowed
				unlink("$imgname"); //remove the file	
			}
			$conn->close();
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}
		else {
			$conn->close();
			echo "Brak uprawnień";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}
	}
	else {
		$conn->close();
		echo 'Brak komentarza o takim ID';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
}
else {
	$conn->close();
	echo "Brak uprawnień";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
}		
	
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>