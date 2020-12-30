<?php
session_start();

require_once "database.php";
$ob=new database();
if($ob->select("select * from frnd where to_id=".$_SESSION['uid']." and f_status=1"))
 {
     $r4=$ob->getresult();
     $msgno=sizeof($r4);
     echo $msgno;
 }
 else
 {
     echo "0";
  }
?>