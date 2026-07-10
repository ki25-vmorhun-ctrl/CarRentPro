<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 🔍 шукаємо користувача
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // 🔐 перевірка пароля
    if ($user && password_verify($password, $user['password'])) {

        // 💾 СЕСІЯ (ВАЖЛИВО)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // 🔥 ОЦЕ БУЛО ВІДСУТНЄ

        // 🚗 редірект по ролі
        if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: profile.php");
        }

        exit();

    } else {
        $error = "Невірний email або пароль!";
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h3 class="text-center mb-4">Вхід</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Увійти
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>