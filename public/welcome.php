<?php session_start(); if(isset($_SESSION['user'])) header('Location: dashboard.php'); ?>
<!DOCTYPE html>

<html>

    <head>
        <title>Welcome | Inventory System</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <body>
        <div class="container center">

            <h1>Welcome to Inventory System</h1>
            <p>Manage products, suppliers and stock efficiently</p>

            <div class="actions">

                <a class="btn" href="login.php">Login</a>
                <a class="btn outline" href="register.php">Register</a>

            </div>
        </div>
    </body>
</html>