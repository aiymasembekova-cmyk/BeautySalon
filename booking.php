```php
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

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>BeautySalon</h1>
        <p>Өзіңізге күтім жасаңыз!</p>
    </header>

    <div class="container">
        <h2>Қызметке жазылу</h2>

        <form onsubmit="bookAppointment(event)">
            <label for="clientName">Аты-жөніңіз</label>
            <input type="text" id="clientName" placeholder="Атыңызды енгізіңіз" required>

            <label for="phone">Телефон нөмірі</label>
            <input type="tel" id="phone" placeholder="+7 700 000 00 00" required>

            <label for="service">Қызмет түрі</label>
            <select id="service" required>
                <option value="">Қызметті таңдаңыз</option>
                <option value="Шаш қию">Шаш қию — 3000 ₸</option>
                <option value="Маникюр">Маникюр — 4000 ₸</option>
                <option value="Макияж">Макияж — 6000 ₸</option>
            </select>

            <label for="date">Күні</label>
            <input type="date" id="date" required>

            <label for="time">Уақыты</label>
            <input type="time" id="time" required>

            <label for="comment">Қосымша ескерту</label>
            <textarea id="comment" placeholder="Қалауыңыз болса, жазыңыз"></textarea>

            <button type="submit">Жазылуды растау</button>
        </form>

        <p class="back">
            <a href="index.php">← Басты бетке оралу</a>
        </p>
    </div>

    <script>
        // Жазылу формасын өңдеу
        function bookAppointment(event) {
            event.preventDefault();

            const name = document.getElementById("clientName").value;
            const service = document.getElementById("service").value;
            const date = document.getElementById("date").value;
            const time = document.getElementById("time").value;

            alert(
                "Құрметті " + name + "!\n" +
                "Қызмет: " + service + "\n" +
                "Күні: " + date + "\n" +
                "Уақыты: " + time + "\n\n" +
                "Сіздің өтінішіңіз қабылданды!"
            );
        }

        // Өткен күндерді таңдауға жол бермеу
        document.getElementById("date").min =
            new Date().toLocaleDateString("en-CA");
    </script>
</body>
</html>
```