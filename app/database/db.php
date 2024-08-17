<?php
session_start();

require 'connect.php'; /*Подключаем */

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}


//Проверка выполнения запроса к бд
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}
//Запрос на получение данных одной таблицы
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";  /*Запрос*/

    if(!empty($params)){ //если параметры непустые
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key = $value ";
            }
            else{
                $sql = $sql . "AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);   /*Подготовка*/
    $query->execute();              /*Выполнение*/

    dbCheckError($query);

    return $query->fetchAll();
}


//Запрос на получение одной строки из конкретной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";  /*Запрос*/

    if(!empty($params)){ //если параметры непустые
        $i = 0;
        foreach($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key = $value ";
            }
            else{
                $sql = $sql . "AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);   /*Подготовка*/
    $query->execute();              /*Выполнение*/
    dbCheckError($query);
    return $query->fetch(); //лимит нужен если через fetchAll
}
$params = [
  'gender' => 1,
    'username' => 'Nataly'
];

//Запись в таблицу БД
function insert($table, $params){
    global $pdo;
    /*$sql="INSERT INTO $table (username, email, password, f_name, l_name, gender, birthday, admin, id_city) VALUES(:user,:mail,:pass,:fname,:lname,:sex,:bday,:adm,:city)" ;*/
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        }else{
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value"."'";
        }
        $i++;
    }

    $sql ="INSERT INTO $table ($coll) VALUES($mask); SELECT SCOPE_IDENTITY()";
    $query = $pdo->prepare($sql);   /*Подготовка*/
    $query->execute($params);              /*Выполнение*/
    dbCheckError($query);
    return $pdo->lastInsertId();
}

function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else{
            $str = $str .", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

function delete($table, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE id =". $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}

//выборка записей с автором в админку
function selectAllFromPostsWithUsers($table1, $table2) {
    global $pdo;
    $sql = "
    SELECT
    t1.id,
    t1.title,
    t1.img,
    t1.content,
    t1.status,
    t1.id_topic,
    t1.created_data,
    t2.username
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id
    ";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//выборка записей на главную с автром
function selectAllFromPostsWithUsersOnIndex($table1, $table2) {
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//поиск по заголовкам и содержимому
function searchInTitleAndContent($text, $table1, $table2) {
    $text = trim(strip_tags(stripslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT
    p.*, u.username 
    FROM $table1 AS p 
    JOIN $table2 AS u 
    ON p.id_user = u.id 
    WHERE p.status=1
    AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

//выборка одной записи на single page с автром
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id) {
    global $pdo;
    $sql = "SELECT p.*, u.username FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}