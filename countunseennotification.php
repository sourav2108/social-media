<?php
session_start();
$msgno;
$msgno2;
require_once "database.php";
$ob=new database();
if($ob->select("select * from frnd where to_id=".$_SESSION['uid']." and n_status=1"))
 {
     $r4=$ob->getresult();
     $msgno=sizeof($r4);
     
 }
 else
 {
     $msgno= 0;
  }
  if($ob->select("select * from likenotification where to_id=".$_SESSION['uid']." and status=0"))
 {
     $r5=$ob->getresult();
     $msgno2=sizeof($r5);
    
 }
 else
 {
     $msgno2=0;
  }

  echo $msgno+$msgno2;
?>