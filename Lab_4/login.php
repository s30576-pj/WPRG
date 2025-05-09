<?php
session_start();
require_once 'config.php';

$error_message = '';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: rezerwacja.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === USERNAME && $password === PASSWORD) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        setcookie(LOGGED_IN_USER_COOKIE_NAME, $username, COOKIE_LIFETIME, COOKIE_PATH);

        header('Location: rezerwacja.php');
        exit;
    } else {
        $error_message = "Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie - Rezerwacja Hotelu</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .container { width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { display: block; margin-bottom: 8px; }
        input[type="text"], input[type="password"] { width: calc(100% - 16px); padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 3px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Logowanie do Systemu Rezerwacji</h2>
    <?php if ($error_message): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label>Nazwa użytkownika:
            <input type="text" name="username" required>
        </label>
        <label>Hasło:
            <input type="password" name="password" required>
        </label>
        <button type="submit">Zaloguj</button>
    </form>
</div>
</body>
</html>