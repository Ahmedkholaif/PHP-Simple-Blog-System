<?php
session_start();
  require_once('../Data_Base/data_base.php');
// $table = 'comments';
if($_SERVER['REQUEST_METHOD'] == "GET"){
  $id=$_GET['id'];
  $art_id=$_SESSION['art_id'];
  $data_obj = new MyDataBase();
  
  $data_obj->deleteComment($id,$art_id);
}

?>