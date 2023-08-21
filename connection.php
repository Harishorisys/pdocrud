<?php

$dsn = "mysql:host=localhost;dbname=insert";
$user = "root";
$password = "";


try {
	$conn = new PDO($dsn, $user, $password);
		// echo "Connected to the  database successfully!";

} 
catch(PDOException $e) {
	echo $e->getMessage();
}

?>