<?php include("path.php");
include 'app/controllers/users.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--    &lt;!&ndash; Подключение Bootstrap CSS через CDN &ndash;&gt;-->
    <!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!--Custom styling-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">


    <title>My events</title>
</head>
<body>


<?php include("app/include/header.php"); ?>

<!--END header-->

<!--FORM reg-->
<div class="container reg_form">

<!--    slider-->
<!--    <div class="slider-container">-->
<!--        <input class="slider" type="range" name="color" min="0" max="100" step="1" value="180" id="color">-->
<!--        <div class="value">180</div>-->
<!--    </div>-->
<!---->
<!--    <script src="test.js"></script>-->
<!--    slider end-->

    <form class="row justify-content-center" method="post" action="log.php">
        <h2 class="col-12">Авторизация</h2>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Введите почту</label>
            <input name="email" value="<?=$email;?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите вашу почту">
        </div>
        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите ваш пароль">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button name="button-log" type="submit" class="btn btn-warning">Войти</button>
            <a href="reg.php">Зарегистрироваться</a>
        </div>
    </form>
</div>
<!--END FORM-->

<!--FOOTER-->
<?php include("app/include/footer.php"); ?>
<!--FOOTER end-->

</body>
</html>