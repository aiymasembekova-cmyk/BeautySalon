
<?php
require_once 'db.php';

$id = $_GET['id'] ?? null;

if (!$id || !filter_var($id, FILTER_VALIDATE_INT)) {
    die("Жазылым нөмірі дұрыс емес!");
}

// Жазылым мәліметтерін алу
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->execute([$id]);

$booking = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$booking) {
    die("Жазылым табылмады!");
}

$message = "";

// Өзгерістерді сақтау
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $client_name = trim($_POST["client_name"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $service = trim($_POST["service"] ?? "");
    $booking_date = trim($_POST["booking_date"] ?? "");
    $booking_time = trim($_POST["booking_time"] ?? "");
    $comment = trim($_POST["comment"] ?? "");

    if (
        empty($client_name) ||
        empty($phone) ||
        empty($service) ||
        empty($booking_date) ||
        empty($booking_time)
    ) {
        $message = "Барлық міндетті өрістерді толтырыңыз!";
    } else {

        $sql = "UPDATE bookings SET
            client_name = ?,
            phone = ?,
            service = ?,
            booking_date = ?,
            booking_time = ?,
            comment = ?
            WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $client_name,
            $phone,
            $service,
            $booking_date,
            $booking_time,
            $comment,
            $id
        ]);

        header("Location: manage_bookings.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Жазылымды өңдеу</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .edit-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
        }

        .edit-container h2 {
            text-align: center;
            color: #d45b83;
        }

        .edit-container input,
        .edit-container textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        .edit-container button {
            width: 100%;
            padding: 12px;
            background: #d45b83;
            color: white;
            border: none;
            cursor: pointer;
        }

        .message {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="edit-container">

    <h2>Жазылымды өңдеу</h2>

    <p class="message">
        <?= htmlspecialchars($message) ?>
    </p>

    <form method="POST">

        <input type="text" name="client_name"
            value="<?= htmlspecialchars($booking['client_name']) ?>"
            placeholder="Клиенттің аты" required>

        <input type="text" name="phone"
            value="<?= htmlspecialchars($booking['phone']) ?>"
            placeholder="Телефон" required>

        <input type="text" name="service"
            value="<?= htmlspecialchars($booking['service']) ?>"
            placeholder="Қызмет" required>

        <label>Жазылу күні:</label>

        <input type="date" name="booking_date"
            value="<?= htmlspecialchars($booking['booking_date']) ?>"
            required>

        <label>Жазылу уақыты:</label>

        <input type="time" name="booking_time"
            value="<?= htmlspecialchars(substr($booking['booking_time'], 0, 5)) ?>"
            required>

        <textarea name="comment"
            placeholder="Түсініктеме"><?= htmlspecialchars($booking['comment'] ?? '') ?></textarea>

        <button type="submit">Өзгерістерді сақтау</button>

    </form>

    <p>
        <a href="manage_bookings.php">Артқа қайту</a>
    </p>

</div>

</body>
</html>
