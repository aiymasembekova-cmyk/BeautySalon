
<?php
session_start();

// Пайдаланушы жүйеге кіргенін тексеру
if (!isset($_SESSION['user_id'])) {

    // Кірмеген болса, login бетіне жіберу
    header('Location: login.php');
    exit;
}
?>
