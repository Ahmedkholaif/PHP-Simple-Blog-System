<?php

session_start();
require_once('../Data_Base/data_base.php');

//connecting dbaser inserting users



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $path = $_SERVER['DOCUMENT_ROOT'];
    $errors = '';
    $data = '';

    if (empty($_POST['name'])) {
        $errors = ' name';
    } else {
        $name = $_POST['name'];
        $data .= "$name";
        $_SESSION['name'] = $name;
    }

    if (empty($_POST['email'])) {
        $errors .= ',email';
    } else {
        $email = $_POST['email'];
        $data .= " ,$email";
        $_SESSION['email'] = $email;

        // check if e-mail address is well-formed

       // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       //   $emailErr = "Invalid email format";
       // }
    }

    if (empty($_POST['gender'])) {
        $errors .= ',gender';
    } else {
        $gender = $_POST['gender'];
        $data .= ",$gender";
        $_SESSION['gender'] = $gender;
    }

    if (empty($_POST['passwd'])) {
        $errors .= ',password';
    } else {
        $passwd = $_POST['passwd'];

        // check if e-mail address is well-formed
        // if (!filter_var($passwd, FILTER_VALIDATE_passwd)) {
        //     $passwdErr = 'Invalid passwd format';
        // }
    }

    if (!empty($name) && !empty($email) && !empty($gender) && !empty($passwd)) {
        
        $data_obj = new MyDataBase();
        $_SESSION['user_id'] = $data_obj->addToUsers($name,$gender,$email,$passwd);

    } else {
        header("Location: http://localhost/lab4/input_FORMS/signup.php?errors=$errors");
    }
} else {
    // header('Location: http://localhost/lab4/input_FORMS/signup.php');
    exit;
}
?>