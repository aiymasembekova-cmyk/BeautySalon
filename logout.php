
<?php
session_start();

// Сессиядағы барлық мәліметті өшіру
$_SESSION = array();

// Сессияны жою
session_destroy();

// Кіру бетіне қайтару
header('Location: login.php');
exit;
?>
