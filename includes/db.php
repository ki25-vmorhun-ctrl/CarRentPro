<?php
// =====================================
// CarRent Pro
// Підключення до бази даних через PDO
// =====================================

require_once(__DIR__ . '/../config.php');

try {

    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    $pdo = new PDO(
        $dsn,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

} catch (PDOException $e) {

    die("
        <div style='
            font-family: Arial;
            width:600px;
            margin:80px auto;
            padding:30px;
            border-radius:10px;
            background:#ffe6e6;
            border:1px solid red;
            text-align:center;
        '>

            <h2>❌ Помилка підключення до бази даних</h2>

            <p>" . $e->getMessage() . "</p>

        </div>
    ");

}
?>