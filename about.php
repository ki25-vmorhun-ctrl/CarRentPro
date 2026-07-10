<?php
session_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Про нас - CarRentPro</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        /* TOP MENU */
        .nav {
            background: #222;
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav a:hover {
            color: #1abc9c;
        }

        /* HERO */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)),
            url('assets/img/car-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 110px 20px;
        }

        .hero h1 {
            font-size: 44px;
            margin-bottom: 10px;
        }

        .hero p {
            max-width: 800px;
            margin: auto;
            font-size: 18px;
            line-height: 1.6;
        }

        /* CONTENT */
        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card h2 {
            margin-top: 0;
            color: #222;
        }

        .card p {
            line-height: 1.7;
            color: #444;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .box h3 {
            color: #1abc9c;
            margin-bottom: 10px;
        }

        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

<!-- NAVBAR (вбудований, без файлів) -->
<div class="nav">
    <a href="index.php">Головна</a>
    <a href="about.php">Про нас</a>
    <a href="login.php">Увійти</a>
</div>

<!-- HERO -->
<div class="hero">
    <h1>Про CarRentPro</h1>
    <p>
        Сучасний сервіс оренди автомобілів, який дозволяє швидко, зручно та безпечно
        орендувати авто онлайн без зайвих складнощів.
    </p>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="card">
        <h2>Хто ми</h2>
        <p>
            CarRentPro — це онлайн платформа для оренди автомобілів, яка дозволяє користувачам
            швидко знаходити та бронювати авто без дзвінків і паперових договорів.
        </p>
        <p>
            Ми створили сервіс, який спрощує процес оренди: ти обираєш авто, бронюєш і одразу отримуєш підтвердження.
        </p>
    </div>

    <div class="card">
        <h2>Наша місія</h2>
        <p>
            Зробити оренду авто такою ж простою, як замовлення таксі.
            Ми хочемо, щоб кожен міг легко отримати транспорт тоді, коли він потрібен.
        </p>
    </div>

    <div class="card">
        <h2>Чому обирають нас</h2>

        <div class="grid">
            <div class="box">
                <h3>🚗 Авто</h3>
                <p>Великий вибір машин</p>
            </div>

            <div class="box">
                <h3>⚡ Швидкість</h3>
                <p>Бронювання за 2 хвилини</p>
            </div>

            <div class="box">
                <h3>🔒 Надійність</h3>
                <p>Безпечна система</p>
            </div>

            <div class="box">
                <h3>💰 Ціни</h3>
                <p>Без прихованих платежів</p>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Як це працює</h2>
        <p>
            1. Обери автомобіль<br>
            2. Вкажи дату<br>
            3. Підтвердь бронювання<br>
            4. Отримай авто
        </p>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    © <?php echo date("Y"); ?> CarRentPro. Всі права захищені.
</div>

</body>
</html>