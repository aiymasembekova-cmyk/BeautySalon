
<?php
require_once 'db.php';

// Дерекқордан барлық жазылымдарды алу
$sql = "SELECT * FROM bookings ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Жазылымдарды басқару</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .bookings-container {
            width: 95%;
            margin: 40px auto;
            overflow-x: auto;
        }

        .bookings-container h2 {
            text-align: center;
            color: #d45b83;
            margin-bottom: 25px;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .bookings-table th {
            background: #d45b83;
            color: white;
        }

        .bookings-table tr:nth-child(even) {
            background: #fff0f5;
        }

        .action-btn {
            display: inline-block;
            padding: 8px 12px;
            margin: 3px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .edit-btn {
            background: #d45b83;
        }

        .delete-btn {
            background: #c0392b;
        }

        .add-btn {
            display: inline-block;
            padding: 12px 18px;
            background: #d45b83;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="bookings-container">

    <h2>Клиенттердің жазылымдары</h2>

    <a href="add_booking.php" class="add-btn">
        + Жаңа жазылым қосу
    </a>

    <table class="bookings-table">

        <tr>
            <th>ID</th>
            <th>Клиент аты</th>
            <th>Телефон</th>
            <th>Қызмет</th>
            <th>Күні</th>
            <th>Уақыты</th>
            <th>Түсініктеме</th>
            <th>Әрекеттер</th>
        </tr>

        <?php if (count($bookings) > 0): ?>

            <?php foreach ($bookings as $booking): ?>

                <tr>
                    <td><?= htmlspecialchars($booking['id']) ?></td>

                    <td><?= htmlspecialchars($booking['client_name']) ?></td>

                    <td><?= htmlspecialchars($booking['phone']) ?></td>

                    <td><?= htmlspecialchars($booking['service']) ?></td>

                    <td><?= htmlspecialchars($booking['booking_date']) ?></td>

                    <td><?= htmlspecialchars($booking['booking_time']) ?></td>

                    <td><?= htmlspecialchars($booking['comment'] ?? '') ?></td>

                    <td>
                        <a
                            href="edit_booking.php?id=<?= (int)$booking['id'] ?>"
                            class="action-btn edit-btn">
                            Өңдеу
                        </a>

                        <form
                            action="delete_booking.php"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Бұл жазылымды өшіргіңіз келе ме?');">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int)$booking['id'] ?>">

                            <button
                                type="submit"
                                class="action-btn delete-btn">
                                Өшіру
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="8">Әзірге жазылымдар жоқ.</td>
            </tr>

        <?php endif; ?>

    </table>

</div>

</body>
</html>
