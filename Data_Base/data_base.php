<?php


 class MyDataBase
 {
     public $username = '***'; //your data here
    public $password = '***'; //your data here
    public $db;

     public function __construct()
     {
         $dsn = 'mysql:host=localhost;dbname=iti';
         $this->db = new PDO($dsn, $this->username, $this->password);
         $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }

     public function addToUsers($name, $gender, $email, $passwd)
     {
         try {
             $sql = 'insert into users (name,gender,email,passwd) values (:name ,:gender,:email,:passwd)';

             $prepared = $this->db->prepare($sql);
             $prepared->execute([':name' => $name, ':gender' => $gender, ':email' => $email, ':passwd' => $passwd]);

             $_SESSION['user_id'] = $id;
             header('Location: http://localhost/lab4/Html_Views/MySitePage.php');

             return $id = $this->db->lastInsertId();
             exit;
         } catch (Exception $e) {
             $errors .= '_duplicate';
             header("Location: http://localhost/lab4/input_FORMS/signup.php?errors=$errors");
             exit;
         }
     }

     public function checkUser($email, $passwd)
     {
         $sql = 'select user_id,email,passwd from  users ';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([]);
         $result = $prepared->fetchAll();

         foreach ($result as $key => $value) {
             if ($email == $value['email'] && $passwd == $value['passwd']) {
                 $_SESSION['user_id'] = $value['user_id'];
                 $activeUser = $value['user_id'];
                 $_SESSION['email'] = $value['email'];
             }
         }
         if (!isset($activeUser)) {
             $errors .= ' ,invalid';
             header("Location: http://localhost/lab4/input_FORMS/signin.php?errors=$errors");
             exit;
         }
         $_SESSION['user_id'] = $activeUser;
         header('Location: http://localhost/lab4/Html_Views/MySitePage.php');
         exit;
     }

     public function countMyArticles($activeUser)
     {
         $sql = 'select count(id) as c from articles where user_id =:id  
        ';
         $prepared = $this->db->prepare($sql);

         $prepared->execute(['id' => $activeUser]);

         $row = $prepared->fetch(PDO::FETCH_ASSOC);

         return $row['c'];
     }

     public function countArticleComments($art_id)
     {
         $sql = 'select count(id) as c from comments where article_id =:id  
        ';
         $prepared = $this->db->prepare($sql);

         $prepared->execute(['id' => $art_id]);

         $row = $prepared->fetch(PDO::FETCH_ASSOC);

         return $row['c'];
     }

     public function getAllData($activeUser)
     {
         $sql = 'select  a.id,a.user_id,a.title,a.body,a.created,u.name,u.email from  articles as a,users as u
        where a.user_id = u.user_id ORDER BY a.created desc 
        ';
         $prepared = $this->db->prepare($sql);

         $prepared->execute([]);

         while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
             // print_r($row);
             $art_id = $row['id'];
             $title = $row['title'];
             $date = $row['created'];
             $name = $row['name'];
             $email = $row['email'];

             echo "
            <div class='article' ><h3> ".$title.' </h3><h5> at'."$date".'  by   '."$name".'  --  '."$email"
             .'</h5>  <br><br> <p>'.strtok(nl2br($row['body']), '.').'</p>';

             if ($row['user_id'] == $activeUser) {
                 echo"<a href ='http://localhost/lab4/input_FORMS/editarticle.php?art_id=$art_id' > Edit The article</a>";
                 echo "<a href ='http://localhost/lab4/php_Processing/deletearticle.php?art_id=$art_id' > Delete The article</a>";
                 echo "<a href ='http://localhost/lab4/Html_Views/fullarticle.php?art_id=$art_id' > Read Full Article </a>";
             } else {
                 echo
                "<a href ='http://localhost/lab4/input_FORMS/newcomment.php?art_id=$art_id' > Add Comment Here </a>"
                ."<a href ='http://localhost/lab4/Html_Views/fullarticle.php?art_id=$art_id' > Read Full Article </a>";
             }

             echo  '       '.$this->countArticleComments($art_id).'      Comments on this article';
             echo '</div>';
         }
     }

     public function getAllDataForOneUser($activeUser)
     {
         $sql = 'select  a.id,a.user_id,a.title,a.body,a.created,u.name,u.email from  articles as a,users as u
        where a.user_id = u.user_id and u.user_id =:id ORDER BY a.created desc 
        ';
         $prepared = $this->db->prepare($sql);

         $prepared->execute(['id' => $activeUser]);

         while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
             // print_r($row);
             $art_id = $row['id'];
             $title = $row['title'];
             $date = $row['created'];
             $name = $row['name'];
             $email = $row['email'];

             echo "
            <div class='article' ><h3> ".$title.' </h3><h5> at'."$date".'  by   '."$name".'  --  '."$email"
             .'</h5>  <br><br> <p>'.strtok(nl2br($row['body']), '.').'</p>';

             echo"<a href ='http://localhost/lab4/input_FORMS/editarticle.php?art_id=$art_id' > Edit The article</a>";
             echo "<a href ='http://localhost/lab4/php_Processing/deletearticle.php?art_id=$art_id' > Delete The article</a>";
             echo "<a href ='http://localhost/lab4/Html_Views/fullarticle.php?art_id=$art_id' > Read Full Article </a>";
             echo  '       '.$this->countArticleComments($art_id).'      Comments on this article';
             echo '</div>';
         }
     }

     // handle new article

     public function setNewArticle($title, $article, $activeUser)
     {
         $sql = 'insert into articles (title,body,user_id) values (:title ,:body,:user_id)';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':title' => $title, ':body' => $article, ':user_id' => $activeUser]);

         header('Location: http://localhost/lab4/Html_Views/MySitePage.php');
         exit;
     }

     //edit article
     public function setArticleAfterEdit($art_id, $body, $title)
     {
         $sql = 'update articles set body =:body , title=:title where id=:art_id';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':body' => $body, ':art_id' => $art_id, ':title' => $title]);
         // unset($_SESSION['art_id']);
         header('Location: http://localhost/lab4/Html_Views/fullarticle.php?art_id='.$art_id);
         exit;
     }

     public function getArticleForEdit($art_id)
     {
         $sql = 'select body,title from articles where id =:art_id';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':art_id' => $art_id]);
         $row = $prepared->fetch(PDO::FETCH_ASSOC);
         echo
        "<textarea type='text' name='edit_title'  > ".$row['title']." </textarea>
        <textarea cols='5' rows='8' name='edit_article' >".$row['body'].'</textarea>';
     }

     //full article view with comments

     public function getArticleData($art_id, $activeUser)
     {
         $sql = 'select  a.id,a.user_id,a.title,a.body,a.created,u.name,u.email from  articles as a,users as u
        where a.user_id = u.user_id and a.id =:art_id';
         $prepared = $this->db->prepare($sql);

         $prepared->execute([':art_id' => $art_id]);

         $row = $prepared->fetch(PDO::FETCH_ASSOC);
         echo "<div class='article' > 
                <h3>".$row['title']
             .'</h3><h5>'.$row['created'].' by  '.$row['name'].' '.$row['email'].' </h5> 
                 <br> <p> '.nl2br($row['body'])
                .'</p>';
         if ($row['user_id'] == $activeUser) {
             echo "<a href ='http://localhost/lab4/input_FORMS/editarticle.php?art_id=$art_id' > Edit The article</a>";
             echo "<a href ='http://localhost/lab4/php_Processing/deletearticle.php?art_id=$art_id' > Delete The article</a>";
             echo "<a href ='http://localhost/lab4/input_FORMS/newcomment.php?art_id=$art_id' > Add Comment Here </a>";
         } else {
             echo "<a href ='http://localhost/lab4/input_FORMS/newcomment.php?art_id=$art_id' > Add Comment Here </a>";
         }
         echo  '       '.$this->countArticleComments($art_id).'      Comments on this article';
         echo '</div>';
     }

     //get comments of an article
     public function getCommentsForArticle($art_id, $activeUser)
     {
         $sql_com = 'select c.id,u.name,c.body,c.created,c.user_id from  comments as c,users as u
         where article_id = :art_id and u.user_id=c.user_id ';

         $prep_com = $this->db->prepare($sql_com);
         $prep_com->execute([':art_id' => $art_id]);
         while ($row2 = $prep_com->fetch(PDO::FETCH_ASSOC)) {
             // print_r($row2);
             // exit;
             echo '<p> '.'   '.$row2['body'].'<p>   at   '.$row2['created'].'  by  '.$row2['name'].'</p>';
             if ($activeUser == $row2['user_id']) {
                 echo '<a href= http://localhost/lab4/php_Processing/delete.php?id='.$row2['id'].' > Delete Comment </a>';
                 echo '<a href=http://localhost/lab4/input_FORMS/editcomment.php?id='.$row2['id'].' > Edit Comment </a>';
             }
             echo '<P>';
         }
     }

     // handle new comment
     public function addComment($comment, $art_id, $activeUser)
     {
         $sql = 'insert into comments (body,article_id,user_id) values (:body ,:art,:user)';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':body' => $comment, ':art' => $art_id, ':user' => $activeUser]);
         // unset($_SESSION['art_id']);
         header('Location: http://localhost/lab4/Html_Views/fullarticle.php?art_id='.$art_id);
         exit;
     }

     public function deleteComment($id, $art_id)
     {
         $sql = 'delete from comments where id=:id';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':id' => $id]);

         header('Location: http://localhost/lab4/Html_Views/fullarticle.php?art_id='.$art_id);

         exit;
     }

     //edit article
     public function setCommentAfterEdit($id, $body, $art_id)
     {
         $sql = 'update comments set body =:body where id=:id';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':body' => $body, ':id' => $id]);
         header('Location: http://localhost/lab4/Html_Views/fullarticle.php?art_id='.$art_id);
         unset($_SESSION['com_id']);
         exit;
     }

     public function getCommentForEdit($id)
     {
         $sql = 'select body from comments where id =:id';

         $prepared = $this->db->prepare($sql);
         $prepared->execute([':id' => $id]);
         $row = $prepared->fetch(PDO::FETCH_ASSOC);
         echo
        "<textarea name='body'  > ".$row['body'].' </textarea>';
     }

     public function deleteArticle($art_id)
     {
         $sql = 'delete from articles where id=:id';
         $sql_com = 'delete from comments where article_id=:id';

         $prep1 = $this->db->prepare($sql_com); // deletin associted comments first
         $prepared = $this->db->prepare($sql);

         $prep1->execute([':id' => $art_id]);
         $prepared->execute([':id' => $art_id]);

         header('Location: http://localhost/lab4/Html_Views/MySitePage.php');
         exit;
     }
 }
