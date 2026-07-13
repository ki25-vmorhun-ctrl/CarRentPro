<?php
session_start();
require_once __DIR__ . '/includes/db.php';


// 🚗 перевірка car_id
if (!isset($_GET['car_id'])) {
    die("Авто не знайдено");
}

$car_id = $_GET['car_id'];

// 📦 отримуємо авто
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$car_id]);
$car = $stmt->fetch();

if (!$car) {
    die("Авто не існує");
}

// 💰 ціна за день
$price_per_day = $car['price'];

// 🔥 обробка форми
if ($_SERVER["REQUEST_METHOD"] === "POST") {

// Якщо користувач не авторизований — просимо увійти
if (!isset($_SESSION['user_id'])) {

    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];

    header("Location: login.php");

    exit();
}
    $user_id = $_SESSION['user_id'] ?? 1;
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $childSeat = isset($_POST['child_seat']);

    // 📅 кількість днів
    $days = (strtotime($end_date) - strtotime($start_date)) / 86400;

    if ($days <= 0) {
        $error = "❌ Невірні дати!";
    } else {

        $total_price = $days * $price_per_day;
        if($childSeat){

         $total_price += $days * 10;

}
        // 🚨 АНТИ-ДВІЙНЕ БРОНЮВАННЯ
        $check = $pdo->prepare("
    SELECT id FROM bookings
    WHERE car_id = ?
    AND status = 'Confirmed'
    AND (
        (date_from <= ? AND date_to >= ?)
    )
");

        $check->execute([$car_id, $end_date, $start_date]);

        if ($check->rowCount() > 0) {

            $error = "❌ Це авто вже заброньоване на ці дати!";

        } else {

            // ✔ вставка бронювання + ЦІНА
            $stmt = $pdo->prepare("
                INSERT INTO bookings
(user_id, car_id, date_from, date_to, status, total_price)
VALUES (?, ?, ?, ?, 'Pending', ?)
");
            $stmt->execute([
                $user_id,
                $car_id,
                $start_date,
                $end_date,
                $total_price
            ]);

            header("Location: profile.php?success=1");
            exit();
        }
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">

    <h2>
        🚗 Бронювання: <?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>
    </h2>

    <p class="text-muted">
        💰 $<?= $price_per_day ?> / day
    </p>

    <!-- ❌ помилка -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <!-- 📅 форма -->
    <form method="POST">

        <label>Дата з</label>
        <input type="date" name="start_date" class="form-control" required>

<label class="mt-2">Час отримання</label>

<input
type="time"
name="start_time"
class="form-control"
value="10:00"
required>

        <label class="mt-2">Дата по</label>
        <input type="date" name="end_date" class="form-control" required>

<label class="mt-2">Час повернення</label>

<input
type="time"
name="end_time"
class="form-control"
value="10:00"
required>

<div class="form-check mt-3">

    <input
        class="form-check-input"
        type="checkbox"
        id="childSeat"
        name="child_seat">

    <label
        class="form-check-label"
        for="childSeat">

        👶 Дитяче крісло (+10 $ / доба)

    </label>

</div>

        <hr>

        <!-- 💰 КАЛЬКУЛЯТОР -->
        <h4>💰 Розрахунок вартості</h4>

        <p>
            Днів: <span id="days">0</span><br>
            Ціна за день: $<?= $price_per_day ?><br>
            <b>Всього: $<span id="total">0</span></b>
        </p>

        <button type="submit" class="btn btn-success w-100 mt-3">
            🚗 Забронювати
        </button>

    </form>

</div>

<!-- 🔥 JS КАЛЬКУЛЯТОР -->
<script>
const startInput = document.querySelector('input[name="start_date"]');
const endInput = document.querySelector('input[name="end_date"]');

const pricePerDay = <?= $price_per_day ?>;

const daysEl = document.getElementById('days');
const totalEl = document.getElementById('total');

function calculate() {

    if (!startInput.value || !endInput.value) {
        daysEl.textContent = 0;
        totalEl.textContent = 0;
        return;
    }

    const start = new Date(startInput.value);
    const end = new Date(endInput.value);

    const diff = (end - start) / (1000 * 60 * 60 * 24);

    if (diff <= 0) {
        daysEl.textContent = 0;
        totalEl.textContent = 0;
        return;
    }

    daysEl.textContent = diff;
    let total = diff * pricePerDay;

if(document.getElementById('childSeat').checked){

    total += diff * 10;

}

totalEl.textContent = total;
}

startInput.addEventListener('change', calculate);
endInput.addEventListener('change', calculate);
document
.getElementById('childSeat')
.addEventListener('change', calculate);

</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
