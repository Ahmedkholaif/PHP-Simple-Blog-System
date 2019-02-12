<?php session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Simple Blog Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="../Styling/main.css" />
    <style>
    .error {
        color: #FF0000;
    }
    </style>
</head>

<body>

    <?php

if (!empty($_GET['errors'])) {
    $errors = $_GET['errors'];
    $invalid = 'Enter Your Data';
    if (strpos($errors, 'invalid')) {
        $invalid = 'invalid data';
    }
}
?>

<div class="container signin">

    <h1 class="signin area"> SIGN IN HERE </h1>

    <p> <span class="error"> * required field </span> </p>

    <form class="form " method="POST" action="../php_Processing/signinprocess.php">
 
    *
    <input class="input-group" type="text" name="email" placeholder="E-mail "
        value="<?php if (isset($errors) && isset($_SESSION['email'])) {
    echo $_SESSION['email'];
} ?>">
            <span class="error">
                <?php if (isset($errors) && strpos($errors, 'email')) {
    echo 'Please Enter Your E-mail';
} ?></span>

    <br><br>*
    <input class="input-group" type="password" placeholder="Password " name="passwd">
    <span class="error">
        <?php if (isset($errors) && strpos($errors, 'passwd')) {
    echo 'Please Enter Your password'."<br><br>";
} ?>
    <?php if (isset($errors)) {
    echo $invalid."<br><br>";
} ?>
    <a href = "http://localhost/lab4/input_FORMS/signup.php "> Don't have an account sign up here </a> 
    <br><br><br>
    <input class="registerbtn btn-primary but-submit" type="submit" name="submit" value="Submit">

    </form>

    </div>
</body>

</html>