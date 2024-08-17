<header class="container-fluid">  <!-- Маскимальная ширина 100% -->
    <div class="container">

        <script src="test.js"></script>
        <div class="row">
            <div class="col-2">
                <h1>
                    <a href="<?php echo BASE_URL ?>">EventHive</a>
                </h1>
            </div>

            <div class="col-4">
                <h4 class="text-white">
                    <a href=" ."> .</a>
                </h4>
                <input class="slider" type="range" name="color" min="0" max="100" step="1" value="180" id="color">
                <div class="value"></div>
            </div>

            <!-- <div class="slider-container col-1">
                <input class="slider" type="range" name="color" min="0" max="100" step="1" value="180" id="color">
                <div class="value"></div>
            </div> -->


            <nav class="col-6">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                    <li><a href="switch.php">О нас</a></li>
                    <li><a href="slider.php">Мероприятия</a></li>

                    <li>
                        <?php if (isset($_SESSION['id'])): ?>
                            <a href="#">
                                <i class="fas fa-user"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']): ?>
                                    <li><a href="<?php echo BASE_URL . 'admin/users/index.php'; ?>">Админ панель</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . 'log.php'; ?>">
                                <i class="fas fa-user"></i>
                                Кабинет
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'reg.php'; ?>">Регистрация</a></li>
                            </ul>
                        <?php endif; ?>

                    </li>
                </ul>
            </nav>
        </div>

    </div>
</header>
