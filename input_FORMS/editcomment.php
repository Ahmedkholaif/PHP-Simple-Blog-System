<?php
session_start();
require_once('../Data_Base/data_base.php');

$activeUser = $_SESSION['user_id'];
$email = $_SESSION['email'];
$data_obj = new MyDataBase();
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $com_id =$_SESSION['com_id']= $_GET['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../Styling/main.css">
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['body'])) {
                $body = $_POST['body'];
                $com_id =$_SESSION['com_id'];
                $art_id =$_SESSION['art_id'];
                // print_r($com_id);
                // exit;

                $data_obj->setCommentAfterEdit($com_id,$body,$art_id);
                 
            } else {
                echo 'please enter a valid data';
            }
        } 
    ?>
    <nav class="nav">
       
    
    <a href = "http://localhost/lab4/input_FORMS/newarticle.php"> Create New Article </a>
    <h1> My Blog Site </h1> 
    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"> <?=$email ?> Sign Out </a>
        
    </nav>
    <hr> Edit Your Comment <hr>
        <div class="container">

    <form action="editcomment.php" method="POST">
         <?php
            $data_obj->getCommentForEdit($com_id);
         ?>
        <input type="submit" name="submit">
    </form>    

        </div>
        <footer>
    My links
</footer>
</body>
</html>