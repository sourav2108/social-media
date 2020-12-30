<?php
session_start();
$pid=$_POST['pid'];
require "database.php";
$ob=new database();
if($ob->insert("liketb",["uid"=>$_SESSION['uid'],"pid"=>$pid]))
 {
     echo "1";
 }
 else
 {
     echo "0";
  }
?>