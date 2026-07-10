<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// перевірка ID авто
if (!isset($_GET['id'])) {
    die("Авто не знайдено");
}

$car_id = $_GET['id'];

// отримуємо авто
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$car_id]);
$car = $stmt->fetch();

if (!$car) {
    die("Авто не існує");
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">

    <div class="row">

        <!-- Фото -->
        <div class="col-md-6">
            <img src="assets/img/cars/<?= $car['image'] ?>" class="img-fluid rounded shadow">
        </div>

        <!-- Інформація -->
        <div class="col-md-6">

            <h2><?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?></h2>

            <h4 class="text-primary">
                <?= $car['price_per_day'] ?> $ / день
            </h4>

            <p class="mt-3">
                <?= htmlspecialchars($car['description'] ?? 'Опис відсутній') ?>
            </p>

            <hr>

            <!-- 🔥 БРОНЮВАННЯ -->
            <a href="booking.php?car_id=<?= $car['id'] ?>" class="btn btn-primary w-100 mb-2">
                Забронювати
            </a>

            <!-- ❤️ УЛЮБЛЕНІ -->
            <a href="add_favorite.php?car_id=<?= $car['id'] ?>" class="btn btn-danger w-100">
                ❤️ Додати в улюблені
            </a>

        </div>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>