<?php
session_start();
require_once('../Data_Base/data_base.php');
//connecting dbase


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = '';

    if (empty($_POST['email'])) {
        $errors .= ',e';
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['passwd'])) {
        $errors .= ',p';
    } else {
        $passwd = $_POST['passwd'];
    }

    if (!empty($email) && !empty($passwd)) {

        
        $data_obj = new MyDataBase();
        $data_obj->checkUser($email,$passwd);
    }
     else {
        header("Location: http://localhost/lab4/input_FORMS/signin.php?errors=$errors");
    }
}
 else {
    header("Location: http://localhost/lab4/input_FORMS/signin.php");
    exit;
}