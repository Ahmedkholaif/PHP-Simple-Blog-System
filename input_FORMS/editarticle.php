<?php
session_start();
require_once('../Data_Base/data_base.php');
$activeUser = $_SESSION['user_id'];
$email = $_SESSION['email'];
$art_id = $_GET['art_id'];
$data_obj = new MyDataBase();
?>
<?php
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['edit_article']) && isset($_POST['edit_title']) ) {
                $art_id = $_SESSION['art_id'];
                $body = $_POST['edit_article'];
                $title = $_POST['edit_title'];

                
                $data_obj->setArticleAfterEdit($art_id,$body,$title); 
            } else {
                echo 'please enter a valid data';
            }
        } else {
            $_SESSION['art_id'] = $_GET['art_id'];
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
    
    <nav class="nav">
        
    
    <a href = "http://localhost/lab4/input_FORMS/newarticle.php"> Create New Article </a>
    <h1> My Blog Site </h1>
    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"> <?=$email ?> Sign Out </a>
        
    </nav>
    <hr> Edit Your Article <hr>
        <div class="container">

    <form action="editarticle.php" method="POST">
         <?php
            $data_obj->getArticleForEdit($art_id);
         ?>
        <input type="submit" name="submit">
    </form>    

        </div>
        <footer>
    My links
</footer>
</body>
</html>