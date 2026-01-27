<?php
require '../config/db.php';
$name = "%".$_GET['name']."%";
$cat = "%".$_GET['category']."%";


$stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? AND category LIKE ?");
$stmt->execute([$name, $cat]);


echo json_encode($stmt->fetchAll());