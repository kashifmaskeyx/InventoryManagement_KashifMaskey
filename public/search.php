<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    exit; // security
}

$q = $_GET['q'] ?? '';
$q = "%$q%";
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT products.*, suppliers.name AS supplier
    FROM products
    JOIN suppliers ON products.supplier_id = suppliers.id
    WHERE products.user_id = ?
      AND (products.name LIKE ? OR products.category LIKE ?)
");

$stmt->execute([$userId, $q, $q]);

foreach ($stmt as $row) {
    echo "<tr>
        <td>" . htmlspecialchars($row['name']) . "</td>
        <td>" . htmlspecialchars($row['category']) . "</td>
        <td>" . htmlspecialchars($row['supplier']) . "</td>
        <td>{$row['quantity']}</td>
        <td>{$row['price']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Delete this product?\")'>Delete</a>
        </td>
    </tr>";
}
