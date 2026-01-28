<?php require '../config/db.php';
$q = "%" . $_GET['q'] . "%";

$stmt = $pdo->prepare("SELECT products.*, suppliers.name AS supplier
    FROM products JOIN suppliers ON products.supplier_id = suppliers.id
    WHERE products.name LIKE ? OR category LIKE ?");
$stmt->execute([$q, $q]);

foreach ($stmt as $row) {
    echo "<tr>
        <td>" . htmlspecialchars($row['name']) . "</td>
        <td>{$row['category']}</td>
        <td>{$row['supplier']}</td>
        <td>{$row['quantity']}</td>
        <td>{$row['price']}</td>
        <td><a href='edit.php?id={$row['id']}'>Edit</a></td>
    </tr>";
}