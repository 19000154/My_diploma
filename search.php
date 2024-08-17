<?php
include "path.php";
include SITE_ROOT . '/app/database/db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search-term"])) {
    $posts = searchInTitleAndContent($_POST["search-term"], 'posts', 'users');
}
?>

<!doctype html>
<html lang="ru">
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

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

<!--БЛОК main-->
<div class="container">
    <div class="content row">
    <!-- main content -->
        <div class="main-content col-12">
            <h2>Результаты поиска</h2>
            <?php foreach ($posts as $post) : ?>
            <div class="post row">
                <div class="img col-12 col-md-4">
                    <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img']; ?>" alt="<?=$post['title']?>" class="img-thumbnail">
                </div>
                <div class="post_text col-12 col-md-8">
                    <h3>
                        <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?= substr($post['title'], 0, 120) . '...' ?></a>
                    </h3>
                    <i class="far fa-user"> <?=$post['username']; ?> </i>
                    <i class="far fa-calendar"> <?=$post['created_data']; ?> </i>
                    <p class="prewiew-text">
                        <?=mb_substr($post['content'], 0, 150, 'UTF-8') . '...' ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

    </div>

</div>
<!--БЛОК main end-->

<!--FOOTER-->
<?php include("app/include/footer.php"); ?>
<!--FOOTER end-->

</body>
</html>