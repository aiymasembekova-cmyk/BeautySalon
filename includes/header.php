
<?php
// Сессияны тексеру және бастау
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
?>

<header>
    <h1>BeautySalon</h1>
    <p>Сұлулық пен күтім әлеміне қош келдіңіз!</p>
</header>

<nav style="position: sticky; top: 0; z-index: 1000;">

    <a href="index.php">Басты бет</a>

    <a href="index.php#services">Қызметтер</a>

    <a href="search.php">Қызмет іздеу</a>

    <?php if ($isLoggedIn): ?>

        <span style="color:#642c42; font-weight:bold;">
            Сәлем, <?= htmlspecialchars($_SESSION['user_name']) ?>!
        </span>

        <a href="booking.php">Жазылу</a>

        <a href="logout.php">Шығу</a>

    <?php else: ?>

        <a href="login.php">Кіру</a>

        <a href="register.php">Тіркелу</a>

        <a href="booking.php">Жазылу</a>

    <?php endif; ?>

</nav>
