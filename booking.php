
<?php
require_once 'auth.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["clientName"]);
    $phone = trim($_POST["phone"]);
    $service = trim($_POST["service"]);
    $date = trim($_POST["date"]);
    $time = trim($_POST["time"]);
    $comment = trim($_POST["comment"]);

    if (
        empty($name) ||
        empty($phone) ||
        empty($service) ||
        empty($date) ||
        empty($time)
    ) {
        $message = "Барлық міндетті өрістерді толтырыңыз!";
    } else {
        $message = "Құрметті " . htmlspecialchars($name) .
                   "! Сіздің жазылу өтінішіңіз қабылданды.";
    }
}
?>

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["clientName"]);
    $phone = trim($_POST["phone"]);
    $service = trim($_POST["service"]);
    $date = trim($_POST["date"]);
    $time = trim($_POST["time"]);
    $comment = trim($_POST["comment"]);

    if (
        empty($name) ||
        empty($phone) ||
        empty($service) ||
        empty($date) ||
        empty($time)
    ) {
        $message = "Барлық міндетті өрістерді толтырыңыз!";
    } else {
        $message = "Құрметті " . htmlspecialchars($name) .
                   "! Сіздің жазылу өтінішіңіз қабылданды.";
    }
}
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қызметке жазылу | BeautySalon</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff0f5;
            color: #4a2535;
        }

        header {
            background: #e98aaa;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 35px auto;
            padding: 30px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 5px 20px #e9b6c8;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #e5b5c5;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 22px;
            background: #d95f8a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #bd4772;
        }

        .back {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #bd4772;
            text-decoration: none;
        }

        nav {
            background: #f4c5d4;
            padding: 17px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 25px;
        }

        nav a {
            color: #642c42;
            font-weight: bold;
        }

        footer {
            background: #a9436b;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">

        <h2>Қызметке жазылу</h2>

        <?php if (!empty($message)): ?>
            <p style="text-align:center; color:#bd4772; font-weight:bold;">
                <?= $message ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="booking.php">

            <label for="clientName">Аты-жөніңіз</label>
            <input type="text" id="clientName" name="clientName"
                   placeholder="Атыңызды енгізіңіз" required>

            <label for="phone">Телефон нөмірі</label>
            <input type="tel" id="phone" name="phone"
                   placeholder="+7 700 000 00 00" required>

            <label for="service">Қызмет түрі</label>
            <select id="service" name="service" required>
                <option value="">Қызметті таңдаңыз</option>
                <option value="Шаш қию">Шаш қию — 3000 ₸</option>
                <option value="Маникюр">Маникюр — 4000 ₸</option>
                <option value="Макияж">Макияж — 6000 ₸</option>
            </select>

            <label for="date">Күні</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Уақыты</label>
            <input type="time" id="time" name="time" required>

            <label for="comment">Қосымша ескерту</label>
            <textarea id="comment" name="comment"
                      placeholder="Қалауыңыз болса, жазыңыз"></textarea>

            <button type="submit">Жазылуды растау</button>

        </form>

        <p class="back">
            <a href="index.php">← Басты бетке оралу</a>
        </p>

    </div>

    <script>
        // Өткен күндерді таңдауға жол бермеу
        document.getElementById("date").min =
            new Date().toLocaleDateString("en-CA");
    </script>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
