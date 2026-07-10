<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// 🔐 перевірка логіну
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 📦 отримуємо всі бронювання користувача + авто
$stmt = $pdo->prepare("
    SELECT 
        bookings.*,
        cars.brand,
        cars.model,
        cars.image
    FROM bookings
    JOIN cars ON bookings.car_id = cars.id
    WHERE bookings.user_id = ?
    ORDER BY bookings.id DESC
");

$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll();
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">

    <h2>📋 Мої бронювання</h2>

    <?php if (empty($bookings)): ?>
        <div class="alert alert-info mt-3">
            У вас ще немає бронювань
        </div>
    <?php endif; ?>

    <?php foreach ($bookings as $b): ?>

        <div class="card mb-3 shadow p-3">

            <div class="row">

                <div class="col-md-4">
                    <img src="assets/img/cars/<?= $b['image'] ?>" class="img-fluid rounded">
                </div>

                <div class="col-md-8">

                    <h4>
                        <?= htmlspecialchars($b['brand'] . ' ' . $b['model']) ?>
                    </h4>

                    <p>
                        📅 <?= $b['start_date'] ?> → <?= $b['end_date'] ?>
                    </p>

                    <!-- 💰 ОЦЕ ГОЛОВНЕ -->
                    <h5 class="text-success">
                        💰 Total: $<?= $b['total_price'] ?>
                    </h5>

                    <span class="badge bg-warning">
                        <?= $b['status'] ?>
                    </span>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>