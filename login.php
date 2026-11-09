<?php
session_start();
require_once 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        header('Location: index.php');
        exit;
    } else {
        $message = "Email немесе пароль қате!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Жүйеге кіру | BeautySalon</title>
    <style>
        body {
            font-family: Arial;
            background: #fff0f5;
            color: #4a2535;
            margin: 0;
        }

        header {
            background: #e98aaa;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 18px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #d95f8a;
            color: white;
            border: none;
            cursor: pointer;
        }

        .message {
            color: #bd4772;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <h1>BeautySalon</h1>
    <p>Сұлулық пен күтім әлемі</p>
</header>

<div class="container">
    <h2>Жүйеге кіру</h2>

    <?php if ($message): ?>
        <p class="message">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <input type="email" name="email"
               placeholder="Электрондық пошта" required>

        <input type="password" name="password"
               placeholder="Құпиясөз" required>

        <button type="submit">Кіру</button>
    </form>

    <p>Аккаунтыңыз жоқ па?
        <a href="register.php">Тіркелу</a>
    </p>

    <p><a href="index.php">Басты бетке оралу</a></p>
</div>

</body>
</html>