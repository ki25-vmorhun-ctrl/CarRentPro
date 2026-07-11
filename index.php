<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

register_shutdown_function(function () {
    $e = error_get_last();
    if ($e) {
        echo "<pre>";
        print_r($e);
        echo "</pre>";
    }
});

require_once 'includes/db.php';
include 'includes/header.php';

// Отримуємо 6 доступних автомобілів
$stmt = $pdo->prepare("
    SELECT * FROM cars
    WHERE status='Available'
    ORDER BY id DESC
    LIMIT 6
");
$stmt->execute();
$cars = $stmt->fetchAll();
?>

<!-- ================= HERO ================= -->

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <h1>
                    Орендуйте автомобіль своєї мрії
                </h1>

                <p>
                    Великий вибір автомобілів преміум та економ класу.
                    Швидке бронювання, доступні ціни та якісний сервіс.
                </p>

                <a href="catalog.php" class="btn btn-warning btn-lg">
                    <i class="bi bi-search"></i>
                    Знайти автомобіль
                </a>

                <a href="about.php" class="btn btn-outline-light btn-lg">
                    Детальніше
                </a>

            </div>

        </div>

    </div>

</section>

<!-- ================= POPULAR CARS ================= -->

<section>

<div class="container">

<div class="section-title">

<h2>Популярні автомобілі</h2>

<p>
Оберіть автомобіль для своєї подорожі
</p>

</div>

<div class="row">

<?php foreach($cars as $car): ?>

<div class="col-lg-4 col-md-6 mb-4">

<div class="card shadow border-0 h-100">

<img
src="assets/img/cars/<?= $car['image']; ?>"
class="card-img-top"
style="height:220px;object-fit:cover;">

<div class="card-body">

<h4>

<?= $car['brand']; ?>

<?= $car['model']; ?>

</h4>

<p class="text-muted">

<?= $car['year']; ?>

•

<?= $car['fuel']; ?>

•

<?= $car['transmission']; ?>

</p>

<h3 class="text-warning">

$<?= $car['price']; ?>

<span style="font-size:16px;">
/ доба
</span>

</h3>

<a
href="car.php?id=<?= $car['id']; ?>"
class="btn btn-dark w-100 mt-3">

Детальніше

</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

</section>

<!-- ================= FEATURES ================= -->

<section class="bg-white">

<div class="container">

<div class="section-title">

<h2>Чому обирають нас?</h2>

</div>

<div class="row text-center">

<div class="col-lg-4">

<i class="bi bi-car-front-fill text-warning"
style="font-size:60px;"></i>

<h4 class="mt-3">

Великий автопарк

</h4>

<p>

Понад 100 автомобілів різних класів.

</p>

</div>

<div class="col-lg-4">

<i class="bi bi-lightning-charge-fill text-warning"
style="font-size:60px;"></i>

<h4 class="mt-3">

Швидке бронювання

</h4>

<p>

Оформлення займає менше двох хвилин.

</p>

</div>

<div class="col-lg-4">

<i class="bi bi-shield-check text-warning"
style="font-size:60px;"></i>

<h4 class="mt-3">

Надійність

</h4>

<p>

Усі автомобілі проходять технічний огляд.

</p>

</div>

</div>

</div>

</section>

<!-- ================= FAQ ================= -->

<section class="py-5">

    <div class="container">

        <div class="section-title text-center mb-5">

            <h2>Поширені запитання</h2>

            <p>
                Відповіді на найчастіші питання наших клієнтів
            </p>

        </div>

        <div class="accordion" id="faqAccordion">

            <!-- Питання 1 -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">

                        Які документи потрібні для оренди автомобіля?

                    </button>

                </h2>

                <div id="faq1"
                     class="accordion-collapse collapse show"
                     data-bs-parent="#faqAccordion">

                    <div class="accordion-body">

                        Для оформлення оренди необхідно мати паспорт громадянина України
                        або ID-картку та дійсне водійське посвідчення.

                    </div>

                </div>

            </div>

            <!-- Питання 2 -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2">

                        Чи можна забронювати автомобіль онлайн?

                    </button>

                </h2>

                <div id="faq2"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">

                    <div class="accordion-body">

                        Так. Оберіть автомобіль у каталозі,
                        заповніть форму бронювання та дочекайтеся
                        підтвердження від менеджера.

                    </div>

                </div>

            </div>

            <!-- Питання 3 -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3">

                        Чи входить страхування у вартість оренди?

                    </button>

                </h2>

                <div id="faq3"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">

                    <div class="accordion-body">

                        Так. Усі автомобілі застраховані.
                        Детальні умови страхування можна переглянути
                        під час оформлення замовлення.

                    </div>

                </div>

            </div>

            <!-- Питання 4 -->

            <div class="accordion-item">

                <h2 class="accordion-header">

                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4">

                        Чи можна повернути автомобіль в іншому місті?

                    </button>

                </h2>

                <div id="faq4"
                     class="accordion-collapse collapse"
                     data-bs-parent="#faqAccordion">

                    <div class="accordion-body">

                        Так, така послуга доступна.
                        Її вартість залежить від міста повернення
                        та узгоджується під час бронювання.

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= PARTNERS ================= -->

<section class="py-5 bg-white">

    <div class="container">

        <div class="section-title text-center mb-5">

            <h2>Наші партнери</h2>

            <p>
                Ми співпрацюємо з перевіреними компаніями для забезпечення
                якісного сервісу та безпеки наших клієнтів.
            </p>

        </div>

        <div class="row text-center">

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card shadow border-0 h-100 p-4">

                    <i class="bi bi-fuel-pump-fill text-warning"
                       style="font-size:60px;"></i>

                    <h5 class="mt-3">
                        Shell
                    </h5>

                    <p class="text-muted">
                        Паливний партнер
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card shadow border-0 h-100 p-4">

                    <i class="bi bi-tools text-warning"
                       style="font-size:60px;"></i>

                    <h5 class="mt-3">
                        Bosch Service
                    </h5>

                    <p class="text-muted">
                        Технічне обслуговування
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card shadow border-0 h-100 p-4">

                    <i class="bi bi-shield-check text-warning"
                       style="font-size:60px;"></i>

                    <h5 class="mt-3">
                        Michelin
                    </h5>

                    <p class="text-muted">
                        Надійні шини
                    </p>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card shadow border-0 h-100 p-4">

                    <i class="bi bi-geo-alt-fill text-warning"
                       style="font-size:60px;"></i>

                    <h5 class="mt-3">
                        WOG
                    </h5>

                    <p class="text-muted">
                        Всеукраїнська мережа АЗС
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- ================= REVIEWS ================= -->

<section class="py-5 bg-light">

    <div class="container">

        <div class="section-title text-center mb-5">
            <h2>Відгуки наших клієнтів</h2>
            <p>Що говорять про нас люди</p>
        </div>

        <div class="row">

            <div class="col-lg-4 mb-4">

                <div class="card h-100 shadow border-0">

                    <div class="card-body">

                        <h5>⭐️⭐️⭐️⭐️⭐️</h5>

                        <p>
                            "Дуже швидке бронювання. Автомобіль був у
                            відмінному стані. Рекомендую!"
                        </p>

                        <h6 class="mt-4 mb-0">
                            — Олександр
                        </h6>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 mb-4">

                <div class="card h-100 shadow border-0">

                    <div class="card-body">

                        <h5>⭐️⭐️⭐️⭐️⭐️</h5>
<p>
                            "Все чесно, без прихованих платежів.
                            Дуже привітний персонал."
                        </p>

                        <h6 class="mt-4 mb-0">
                            — Ірина
                        </h6>

                    </div>

                </div>

            </div>

            <div class="col-lg-4 mb-4">

                <div class="card h-100 shadow border-0">

                    <div class="card-body">

                        <h5>⭐️⭐️⭐️⭐️⭐️</h5>

                        <p>
                            "Орендував BMW на вихідні.
                            Все пройшло чудово, обов'язково звернусь ще."
                        </p>

                        <h6 class="mt-4 mb-0">
                            — Владислав
                        </h6>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>