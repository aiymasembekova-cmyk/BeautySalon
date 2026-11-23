
<?php
require_once 'auth.php';

// Тек администраторға рұқсат беру
requireAdmin();

require_once 'includes/db.php';

// Барлық жазылымдарды алу
$stmt = $pdo->query(
    "SELECT * FROM bookings ORDER BY booking_date DESC, booking_time DESC"
);

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin панелі | BeautySalon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Admin панелі</h1>

    <p>Қош келдіңіз, <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>!</p>

    <h2>Барлық клиенттердің жазылымдары</h2>

    <?php if (count($bookings) > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Клиент</th>
                <th>Телефон</th>
                <th>Қызмет</th>
                <th>Күні</th>
                <th>Уақыты</th>
            </tr>

            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['client_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($booking['phone'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($booking['service'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($booking['booking_date'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($booking['booking_time'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Әзірге жазылымдар жоқ.</p>
    <?php endif; ?>

    <p><a href="index.php">Басты бетке қайту</a></p>
    <p><a href="logout.php">Жүйеден шығу</a></p>
</div>

</body>
</html>
