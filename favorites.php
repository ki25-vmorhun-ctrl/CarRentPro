<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// перевірка логіну
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// отримуємо улюблені авто
$sql = "
    SELECT c.*
    FROM favorites f
    JOIN cars c ON f.car_id = c.id
    WHERE f.user_id = ?
    ORDER BY f.id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$favorites = $stmt->fetchAll();
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">

    <h2 class="mb-4">Мої улюблені авто ❤️</h2>

    <div class="row">

        <?php if ($favorites): ?>

            <?php foreach ($favorites as $car): ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow">

                        <img src="<?= htmlspecialchars($car['image']) ?>" class="card-img-top" alt="car">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>
                            </h5>

                            <p>
                                <?= $car['price_per_day'] ?> грн/день
                            </p>

                            <a href="car.php?id=<?= $car['id'] ?>" class="btn btn-primary w-100">
                                Детальніше
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">
                <div class="alert alert-info">
                    У вас ще немає улюблених авто ❤️
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>