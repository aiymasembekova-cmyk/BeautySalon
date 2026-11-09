
<?php
// MySQL дерекқорына қосылу мәліметтері
$host = 'localhost';
$dbname = 'beautysalon_db';
$username = 'root';
$password = '';

// PDO арқылы дерекқорға қосылу
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Қателерді көрсету режимі
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Дерекқорға қосылу қатесі: " . $e->getMessage());
}
?>
