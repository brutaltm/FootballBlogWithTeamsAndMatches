<?php
	session_start();
function stripUnwantedTagsAndAttrs($html_str){
  $xml = new DOMDocument();
//Suppress warnings: proper error handling is beyond scope of example
  libxml_use_internal_errors(true);
//List the tags you want to allow here, NOTE you MUST allow html and body otherwise entire string will be cleared
  $allowed_tags = array("html", "body", "b", "br", "em", "hr", "i", "li", "ol", "p", "s", "span", "table", "tr", "td", "u", "ul");
  //$allowed_tags = array("html", "body", "b", "br", "em", "i", "u", "span");
//List the attributes you want to allow here
  $allowed_attrs = array ("class", "id", "style");
  if (!strlen($html_str)){return false;}
  if ($xml->loadHTML($html_str, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)){
    foreach ($xml->getElementsByTagName("*") as $tag){
      if (!in_array($tag->tagName, $allowed_tags)){
        $tag->parentNode->removeChild($tag);
      }else{
        foreach ($tag->attributes as $attr){
          if (!in_array($attr->nodeName, $allowed_attrs)){
            $tag->removeAttribute($attr->nodeName);
          }
        }
      }
    }
  }
  return $xml->saveHTML();
}
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
	if (empty($_POST["tytul"]) || empty($_POST["tresc"]) || empty($_POST["kategoria"]) || empty($_POST["id"])){
		$conn->close();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}	
	if (!(isset($_SESSION["nick"]) && isset($_SESSION["id"]) && isset($_SESSION["typ"]))) {
		echo "Brak uprawnień";
		$conn->close();
		exit;
	}
	else {
		if ($_SESSION["typ"] != "admin") {
			$sql = "SELECT id, userid FROM posty WHERE id = {$_POST["id"]}";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc())
					$userid = $row["userid"];
				if ($userid == $_SESSION["id"]) {
					//if ($_POST["kategoria"]!=8) {
					//$tytul = stripUnwantedTagsAndAttrs($_POST["tytul"]);
					//$tytul = str_replace("&#39;","(apos)",$tytul);
					//$tytul = str_replace("'","(apos)",$tytul);
					//$tytul = str_replace('&#34;',"(2apos)",$tytul);
					//$tytul = str_replace('"',"(2apos)",$tytul);
					//$tresc = stripUnwantedTagsAndAttrs($_POST["tresc"]);
					//$tresc = str_replace("&#39;","(apos)",$tresc);
					//$tytul = str_replace("'","(apos)",$tytul);
					//$tresc = str_replace('&#34;',"(2apos)",$tresc);
					//$tytul = str_replace('"',"(2apos)",$tytul);
					//$tytul = str_replace("&lt;" . "br" . &gt;,"(((br)))",$tytul);
					//$tresc = str_replace(&lt; . "br" . &gt;,"(((br)))",$tresc);
					$tytul = htmlspecialchars($_POST["tytul"], ENT_QUOTES);
					$tresc = htmlspecialchars($_POST["tresc"], ENT_QUOTES);
					
					$sql = "SET NAMES 'UTF8'";
					$conn->query($sql);
					$sql = "UPDATE posty SET tytul = '{$tytul}', tresc = '{$tresc}', idkategorii = '{$_POST["kategoria"]}' " .
					   "WHERE id = '{$_POST["id"]}'"; 
					if ($conn->query($sql)=== TRUE) {
						//OBRAZEK
						$idn = $_POST["id"];
						$target_dir = "";
						$target_file = $target_dir . basename($_FILES["zdjecie"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

						$check = getimagesize($_FILES["zdjecie"]["tmp_name"]);
						if($check !== false) {
							echo "File is an image - " . $check["mime"] . ".";
							$uploadOk = 1;
						} else {
							echo "File is not an image.";
							$uploadOk = 0;
						}
						
						if($imageFileType != "jpg") {
							echo "Sorry, only JPG files are allowed.";
							$uploadOk = 0;	
						}
						if ($uploadOk == 0) {
							echo "Plik nie spełnia wymagań";
						} else {
							echo "JESTEM TU";
							$conn->close();
							exit;
							$imgname = getcwd() . "/" . $_POST["id"] . '.jpg';
							if (file_exists($imgname)) {
								chmod("$imgname",0755); //Change the file permissions if allowed
								unlink("$imgname"); //remove the file
							}
							if (move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $idn . ".jpg")) {
								echo "Plik ". basename( $_FILES["zdjecie"]["name"]). " został wysłany.";
							} else {
								echo "Błąd wysyłania pliku.";
							}
						}
						//OBRAZEK
						$conn->close();
						header('Location: ' . $_SERVER['HTTP_REFERER']);
						exit;
					}
					else {
						echo "Error: " . $sql . "<br>" . $conn->error;
						$conn->close();
						exit;
					}
				}
				else {
					echo "Brak uprawnień" . $_SESSION["id"] . "VS" . $userid;
					$conn->close();
					exit;
				}
			}
			else {
				$conn->close();
				echo "Brak takiego posta";
				exit;
			}
		}
		else {
			$tytul = htmlspecialchars($_POST["tytul"], ENT_QUOTES);
			$tresc = htmlspecialchars($_POST["tresc"], ENT_QUOTES);
			$sql = "SET NAMES 'UTF8'";
			$conn->query($sql);
			$sql = "UPDATE posty SET tytul = '{$tytul}', tresc = '{$tresc}', idkategorii = '{$_POST["kategoria"]}' " .
				   "WHERE id = '{$_POST["id"]}'"; 
			if ($conn->query($sql)=== TRUE) {
							//OBRAZEK
						$idn = $_POST["id"];
						$target_dir = "";
						$target_file = $target_dir . basename($_FILES["zdjecie"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

						$check = getimagesize($_FILES["zdjecie"]["tmp_name"]);
						if($check !== false) {
							echo "File is an image - " . $check["mime"] . ".";
							$uploadOk = 1;
						} else {
							echo "File is not an image.";
							$uploadOk = 0;
						}
						
						if($imageFileType != "jpg") {
							echo "Sorry, only JPG files are allowed.";
							$uploadOk = 0;	
						}
						if ($uploadOk == 0) {
							echo "Plik nie spełnia wymagań";
						} else {
							$imgname = getcwd() . "/" . $_POST["id"] . '.jpg';
							if (file_exists($imgname)) {
								chmod("$imgname",0755); //Change the file permissions if allowed
								unlink("$imgname"); //remove the file
							}
							if (move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $idn . ".jpg")) {
								echo "Plik ". basename( $_FILES["zdjecie"]["name"]). " został wysłany.";
							} else {
								echo "Błąd wysyłania pliku.";
							}
						}
								//OBRAZEK
				$conn->close();
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit;
			}
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				$conn->close();
				exit;
			}
		}
	}
	
?> 