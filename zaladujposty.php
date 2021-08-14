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
	$sql = "SET NAMES 'UTF8'";
	$conn->query($sql);
	$sql = "SELECT p.id, p.tytul, k.nazwa, p.data FROM posty p, kategorie k WHERE p.idKategorii = k.id";
	if (isset($_GET["id"])) {
		$sql .= " AND p.idKategorii = {$_GET["id"]}";
	}
	$lim = $_POST["lim1"];
	$lim2 = $_POST["lim2"];
	$sql .= " ORDER BY p.data DESC LIMIT " . $lim . "," . $lim2;
	$result = $conn->query($sql);
	$row_cnt = $result->num_rows;

	if ($result->num_rows > 0) {
		$i = 1;
		while ($row = $result->fetch_assoc()) {
			echo 
						"<tr><td style='width: 35%;min-width: 200px; height: 150px;border-right: 0;border-bottom: 0;'>" .
							"<a style='display: block; width: 100%; height: 100%;background-image: url(" . $row["id"] . ".jpg);' href='post.php?id=" . $row["id"] . "'>" .
							"</a>" .
						"</td>" .
						"<td style='width: 65%; height: 150px;border-bottom: 0;border-right: 0;'>" .
							"<a style='display: block;;width: 100%; height: 100%;margin: 0 auto;' href='post.php?id=" . $row["id"] . "'>" .
								"<span style='width: 85%;font-size: 125%;margin: 0;position: absolute;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);'>" . $row["nazwa"] . ": " . 
								$row["tytul"] . "<br><span style='color: white; font-size: 60%;'>" .
								$row["data"] . "</span>" .
							"</a>" .
						"</td></tr>";
			if ($row_cnt==$i && ($i%5)!=0) 
				echo "<script>$('#pokazwiecej').remove();</script>";
			//else if ($row_cnt==$i) 
				//echo "</table></div>";
			$i++;
		}
	}
	else {
		echo "<script>$('#pokazwiecej').remove();</script>";
	}
	$conn->close();
	
?>