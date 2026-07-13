<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (
    empty($first_name) ||
    empty($last_name) ||
    empty($email) ||
    empty($password)
       ) 

    {
        $error = "Заповніть всі поля!";
    } else {

        // перевірка email
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            $error = "Такий email вже існує!";
        } else {

            // хеш пароля
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // вставка
            $stmt = $pdo->prepare("
    INSERT INTO users
    (first_name, last_name, email, password)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([
    $first_name,
    $last_name,
    $email,
    $hash
]);

            header("Location: login.php");
            exit();
        }
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h3 class="text-center mb-4">Реєстрація</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <div class="mb-3">

    <label>Ім'я</label>

    <input
        type="text"
        name="first_name"
        class="form-control"
        required>

</div>

<div class="mb-3">

    <label>Прізвище</label>

    <input
        type="text"
        name="last_name"
        class="form-control"
        required>

</div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Пароль</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Зареєструватися
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>