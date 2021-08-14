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
        die("Connection failed: " . $conn->connect_error);
		
	$sql = "SET NAMES 'UTF8'";
	$conn->query($sql);
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
		$userid = $sessionid;
		$k = $_POST["komentarz"];
		$idP = $_POST["id"];
		$sql = "INSERT INTO komentarze (idPosta, userid, tresc) VALUES ('$idP','$userid','$k')";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	else
	{
		$conn->close();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	$conn->close();
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
?> 


