
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeautySalon — Сұлулық салоны</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff5f7;
            color: #44333a;
        }

        header {
            background: linear-gradient(135deg, #d96c91, #a9436b);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }

        header h1 {
            font-size: 42px;
            margin: 0;
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
            text-decoration: none;
            color: #642c42;
            font-weight: bold;
        }

        nav a:hover {
            color: #b12f61;
        }

        .hero {
            text-align: center;
            padding: 55px 20px;
        }

        .hero h2 {
            font-size: 32px;
            color: #bd4f79;
        }

        .hero p {
            max-width: 600px;
            margin: 15px auto 25px;
            line-height: 1.8;
        }

        .button {
            display: inline-block;
            background: #d96c91;
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 9px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background: #b94e78;
        }

        .services-section {
            padding: 25px 20px 55px;
            text-align: center;
        }

        .services-section h2 {
            color: #bd4f79;
            font-size: 30px;
        }

        .services {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 22px;
            max-width: 1050px;
            margin: 30px auto;
        }

        .service {
            background: white;
            width: 280px;
            padding: 28px 20px;
            border-radius: 16px;
            box-shadow: 0 5px 18px #e8cbd5;
            transition: 0.3s;
        }

        .service:hover {
            transform: translateY(-6px);
        }

        .service .emoji {
            font-size: 42px;
        }

        .service h3 {
            color: #bd4f79;
        }

        .price {
            font-weight: bold;
            color: #a9436b;
        }

        .booking {
            background: #f9dce6;
            padding: 45px 20px;
            text-align: center;
        }

        .booking h2 {
            color: #a9436b;
        }

        footer {
            background: #a9436b;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 32px;
            }

            .hero h2 {
                font-size: 26px;
            }

            nav {
                gap: 15px;
            }

            .service {
                width: 100%;
                max-width: 350px;
            }
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
        <a href="login.php">Кіру / Тіркелу</a>
        <a href="booking.php">Жазылу</a>
    </nav>

    <section class="hero">
        <h2>Өзіңізге күтім жасаңыз!</h2>

        <p>
            BeautySalon сұлулық салонына қош келдіңіз!
            Біз сізге шаш қию, маникюр және макияж қызметтерін
            ұсынамыз. Өзіңізге ұнайтын қызметті таңдап,
            қабылдауға оңай жазылыңыз.
        </p>

        <a class="button" href="booking.php">Қабылдауға жазылу</a>
    </section>

    <section class="services-section" id="services">
        <h2>Біздің қызметтер</h2>
        <p>Сізге арналған сұлулық пен күтім қызметтері</p>

        <div class="services">

            <div class="service">
                <div class="emoji">💇‍♀️</div>
                <h3>Шаш қию</h3>
                <p>Шаш қию және сәнді шаш үлгісін жасау.</p>
                <p class="price">3000 ₸ бастап</p>
            </div>

            <div class="service">
                <div class="emoji">💅</div>
                <h3>Маникюр</h3>
                <p>Тырнақ күтімі және әдемі дизайн.</p>
                <p class="price">4000 ₸ бастап</p>
            </div>

            <div class="service">
                <div class="emoji">💄</div>
                <h3>Макияж</h3>
                <p>Күнделікті және мерекелік макияж.</p>
                <p class="price">5000 ₸ бастап</p>
            </div>

        </div>
    </section>

    <section class="booking">
        <h2>Өзіңізге уақыт бөліңіз!</h2>
        <p>Қалаған қызметіңізді таңдап, бізге жазылыңыз.</p>
        <a class="button" href="booking.php">Қазір жазылу</a>
    </section>

    <footer>
        <p>BeautySalon © 2026. Барлық құқықтар қорғалған.</p>
    </footer>

</body>
</html>
