
<?php
$search = "";

$services = [
    "Шаш қию",
    "Маникюр",
    "Макияж"
];

$result = [];

if (isset($_GET["search"])) {

    $search = trim($_GET["search"]);

    foreach ($services as $service) {

        if (stripos($service, $search) !== false) {
            $result[] = $service;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Қызмет іздеу | BeautySalon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>
<main class="search-container">

    <h2>Қызмет іздеу</h2>

    <p>Өзіңізге қажетті сұлулық қызметін табыңыз</p>

    <form method="GET" action="search.php" class="search-form">

        <input
            type="text"
            name="search"
            placeholder="Қызмет атауын енгізіңіз..."
            value="<?= htmlspecialchars($search) ?>"
        >

        <button type="submit">Іздеу</button>

    </form>
<div class="service-cards">

    <div class="service-card">
        <img src="images/haircut.jpg" alt="Шаш қию">
        <h3>Шаш қию</h3>
        <p>Бағасы: 3000 ₸</p>
    </div>

    <div class="service-card">
        <img src="images/manicure.jpg" alt="Маникюр">
        <h3>Маникюр</h3>
        <p>Бағасы: 4000 ₸</p>
    </div>

    <div class="service-card">
        <img src="images/makeup.jpg" alt="Макияж">
        <h3>Макияж</h3>
        <p>Бағасы: 6000 ₸</p>
    </div>

</div>
    <?php if ($search != ""): ?>

        <div class="search-results">

            <h3>Іздеу нәтижесі</h3>

            <?php if (!empty($result)): ?>

                <?php foreach ($result as $service): ?>
                    <div class="service-result">
                        <?= htmlspecialchars($service) ?>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>

                <p>Мұндай қызмет табылмады.</p>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
