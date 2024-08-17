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
            <div class="row title-table">
                <h2>Редактирование записи</h2>
            </div>
            <div class="row add-post">
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?=$id;?>">
                    <div class="col mb-4">
                        <input value="<?=$post['title'];?>" name="title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
                    </div>
                    <div class="col">
                        <label for="editor" class="form-label">Содержимое записи</label>
                        <textarea name="content" id="editor" class="form-control" rows="6"><?=$post['content'];?></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-4">
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        <label for="inputGroupFile02" class="input-group-text">Загрузить</label>
                    </div>
                    <select name="topic" class="form-select mb-2" aria-label="Default select example">
                        <?php foreach ($topics as $key => $topic): ?>
                            <option value="<?=$topic['id'];?>"><?=$topic['name'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="col col-6">
                        <?php if (empty($publish) && $publish == 0): ?>
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="publish">
                        <label class="form-check-label" for="flexCheckChecked">Публиковать</label>
                        <?php else: ?>
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="publish">
                        <label class="form-check-label" for="flexCheckChecked">Публиковать</label>
                        <?php endif; ?>
                    </div>
                    <div class="col col-6">
                        <button name="edit_post" class="btn btn-warning" type="submit">Сохранить запись</button>
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
<!--<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>-->
<!--<script src="../../assets/js/script.js"></script>-->

</body>
</html>
