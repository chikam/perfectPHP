<?php

$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('データベースに接続できません：'.mysql_error());
}

mysql_select_db('oneline_bbs', $link);

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = null;
    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力してください';
    } elseif (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前は40文字以内で入力してください';
    } else {
        $name = $_POST['name'];
    }

    $comment = null;
    if (!isset($_POST['comment']) || !strlen($_POST['comment'])) {
        $errors['comment'] = 'ひとことを入力してください';
    } elseif (strlen($_POST['comment']) > 200) {
        $errors['comment'] = 'ひとことは200文字以内で入力してください';
    } else {
        $comment = $_POST['comment'];
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO `post` (`name`, `comment`, `created_at`) VALUES ('"
        .mysql_real_escape_string($name)."','"
        .mysql_real_escape_string($comment)."','"
        .date('Y-m-d H:i:s')."')";

        mysql_query($sql, $link);
        mysql_close($link);
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    }
}

$sql = 'SELECT * FROM `post` ORDER BY `created_at` DESC';
$result = mysql_query($sql, $link);
$post = array();
if ($result !== false && mysql_num_rows($result)) {
    while ($post = mysql_fetch_assoc($result)) {
        $posts[] = $post;
    }
}
mysql_free_result($result);
mysql_close($link);

include 'views/bbs_views.php';
