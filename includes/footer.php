<footer class="bg-dark text-white mt-5 pt-5 pb-3">

    <div class="container">

        <div class="row">

            <!-- Про компанію -->
            <div class="col-lg-4 mb-4">

                <h4 class="text-warning">
                    <i class="bi bi-car-front-fill"></i>
                    CarRent Pro
                </h4>

                <p class="mt-3">
                    Сучасний сервіс онлайн-оренди автомобілів.
                    Великий вибір авто, швидке бронювання
                    та найкращі ціни.
                </p>

            </div>

            <!-- Меню -->
            <div class="col-lg-4 mb-4">

                <h5>Навігація</h5>

                <ul class="list-unstyled">

                    <li>
                        <a class="text-white text-decoration-none"
                           href="<?= BASE_URL ?>">
                            Головна
                        </a>
                    </li>

                    <li>
                        <a class="text-white text-decoration-none"
                           href="<?= BASE_URL ?>catalog.php">
                            Автомобілі
                        </a>
                    </li>

                    <li>
                        <a class="text-white text-decoration-none"
                           href="<?= BASE_URL ?>about.php">
                            Про нас
                        </a>
                    </li>

                    <li>
                        <a class="text-white text-decoration-none"
                           href="<?= BASE_URL ?>contacts.php">
                            Контакти
                        </a>
                    </li>

                </ul>

            </div>

            <!-- Контакти -->
            <div class="col-lg-4 mb-4">

                <h5>Контакти</h5>

                <p>
                    <i class="bi bi-geo-alt-fill text-warning"></i>
                    Київ, Україна
                </p>

                <p>
                    <i class="bi bi-telephone-fill text-warning"></i>
                    +380 99 123 45 67
                </p>

                <p>
                    <i class="bi bi-envelope-fill text-warning"></i>
                    info@carrentpro.com
                </p>

                <div class="fs-4">

                    <a href="#" class="text-white me-3">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" class="text-white me-3">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" class="text-white me-3">
                        <i class="bi bi-telegram"></i>
                    </a>

                </div>

            </div>

        </div>

        <hr>

        <div class="text-center">

            © <?= date('Y') ?> CarRent Pro.
            Всі права захищені.

        </div>

    </div>

</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<!-- Наш JS -->
<script src="<?= BASE_URL ?>assets/js/main.js"></script>

</body>
</html>