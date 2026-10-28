```php
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Жүйеге кіру | BeautySalon</title>

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
            padding: 20px;
            text-align: center;
            color: white;
        }

        .container {
            max-width: 420px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 5px 20px #e9b6c8;
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #e5b5c5;
            border-radius: 8px;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 10px;
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
    </style>
</head>

<body>
    <header>
        <h1>BeautySalon</h1>
        <p>Сұлулық пен күтім әлемі</p>
    </header>

    <div class="container">
        <h2>Жүйеге кіру</h2>

        <form onsubmit="login(event)">
            <input type="email" id="email" placeholder="Электрондық пошта" required>
            <input type="password" id="password" placeholder="Құпиясөз" required>
            <button type="submit">Кіру</button>
        </form>

        <h2>Тіркелу</h2>

        <form onsubmit="register(event)">
            <input type="text" id="name" placeholder="Аты-жөніңіз" required>
            <input type="email" id="newEmail" placeholder="Электрондық пошта" required>
            <input type="password" id="newPassword" placeholder="Құпиясөз" required>
            <button type="submit">Тіркелу</button>
        </form>

        <p class="back">
            <a href="index.php">← Басты бетке оралу</a>
        </p>
    </div>

    <script>
        function login(event) {
            event.preventDefault();
            alert("Жүйеге кіру формасы толтырылды!");
        }

        function register(event) {
            event.preventDefault();
            alert("Тіркелу формасы толтырылды!");
        }
    </script>
</body>
</html>
```