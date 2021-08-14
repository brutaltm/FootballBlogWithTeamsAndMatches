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
echo "<select id='ligasel' name='liga'>";
		$sql = "SET NAMES 'UTF8'";
		$conn->query($sql);
		$sql = "SELECT * FROM druzyny WHERE id = {$_POST["id"]}";
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
	}
		$sql = "SELECT * FROM druzyny WHERE id = {$_POST["id2"]}";
		$result = $conn->query($sql);
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
	}
			$opcja = 0;
			for ($i=1; $i<5; $i++) {
				if ($teamy[$i]==$teamy[$i+8]) {
					$opcja++;
					echo "<option value='" . $teamy[$i] . "'";
					if($opcja == 1)
						echo " selected"; 
					echo ">" . $teamy[$i] . "</option>";	
				}
			}
		
		echo "<option value='Mecz Towarzyski'>Mecz Towarzyski</option></select>" . 
							"<select id='stadionsel' name='liga'>";
			if ($teamy[6] == $teamy[14])
				echo "<option selected value='" . $teamy[6] . "'>" . $teamy[6] . "</option>";
			else {
				echo "<option selected value='" . $teamy[6] . "'>" . $teamy[6] . "</option>" . 
					 "<option value='" . $teamy[14] . "'>" . $teamy[14] . "</option>";
			}
			echo "</select><div id='logoaa'>" . $teamy[7] . "</div>" .
						  "<div id='logobb'>" . $teamy[15] . "</div>";		
		unset($teamy);
		$conn->close();
?>