<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav style="background:#222; padding:15px;">
    <div style="max-width:1000px; margin:0 auto; display:flex; justify-content:space-between; align-items:center;">

        <!-- Лого -->
        <a href="index.php" style="color:white; text-decoration:none; font-size:20px;">
            🚗 CarRent
        </a>

        <!-- Меню -->
        <div>
            <a href="index.php" style="color:white; margin-right:15px; text-decoration:none;">Головна</a>
            <a href="about.php" style="color:white; margin-right:15px; text-decoration:none;">Про нас</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Якщо користувач увійшов -->
                <a href="profile.php" style="color:#00ff99; margin-right:15px; text-decoration:none;">
                    Профіль
                </a>

                <a href="logout.php" style="color:#ff6666; text-decoration:none;">
                    Вийти
                </a>
            <?php else: ?>
                <!-- Якщо НЕ увійшов -->
                <a href="login.php" style="color:white; margin-right:15px; text-decoration:none;">
                    Увійти
                </a>

                <a href="register.php" style="color:white; text-decoration:none;">
                    Реєстрація
                </a>
            <?php endif; ?>
        </div>

    </div>
</nav>