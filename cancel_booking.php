<?php
session_start();
require_once __DIR__ . '/includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID не передано");
}

$user_id = $_SESSION['user_id'];
$booking_id = $_GET['id'];

// 🔒 перевіряємо що бронювання належить користувачу
$stmt = $pdo->prepare("
    SELECT * FROM bookings
    WHERE id = ? AND user_id = ?
");

$stmt->execute([$booking_id, $user_id]);
$booking = $stmt->fetch();

if (!$booking) {
    die("Бронювання не знайдено або доступ заборонено");
}

// ❌ видаляємо
$stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
$stmt->execute([$booking_id]);

header("Location: profile.php?deleted=1");
exit();
?>