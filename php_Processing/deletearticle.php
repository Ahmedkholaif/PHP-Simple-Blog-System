<?php
session_start();
  require_once('../Data_Base/data_base.php');

  if($_SERVER['REQUEST_METHOD'] == "GET"){
  $art_id=$_GET['art_id'];
  
  $data_obj = new MyDataBase();
  
  $data_obj->deleteArticle($art_id);
}

?>