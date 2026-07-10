<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// 🔐 перевірка адміна
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user || $user['role'] !== 'admin') {
    die("⛔ Доступ заборонено");
}

// 📊 статистика
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalCars = $pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn();
$totalBookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

// 🚗 бронювання
$stmt = $pdo->query("
    SELECT 
        bookings.*,
        users.name AS user_name,
        cars.brand,
        cars.model,
        cars.image
    FROM bookings
    JOIN users ON bookings.user_id = users.id
    JOIN cars ON bookings.car_id = cars.id
    ORDER BY bookings.id DESC
");

$bookings = $stmt->fetchAll();
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">

    <h2>👑 Адмін панель</h2>

    <!-- 📊 СТАТИСТИКА -->
    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card shadow p-3 text-center">
                <h3><?= $totalUsers ?></h3>
                <p>👤 Користувачі</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 text-center">
                <h3><?= $totalCars ?></h3>
                <p>🚗 Авто</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 text-center">
                <h3><?= $totalBookings ?></h3>
                <p>📦 Бронювання</p>
            </div>
        </div>

    </div>

    <!-- 🚗 БРОНЮВАННЯ -->
    <h3 class="mt-5">🚗 Всі бронювання</h3>

    <div class="row">

        <?php foreach ($bookings as $b): ?>

            <div class="col-md-4 mb-3">

                <div class="card shadow">

                    <img src="assets/img/cars/<?= $b['image'] ?>" class="card-img-top">

                    <div class="card-body">

                        <h5>
                            <?= htmlspecialchars($b['brand'] . ' ' . $b['model']) ?>
                        </h5>

                        <p>
                            👤 <?= htmlspecialchars($b['user_name']) ?><br>
                            📅 <?= $b['start_date'] ?> → <?= $b['end_date'] ?>
                        </p>

                        <!-- статус -->
                        <?php if ($b['status'] == 'confirmed'): ?>
                            <span class="badge bg-success">Підтверджено</span>
                        <?php elseif ($b['status'] == 'canceled'): ?>
                            <span class="badge bg-danger">Відхилено</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Очікує</span>
                        <?php endif; ?>

                        <hr>

                        <!-- ✔ підтвердити -->
                        <a href="update_booking.php?id=<?= $b['id'] ?>&status=confirmed"
                           class="btn btn-success w-100 mb-2">
                            ✔ Підтвердити
                        </a>

                        <!-- ❌ відхилити -->
                        <a href="update_booking.php?id=<?= $b['id'] ?>&status=canceled"
                           class="btn btn-danger w-100">
                            ❌ Відхилити
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>