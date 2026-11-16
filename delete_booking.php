
<?php
require_once 'db.php';

// Өшіру сұранысы POST арқылы келгенін тексеру
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Қате сұраныс!");
}

// Жазылым ID нөмірін алу
$id = $_POST['id'] ?? '';

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Жазылым нөмірі дұрыс емес!");
}

// Дерекқордан жазылымды өшіру
$sql = "DELETE FROM bookings WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Жазылымдар тізіміне қайту
header("Location: manage_bookings.php");
exit;
?>
