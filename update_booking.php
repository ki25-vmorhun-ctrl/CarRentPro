<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// 🔐 тільки адмін
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($user['role'] !== 'admin') {
    die("⛔ Нема доступу");
}

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Invalid request");
}

$id = $_GET['id'];
$status = $_GET['status'];

// 🔄 оновлення статусу
$stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

header("Location: admin.php");
exit();
?>