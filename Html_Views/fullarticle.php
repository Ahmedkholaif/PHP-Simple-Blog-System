<?php session_start();
require_once('../Data_Base/data_base.php');
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('Location: http://localhost/lab4/input_FORMS/signin.php');
    exit;
}

$activeUser = $_SESSION['user_id'];
$email = $_SESSION['email'];
$art_id = $_GET['art_id'];
$_SESSION['art_id'] = $art_id;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Simple Blog Site </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../Styling/main.css">
    
</head>
<body>
    <nav class="nav">
    
    <a href = "http://localhost/lab4/input_FORMS/newarticle.php "> Create New Article </a>
    <h1> My Blog Site </h1>
    <a href = "http://localhost/lab4/Html_Views/MySitePage.php " class="right"> Home </a><br>
    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"> <?=$email ?> Sign Out </a>
    </nav>
    <hr> Full Article  <hr>

    <div class="container ">
        <?php
            $data_obj = new MyDataBase();
            $data_obj->getArticleData($art_id,$activeUser);        
        ?>    
       
        <div class="article">  <!--comments here-->
        <?php
            $data_obj->getCommentsForArticle($art_id,$activeUser);
        ?>
    
        </div>
    </div>

<footer>
    My links footer
</footer>
</body>
</html>