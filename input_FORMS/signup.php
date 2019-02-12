<?php session_start();
unset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Simple Blog Site </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="bootstrap.min.css" />
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
    if (strpos($errors, 'gender') && isset($_SESSION['gender'])) {
        $gender = $_SESSION['gender'];
    }
    if(strpos($errors ,"duplicate")){
        $s ="Already Found In System";
    }
} else {
    session_destroy();
    $_SESSION =array();
}
?>

<div class="container signin">

    <h1 class="signin ">PHP Registeration </h1>


    <p> <span class="error"> * required field </span> </p>

    <form class="form " method="POST" action="../php_Processing/signupprocess.php">
        
        *
    <input class="input-group" type="text" name="name" placeholder="your Name"
        value="<?php if (isset($errors) && isset($_SESSION['name'])) {
    echo $_SESSION['name'];
} ?>">
        
    <span class="error">
        <?php if (isset($errors) && strpos($errors, 'name')) {
    echo 'Please Enter Your Name';
} ?>
    </span>
    <br><br>
    *
    <input class="input-group" type="text" name="email" placeholder="E-mail "
        value="<?php if (isset($errors) && isset($_SESSION['email'])) {
    echo $_SESSION['email'];
} ?>">
            <span class="error">
                <?php if (isset($errors) && strpos($errors, 'email')) {
    echo 'Please Enter Your E-mail';
} ?></span>
            <br><br>
    *
    <div class="area">
        Gender : *
        <input class="" type="radio" name="gender"
            <?php if (isset($gender) && $gender == 'female') {
    echo 'checked';
} ?>
        value="female">Female

    <input class="" type="radio" name="gender"
        <?php if (isset($gender) && $gender == 'male') {
    echo 'checked';
} ?> value="male">Male

    <span class="error">
        <?php if (isset($errors) && strpos($errors, 'gender')) {
    echo "<br>".'Please Select';
} ?> </span>
                
    <br><br>*
    <input class="input-group" type="password" placeholder="Password " name="passwd">
    <span class="error">
        <?php if (isset($errors) && strpos($errors, 'passwd')) {
    echo 'Please Enter Your password';
} ?>
<?php if (isset($s)) echo $s;?> <br><br>
    <input class="registerbtn btn-primary but-submit" type="submit" name="submit" value="Submit">

    </form>

    </div>
</body>

</html>