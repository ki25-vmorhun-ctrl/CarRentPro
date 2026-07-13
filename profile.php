<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// 🔐 перевірка логіну
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 👤 користувач
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    die("Користувача не знайдено");
}

// 🚗 бронювання користувача
$stmt = $pdo->prepare("
    SELECT 
        bookings.*,
        cars.brand,
        cars.model,
        cars.image,
        cars.price
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

    <h2 class="mb-4">👤 Профіль користувача</h2>

    <!-- 👤 INFO -->
    <div class="card shadow p-4 mb-4">

        <p><b>Ім'я:</b>
<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
</p>
        <p><b>Email:</b> <?= htmlspecialchars($user['email']) ?></p>

        <a href="logout.php" class="btn btn-danger mt-3">
            Вийти
        </a>

    </div>

    <!-- 🚗 БРОНЮВАННЯ -->
    <h3 class="mb-3">🚗 Мої бронювання</h3>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">
            ✔ Бронювання скасовано
        </div>
    <?php endif; ?>

    <?php if (count($bookings) === 0): ?>
        <p>У вас ще немає бронювань</p>
    <?php endif; ?>

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
    <b>Вартість:</b>
    $<?= number_format($b['total_price'], 2) ?>
</p>

                        <p>
                            <b>З:</b> <?= $b['date_from'] ?><br>
                            <b>По:</b> <?= $b['date_to'] ?>
                        </p>

                        <p>
                            <b>Статус:</b>
                            <span class="badge bg-warning">
                                <?= $b['status'] ?>
                            </span>
                        </p>

                        <!-- ❌ СКАСУВАТИ -->
                        <a href="cancel_booking.php?id=<?= $b['id'] ?>"
                           class="btn btn-danger w-100 mt-2"
                           onclick="return confirm('Скасувати бронювання?');">
                            ❌ Скасувати
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>