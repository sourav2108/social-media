<?php
session_start();
$pid=$_POST['pid'];
require_once "database.php";
$ob=new database();
if($ob->select("select * from liketb where uid=".$_SESSION['uid']." and pid=$pid"))
 {
     echo "1";
 }
 else
 {
     echo "0";
  }
?>