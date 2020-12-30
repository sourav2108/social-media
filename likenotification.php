<?php
session_start();
$pid=$_POST['pid'];
require_once "database.php";
$ob=new database();
if($ob->select("select uid from post where pid=$pid"))
 {
     $r4=$ob->getresult();
     if($r4[0]['uid']!=$_SESSION['uid'])
     {
         if($ob->insert("likenotification",["from_id"=>$_SESSION['uid'],"to_id"=>$r4[0]['uid'],"pid"=>$pid]))
         {
             echo "1";
         }
         else
         {
             echo "0";
         }
     }
 }
 else
 {
     echo "0";
  }
?>