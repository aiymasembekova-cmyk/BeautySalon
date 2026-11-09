
<?php
require_once 'includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === '' || $email === '' || $password === '') {
        $message = "Барлық өрістерді толтырыңыз!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email дұрыс енгізілмеген!";
    } elseif (strlen($password) < 6) {
        $message = "Пароль кемінде 6 таңбадан тұруы керек!";
    } else {
        try {
            // Парольді қауіпсіз хэштеу
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Пайдаланушыны дерекқорға сақтау
            $sql = "INSERT INTO users (name, email, password)
                    VALUES (:name, :email, :password)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword
            ]);

            $message = "Тіркелу сәтті аяқталды!";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = "Бұл email бұрын тіркелген!";
            } else {
                $message = "Қате пайда болды!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тіркелу - BeautySalon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="register-container">
    <h2>BeautySalon</h2>
    <h3>Тіркелу</h3>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Аты-жөніңіз:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Пароль:</label>
        <input type="password" name="password" required>

        <button type="submit">Тіркелу</button>
    </form>

    <p>Аккаунтыңыз бар ма?
        <a href="login.php">Кіру</a>
    </p>
</div>

</body>
</html>
