<?php
include SITE_ROOT . '/app/database/db.php';

$errMsg = [];
$users = selectAll('users');

function userAuth($user){
    $_SESSION['id'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];

    if ($_SESSION['admin']){
        header('Location: ' . BASE_URL . 'admin/users/index.php');
    }else{
        header('Location: ' . BASE_URL);
    }
}
//регистрация
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if ($login === '' || $email === '' || $passF === '') {
        array_push($errMsg,"Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2) {
        array_push($errMsg, "В названии статьи должно быть более 2 символов!");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли должны совпадать!");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if (empty($existence)) {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);

        }else{
            array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован!");
        }
    }
}else{
    $login = '';
    $email = '';
}

//вход
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    if ($email === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены!");
//        exit();
    }else{
        $existence = selectOne('users', ['email' => $email]);
//            tt($existence);
//    exit();
        if ($existence && password_verify($pass, $existence['password'])) {
            userAuth($existence);
        }else{
            array_push($errMsg, "Почта или пароль введены неверно!");
        }
    }
}else{
    $email = '';
}

//добавление пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if ($login === '' || $email === '' || $passF === '') {
        array_push($errMsg,"Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2) {
        array_push($errMsg, "В названии статьи должно быть более 2 символов!");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли должны совпадать!");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if (empty($existence)) {
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id]);
            userAuth($user);

        }else{
            array_push($errMsg,"Пользователь с такой почтой уже зарегистрирован!");
        }
    }
}else{
    $login = '';
    $email = '';
}

//удаление пользователя
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}

//редактирование пользователя через админку
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){
    $user = selectOne('users', ['id' => $_GET['edit_id']]);
    $id = $user['id'];
    $email_edit = $user['email'];
    $admin = $user['admin'];
    $username = $user['username'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])) {
    $id = $_POST['id'];
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    $admin = isset($_POST['publish']) ? 1 : 0;

    if ($login === '') {
        array_push($errMsg,"Не все поля заполнены!");
    }elseif (mb_strlen($login, 'UTF-8') < 2) {
        array_push($errMsg, "Логин должен быть более 2 символов!");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Пароли должны совпадать!");
    }else{
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) $admin = 1;
        $user = [
            'admin' => $admin,
            'username' => $login,
//            'email' => $email,
            'password' => $pass
        ];
        $user = update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}else{
    $login ='';
    $email = '';

}

//if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
//    $id = $_GET['pub_id'];
//    $publish = $_GET['publish'];
//    $postId = update('posts', $id, ['status' => $publish]);
//    header('location: ' . BASE_URL . 'admin/posts/index.php');
//    exit();
//}