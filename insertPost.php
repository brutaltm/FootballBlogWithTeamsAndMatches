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
    }
	if (empty($_POST["tytul"]) || empty($_POST["tresc"]) || empty($_POST["kategoria"])){
		$conn->close();
		header("Location: insertPostForm.php");
		exit;
	}		
	if (!(isset($_SESSION["nick"]) && isset($_SESSION["id"]) && isset($_SESSION["typ"]))) {
		echo "Brak uprawnień";
		$conn->close();
		exit;
	}
	$tytul = htmlspecialchars($_POST["tytul"], ENT_QUOTES);
	$tresc = htmlspecialchars($_POST["tresc"], ENT_QUOTES);
	$idK = $_POST["kategoria"];
	
	$sql = "SET NAMES 'UTF8'";
	$conn->query($sql);
    $sql = "INSERT INTO posty (tytul, tresc, idKategorii, userid) VALUES ('$tytul','$tresc','$idK','{$_SESSION["id"]}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
		$conn->close();
		exit;
    }
	
	$sql = "SELECT id FROM posty WHERE id=(SELECT max(id) FROM posty)";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {
		$idn = $row["id"];
	}
	$target_dir = "";
	$target_file = $target_dir . basename($_FILES["zdjecie"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["zdjecie"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	
	// Check if file already exists
	if (file_exists($idn . ".jpg")) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	
	if($imageFileType != "jpg") {
		echo "Sorry, only JPG files are allowed.";
		$uploadOk = 0;	
	}
	if ($uploadOk == 0) {
		echo "Plik nie spełnia wymagań";
		$conn->close();
		exit;
	} else {
		if (move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $idn . ".jpg")) {
			echo "Plik ". basename( $_FILES["zdjecie"]["name"]). " został wysłany.";
			$conn->close();
			header('Location: ' . 'post.php' . '?id=' . $idn);
			exit;
		} else {
			echo "Błąd wysyłania pliku.";
			$conn->close();
			exit;
		}
	}
	$conn->close();
?> 