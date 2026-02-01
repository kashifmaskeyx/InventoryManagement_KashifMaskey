<?php
session_start();
require '../config/db.php';
require '../templates/header.php';

$error = '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $username = trim($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password']; // raw password

    // Server-side validation
    if (!$email) {
        $error = "Invalid email address";
    } elseif (!preg_match('/^(?=.*\d).{8,}$/', $password)) {
        $error = "Password must be at least 8 characters long and contain at least one number.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
            );
            $stmt->execute([$username, $email, $hashedPassword]);

            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $error = "Username or email already exists";
        }
    }
}
?>

<div class="main">
    <h2>Register</h2>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <label>Username</label>
        <input name="username" required>
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button>Register</button>
        <p class="error"><?= htmlspecialchars($error ?? '') ?></p>
    </form>
</div>

<?php require '../templates/footer.php'; ?>
