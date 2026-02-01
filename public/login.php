    <?php
    session_start();
    require '../config/db.php';
    require '../templates/header.php';

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // CSRF CHECK
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            die("Invalid CSRF token");
        }

        $login    = trim($_POST['login']); // username OR email
        $password = $_POST['password'];

        $stmt = $pdo->prepare(
            "SELECT * FROM users WHERE username = ? OR email = ?"
        );
        $stmt->execute([$login, $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        }

        $error = "Invalid credentials";
    }
    ?>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label>Username or Email</label>
        <input name="login" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button>Login</button>
        <p class="error"><?= htmlspecialchars($error ?? '') ?></p>
    </form>

    <?php require '../templates/footer.php'; ?>
