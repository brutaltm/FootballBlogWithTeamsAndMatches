<?php
session_start();
if (!($_POST["nick"]==="" || $_POST["haslo"]==="" || $_POST["email"]==="")) {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "projektdb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		//die("Connection failed: " . $conn->connect_error);
		header("Location: index.php?#conn_err");
	}
	else {
	$sql = "SET NAMES 'UTF8'";
	$conn->query($sql);
	//$haslo = password_hash($_POST["haslo"], PASSWORD_DEFAULT);
	}
	// SPRAWDZENIE
	$sql = "SELECT nick FROM Users WHERE nick = '{$_POST["nick"]}'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$conn->close();
		header("Location: index.php?#nick_taken");
	}
	else {
		$sql = "SELECT email FROM Users WHERE email = '{$_POST["email"]}'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$conn->close();
			header("Location: index.php?#email_taken");
		}
		else {
			$nick = $_POST["nick"];
			$email = $_POST["email"];
			$haslo = password_hash($_POST["haslo"], PASSWORD_DEFAULT);
			$typ = "user";
			$sql = "INSERT INTO USERS (nick, email, haslo, typ) VALUES ('$nick','$email','$haslo','$typ')";
			if ($conn->query($sql) === TRUE)
				$_SESSION["nick"] = $nick;
				$_SESSION["typ"] = $typ;
				$sql = "SELECT id FROM users WHERE nick = '{$_SESSION["nick"]}'";
				$result = $conn->query($sql);
				if (result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) 
						$id = $row["id"];
					$_SESSION["id"] = $id . " ";
					$_SESSION["id"] = trim($_SESSION["id"]);
				}
				$conn->close();
				header("Location: index.php?#reg_success");
			} 
			else {
				$conn->close();
				header("Location: index.php?#reg_error");
			}
		}
	}
}
?>