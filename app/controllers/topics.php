<?php

include SITE_ROOT . '/app/database/db.php';

$errMsg = '';
$id = '';
$name = '';
$description = '';
$topics = selectAll('topics');


//код для формы создания категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){

//    tt($_POST);

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if ($name === '' || $description === '') {
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($name, 'UTF-8') < 2) {
        $errMsg = "В названии категории должно быть более 2-х символов!";
    }else{
        $existence = selectOne('topics', ['name' => $name]);
        if ($existence['name'] === $name){
            $errMsg = "Такая категория уже есть в базе";
        }else{
            $topic = [
                'name' => $name,
                'description' => $description
            ];
            $id = insert('topics', $topic);
            $user = selectOne('users', ['id' => $id]);
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    }

}else{
    $name = '';
    $description = '';
}

//редактирование категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'];
    $topic = selectOne('topics', ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if ($name === '' || $description === '') {
        $errMsg = "Не все поля заполнены!";
    }elseif (mb_strlen($name, 'UTF-8') < 2) {
        $errMsg = "В названии категории должно быть более 2-х символов!";
    }else{
            $topic = [
                'name' => $name,
                'description' => $description
            ];
            $id = $_POST['id'];
            //update в db.php создать
            $topic_id = update('topics', $id, $topic);
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
}

//удаление категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){
    $id = $_GET['del_id'];
    delete('topics', $id);
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}