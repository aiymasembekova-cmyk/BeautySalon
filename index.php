
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeautySalon — Сұлулық салоны</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff5f7;
            color: #333;
        }

        header {
            background-color: #d96c91;
            color: white;
            text-align: center;
            padding: 25px;
        }

        nav {
            background-color: #f4c5d4;
            text-align: center;
            padding: 15px;
        }

        nav a {
            color: #642c42;
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
        }

        main {
            text-align: center;
            padding: 60px 20px;
        }

        h2 {
            color: #c34f78;
        }

        .service {
            display: inline-block;
            background-color: white;
            width: 220px;
            margin: 12px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px #e8cbd5;
        }

        .button {
            display: inline-block;
            background-color: #d96c91;
            color: white;
            padding: 14px 25px;
            border-radius: 8px;
            text-decoration: none;
        }

        footer {
            background-color: #d96c91;
            color: white;
            text-align: center;
            padding: 18px;
        }
    </style>
</head>

<body>

    <header>
        <h1>BeautySalon</h1>
        <p>Сұлулық пен күтім әлеміне қош келдіңіз!</p>
    </header>

    <nav>
        <a href="index.php">Басты бет</a>
        <a href="#services">Қызметтер</a>
        <a href="#booking">Жазылу</a>
    </nav>

    <main>
        <h2>Өзіңізге күтім жасаңыз!</h2>

        <p>
            Біздің сұлулық салонымызда өзіңізге ұнайтын
            қызметті таңдап, қабылдауға жазыла аласыз.
        </p>

        <h2 id="services">Біздің қызметтер</h2>

        <div class="service">
            <h3>Шаш қию</h3>
            <p>Шаш үлгісін жасау және қию</p>
            <p>Бағасы: 3000 ₸ бастап</p>
        </div>

        <div class="service">
            <h3>Маникюр</h3>
            <p>Тырнақ күтімі және сәндеу</p>
            <p>Бағасы: 4000 ₸ бастап</p>
        </div>

        <div class="service">
            <h3>Макияж</h3>
            <p>Күнделікті және мерекелік макияж</p>
            <p>Бағасы: 5000 ₸ бастап</p>
        </div>

        <h2 id="booking">Қабылдауға жазылу</h2>

        <p>Өзіңізге ұнайтын қызметті таңдап, бізге хабарласыңыз.</p>

        <a class="button" href="mailto:salon@example.com">
            Жазылу
        </a>
    </main>

    <footer>
        <p>BeautySalon © 2026. Барлық құқықтар қорғалған.</p>
    </footer>

</body>
</html>
