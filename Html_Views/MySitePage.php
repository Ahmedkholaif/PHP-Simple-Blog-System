<?php 
session_start();
require_once('../Data_Base/data_base.php');
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header('Location: http://localhost/lab4/input_FORMS/signin.php');
    exit;
}

$activeUser = $_SESSION['user_id'];
$email = $_SESSION['email'];
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
    
    <a href = "http://localhost/lab4/input_FORMS/newarticle.php"> Create New Article </a>
    <a href = "http://localhost/lab4/Html_Views/myarticles.php"> My Articles </a>
    <h1> My Blog Site </h1>    

    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"><span> <?=$email ?></span> Sign Out </a>
        
    </nav>
<hr> Home Page <hr>
    <div class="container">
    <?php 
         $data_obj = new MyDataBase();
         $data_obj->getAllData($activeUser);

       ?>

    </div>

<footer>
    My links
</footer>
</body>
</html>