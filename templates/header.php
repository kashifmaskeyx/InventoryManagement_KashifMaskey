<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory System</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
<div class="layout">

    <aside class="sidebar">
        <h1 class="logo">Inventory and Stock Management</h1>

        <nav class="nav">
            <a href="dashboard.php">Dashboard</a>
            <a href="index.php">Products</a>
            <a href="add.php">Add Product</a>
        </nav>

        <div class="sidebar-bottom">
            <div class="user">
                <?= htmlspecialchars($_SESSION['user']) ?>
            </div>
            <a class="logout" href="logout.php">Logout</a>
        </div>
    </aside>

    <main class="main">
<?php endif; ?>
