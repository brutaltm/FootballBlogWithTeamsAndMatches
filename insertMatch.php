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
	if (empty($_POST["data"]) || empty($_POST["wynikA"]) || empty($_POST["wynikB"]) || empty($_POST["statystykiA"]) || empty($_POST["statystykiB"]) || empty($_POST["idB"])
		|| empty($_POST["idA"])){
		$conn->close();
		echo "Puste";
		exit;
	}		
	if (!(isset($_SESSION["nick"]) && isset($_SESSION["id"]) && isset($_SESSION["typ"]))) {
		echo "Brak uprawnień";
		$conn->close();
		exit;
	}
	$goleA = htmlspecialchars($_POST["goleA"], ENT_QUOTES);
	$goleB = htmlspecialchars($_POST["goleB"], ENT_QUOTES);
	$kartkiA = htmlspecialchars($_POST["kartkiA"], ENT_QUOTES);
	$kartkiB = htmlspecialchars($_POST["kartkiB"], ENT_QUOTES);
	$statsyA = htmlspecialchars($_POST["statystykiA"], ENT_QUOTES);
	$statsyB = htmlspecialchars($_POST["statystykiB"], ENT_QUOTES);
	
	$sql = "SET NAMES 'UTF8'";
	$conn->query($sql);
    $sql = "INSERT INTO mecze (data, stadion, liga, teamaid, teambid, wynikteama, wynikteamb, goleteama, 
	goleteamb, redcardsteama, redcardsteamb, teamastats, teambstats) VALUES ('{$_POST["data"]}', '{$_POST["stadion"]}', '{$_POST["liga"]}', 
	'{$_POST["idA"]}', '{$_POST["idB"]}', '{$_POST["wynikA"]}', '{$_POST["wynikB"]}', '{$goleA}', '{$goleB}', 
	'{$kartkiA}', '{$kartkiB}', '{$statsyA}', '{$statsyB}')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
		$conn->close();
		exit;
    }
	$conn->close();
	header("Location: insertPostForm.php");
?> 