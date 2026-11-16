
<?php
require_once 'db.php';

$message = "";

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

        $sql = "INSERT INTO bookings
        (client_name, phone, service, booking_date, booking_time, comment)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $client_name,
            $phone,
            $service,
            $booking_date,
            $booking_time,
            $comment
        ]);

        $message = "Жазылым сәтті қосылды!";
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Жаңа жазылым қосу</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
        }

        .form-container h2 {
            text-align: center;
            color: #d45b83;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #d45b83;
            color: white;
            border: none;
            cursor: pointer;
        }

        .message {
            text-align: center;
            color: #d45b83;
        }
    </style>
</head>

<body>

<div class="form-container">

    <h2>Жаңа жазылым қосу</h2>

    <p class="message">
        <?= htmlspecialchars($message) ?>
    </p>

    <form method="POST">

        <input type="text"
               name="client_name"
               placeholder="Клиенттің аты"
               required>

        <input type="text"
               name="phone"
               placeholder="Телефон нөмірі"
               required>

        <input type="text"
               name="service"
               placeholder="Қызмет атауы"
               required>

        <label>Жазылу күні:</label>
        <input type="date" name="booking_date" required>

        <label>Жазылу уақыты:</label>
        <input type="time" name="booking_time" required>

        <textarea name="comment"
                  placeholder="Қосымша түсініктеме"></textarea>

        <button type="submit">
            Жазылымды сақтау
        </button>

    </form>

    <p>
        <a href="manage_bookings.php">
            Жазылымдар тізіміне қайту
        </a>
    </p>

</div>

</body>
</html>
