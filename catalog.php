<?php
require_once 'includes/db.php';
include 'includes/header.php';

// Пошук
$search = $_GET['search'] ?? '';

// Формуємо запит
if (!empty($search)) {
    $stmt = $pdo->prepare("
        SELECT * FROM cars
        WHERE brand LIKE :search
           OR model LIKE :search
           OR fuel LIKE :search
        ORDER BY price ASC
    ");

    $stmt->execute([
        'search' => "%$search%"
    ]);
} else {
    $stmt = $pdo->query("
        SELECT * FROM cars
        ORDER BY price ASC
    ");
}

$cars = $stmt->fetchAll();
?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold">Каталог автомобілів</h1>
        <p class="text-muted">
            Оберіть автомобіль для оренди
        </p>
    </div>

    <!-- Пошук -->

    <form method="GET" class="row mb-5">

        <div class="col-lg-10">

            <input
                type="text"
                name="search"
                class="form-control form-control-lg"
                placeholder="Пошук за маркою, моделлю або паливом..."
                value="<?= htmlspecialchars($search) ?>">

        </div>

        <div class="col-lg-2">

            <button class="btn btn-warning w-100 btn-lg">

                <i class="bi bi-search"></i>

                Пошук

            </button>

        </div>

    </form>

    <div class="row">

        <?php if(count($cars) > 0): ?>

            <?php foreach($cars as $car): ?>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="card shadow border-0 h-100">

                        <img
                            src="assets/img/cars/<?= $car['image']; ?>"
                            class="card-img-top"
                            style="height:230px;object-fit:cover;">

                        <div class="card-body">

                            <h3>

                                <?= $car['brand']; ?>

                                <?= $car['model']; ?>

                            </h3>

                            <hr>

                            <p>

                                <strong>Рік:</strong>

                                <?= $car['year']; ?>

                            </p>

                            <p>

                                <strong>Паливо:</strong>

                                <?= $car['fuel']; ?>

                            </p>

                            <p>

                                <strong>Коробка:</strong>

                                <?= $car['transmission']; ?>

                            </p>

                            <p>

                                <strong>Місць:</strong>

                                <?= $car['seats']; ?>

                            </p>

                            <h4 class="text-warning">

                                $<?= $car['price']; ?>

                                / доба

                            </h4>

                        </div>

                        <div class="card-footer bg-white border-0">

                            <a
                                href="car.php?id=<?= $car['id']; ?>"
                                class="btn btn-dark w-100">

                                Детальніше

                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="alert alert-warning">

                Автомобілів не знайдено.

            </div>

        <?php endif; ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>