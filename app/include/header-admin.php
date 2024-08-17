<header class="container-fluid">  <!-- Маскимальная ширина 100% -->
    <div class="container">
        
        <script src="test.js"></script>
        <div class="row">
            <div class="col-2">
                <h1>
                    <a href="<?php echo BASE_URL ?>">EventHive</a>
                </h1>
            </div>

            <!-- <div class="col-4">
                <h4>
                    <a href=" ."> .</a>
                </h4>
                <input class="slider2" type="range" name="color" min="0" max="100" step="1" value="180" id="color">
                <div class="value"></div>
            </div> -->

            <nav class="col">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                           <?php echo $_SESSION['login']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . "logout.php"; ?>">Выход</a>
                    </li>
            </nav>
        </div>
    </div>
</header>
