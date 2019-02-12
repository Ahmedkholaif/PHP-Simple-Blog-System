<?php
session_start();
$activeUser = $_SESSION['user_id'];
$email = $_SESSION['email'];
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('Location: http://localhost/lab4/input_FORMS/signin.php');
    exit;
}
if (isset($_GET['errors'])) {
    echo '<p> Enter A Valid Content </p>';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Simple Blog Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../Styling/main.css">
</head>
<body>
<nav class="nav">
<h1> My Blog Site </h1>    
    
    <a href = "http://localhost/lab4/Html_Views/MySitePage.php " class="right" >  Home </a>
    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"> <?=$email ?> Sign Out </a>
        
    </nav>
    <hr> Create New Article <hr>
    <div class="container">
    
    
    <form method="POST" action="php_Processing/handleinput_FORMS/newarticle.php">
        <textarea type="text" name="title" placeholder="Title"></textarea>
        <textarea name="new_article" rows="15" cols="30" placeholder="Start here" ></textarea>
        <input type="submit" name="submit">
    </form>
    </div>
    <footer>
    My links
</footer>
</body>
</html>