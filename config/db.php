<?php
$host = "localhost";
$dbname = "inventory_db";
$user = "root";   // change on college server
$pass = "";       // change on college server

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Suppliers
    $pdo->exec("CREATE TABLE IF NOT EXISTS suppliers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        contact VARCHAR(50)
    )");

    // Products
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        supplier_id INT NOT NULL,
        category VARCHAR(50),
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
    )");

    // Stock logs
    $pdo->exec("CREATE TABLE IF NOT EXISTS stock_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        stock_change INT NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id)
    )");

    // Insert suppliers
    $count = $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("INSERT INTO suppliers (name, contact) VALUES
            ('Coffee Sup','coffee@mail.com'),
            ('Bakery Sup','Bakery@mail.com')
        ");
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}