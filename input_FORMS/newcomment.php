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
    <h1> My Blog Site </h1>
    <a href = "http://localhost/lab4/Html_Views/MySitePage.php " class="right" > <?=$email ?> Home </a>
    <a href = "http://localhost/lab4/php_Processing/signout.php" class="right"> Sign Out </a>
        
    </nav>
    <hr> Create New Comment <hr>
    <div class="container">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['new_comment'])) {
                $art_id = $_SESSION['art_id'];
                $comment = $_POST['new_comment'];
                try {
                    $data_obj = new MyDataBase();
                    $data_obj->addComment($comment,$art_id,$activeUser);
                    } catch(Exception $e) {
                        echo 'please enter a valid comment';
                    }

            } else {
                echo 'please enter a valid comment';
            }
        } else {
            $_SESSION['art_id'] = $_GET['art_id'];
        }
    ?>


    <form action="newcomment.php" method="POST" >
        <textarea cols="5" rows="3" name="new_comment" placeholder="Your Comment Here" ></textarea>
        <input type="submit" name="submit">
    </form>    

    </div>
    <footer>
    My links
</footer>
</body>
</html>