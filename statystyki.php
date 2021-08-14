<?php
//if(isset($_POST["id"]) {
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
	$sql = "SELECT teamastats, teambstats FROM mecze WHERE id = {$_POST["id"]}";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo 
				"" .
					"<td class='statsy' ><span id='statsyAspan'>" . $row["teamastats"] . "</td>" .
					"<td class='statsy' colspan=3>Strzały<br>Strzały na bramkę<br>Posiadanie piłki<br>Podania<br>Celność podań<br>Faule<br>" .
						"Żółte kartki<br>Czerwone kartki<br>Spalone<br>Rzuty rożne" .
					"</td>" .
					"<td class='statsy'><span id='statsyBspan'>" . $row["teambstats"] . "</td>" .
				"";
		}
	}
	$conn->close();
//}
?>