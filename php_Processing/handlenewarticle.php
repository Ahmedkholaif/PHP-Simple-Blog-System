<?php

session_start();
require_once('../Data_Base/data_base.php');
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('Location: http://localhost/lab4/input_FORMS/signin.php');
    exit;
}
//connecting dbase




$activeUser = $_SESSION['user_id'];
$article = '';
$title = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article = $_POST['new_article'];
    $title = $_POST['title'];

    if(!empty($article) && !empty($title)) {
        try {
        $data_obj = new MyDataBase();
        $data_obj->setNewArticle($title,$article,$activeUser);

        } catch(Exception $e) {
            $errors = "bad sql";
            header("Location: http://localhost/lab4/input_FORMS/newarticle.php?errors=$errors");
        }
    }
    else {
        header("Location: http://localhost/lab4/input_FORMS/newarticle.php?errors=$errors");
    }

} else {
    header('Location: http://localhost/lab4/Html_Views/MySitePage.php');
    exit;
}
