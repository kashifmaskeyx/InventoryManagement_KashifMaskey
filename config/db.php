<?php 
$server = "mysql:host=localhost;dbname=inventory_db";
$user = "root";
$password ="";

try {
	$con = new PDO($server, $user, $password);
	$con -> exec("CREATE TABLE IF NOT EXISTS products (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, category VARCHAR(50), quantity INT,price DECIMAL(10,2))");
	echo "database connected!";

} catch(PDOException $e){
	die ("database connecton failed.");
}