<?php
include "../../path.php";
include "../../app/controllers/posts.php";
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

    <link rel="stylesheet" href="../../assets/css/admin.css">


    <title>My events</title>
</head>
<body>

<?php include("../../app/include/header-admin.php"); ?>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->


<div class="container">
    <div class="row">
    <?php include "../../app/include/sidebar-admin.php"; ?>
        <div class="posts col-8">
            <div class="button row">
                <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class="admin-bth col-3 btn-warning">Создать</a>
                <span class="col-1"></span>
                <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-4 admin-bth btn-warning">Редактировать</a>
            </div>
            <div class="row title-table">
                <h2>Добавление записи</h2>
            </div>
            <div class="row add-post">
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div class="col mb-2">
                        <input name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
                    </div>
                    <div class="col mb-2">
                        <label for="editor" class="form-label">Содержимое записи</label>
                        <textarea id="editor" name="content" class="form-control" rows="6"></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-2">
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        <label for="inputGroupFile02" class="input-group-text">Загрузить</label>
                    </div>
                    <select name="topic" class="form-select mb-4" aria-label="Default select example">
                        <option selected>Выбрать категорию:</option>
                        <?php foreach ($topics as $key => $topic): ?>
                            <option value="<?=$topic['id'];?>"><?=$topic['name'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="col col-6">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="publish" checked>
                        <label class="form-check-label" for="flexCheckChecked">Публиковать</label>
                    </div>
                    <div class="col col-6">
                        <button name="add_post" class="btn btn-warning" type="submit">Добавить запись</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--FOOTER-->
<?php include("../../app/include/footer.php"); ?>
<!--FOOTER end-->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!--добавление визуального редактора к текстовому полю админки(не получилось добавить)-->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="../../assets/js/script.js"></script>

</body>
</html>
