
<?php
session_start();

// Пайдаланушы жүйеге кіргенін тексеру
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Администратор екенін тексеру
function requireAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        http_response_code(403);
        exit('Бұл бетке тек администратор кіре алады!');
    }
}
?>
