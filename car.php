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
                <?= $car['price'] ?> $ / день
            </h4>

            <p class="mt-3">
                <?= htmlspecialchars($car['description'] ?? 'Опис відсутній') ?>
            </p>

            <hr>

<!-- ================= CAR SPECIFICATIONS ================= -->

<h4 class="mt-4 mb-3">
    Характеристики
</h4>

<div class="row g-3">

    <div class="col-6">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-calendar-event text-warning fs-2"></i>
            <h6 class="mt-2">Рік</h6>
            <strong><?= $car['year'] ?></strong>
        </div>
    </div>

    <div class="col-6">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-fuel-pump text-warning fs-2"></i>
            <h6 class="mt-2">Паливо</h6>
            <strong><?= $car['fuel'] ?></strong>
        </div>
    </div>

    <div class="col-6">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-gear text-warning fs-2"></i>
            <h6 class="mt-2">Коробка</h6>
            <strong><?= $car['transmission'] ?></strong>
        </div>
    </div>

    <div class="col-6">
        <div class="card border-0 shadow-sm p-3 text-center">
            <i class="bi bi-car-front-fill text-warning fs-2"></i>
            <h6 class="mt-2">Статус</h6>
            <strong><?= $car['status'] ?></strong>
        </div>
    </div>

</div>

<!-- ================= EQUIPMENT ================= -->

<h4 class="mt-5 mb-3">
    Комплектація
</h4>

<div class="row g-3">

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-snow text-primary fs-4 me-2"></i>
            <span>Клімат-контроль</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-bluetooth text-primary fs-4 me-2"></i>
            <span>Bluetooth</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-geo-alt-fill text-primary fs-4 me-2"></i>
            <span>GPS-навігація</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-camera-fill text-primary fs-4 me-2"></i>
            <span>Камера заднього виду</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-usb-symbol text-primary fs-4 me-2"></i>
            <span>USB / AUX</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-thermometer-snow text-primary fs-4 me-2"></i>
            <span>Підігрів сидінь</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-shield-check text-primary fs-4 me-2"></i>
            <span>ABS та ESP</span>
        </div>
    </div>

    <div class="col-6">
        <div class="d-flex align-items-center">
            <i class="bi bi-music-note-beamed text-primary fs-4 me-2"></i>
            <span>Мультимедійна система</span>
        </div>
    </div>

</div>

<hr class="my-4">

            <!-- 🔥 БРОНЮВАННЯ -->
            <a href="booking.php?car_id=<?= $car['id'] ?>" class="btn btn-primary w-100 mb-2">
                Забронювати
            </a>

            <!-- ❤️ УЛЮБЛЕНІ -->
            <a href="add_favorite.php?car_id=<?= $car['id'] ?>" class="btn btn-danger w-100">
                ❤️ Додати в улюблені
            </a>
<hr class="my-4">

<h3 class="mb-3">📅 Календар доступності</h3>

<div class="card shadow-sm p-3 mb-4">

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th>Нд</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td></td>
                <td>1</td>
                <td class="table-success">2</td>
                <td class="table-success">3</td>
                <td class="table-danger">4</td>
                <td class="table-danger">5</td>
                <td class="table-success">6</td>
            </tr>

            <tr>
                <td class="table-success">7</td>
                <td class="table-success">8</td>
                <td class="table-danger">9</td>
                <td class="table-danger">10</td>
                <td class="table-success">11</td>
                <td class="table-success">12</td>
                <td class="table-success">13</td>
            </tr>

        </tbody>

    </table>

    <div class="mt-2">
        <span class="badge bg-success">Доступно</span>
        <span class="badge bg-danger ms-3">Заброньовано</span>
    </div>

</div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
