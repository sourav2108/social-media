<?php
session_start();
   require "database.php";
   $id=$_POST['id'];
   $d1=new database();
   if($d1->update("frnd",["f_status"=>2],"from_id=$id and to_id=".$_SESSION['uid'].""))
   {
       echo "1";
   }
   else
   {
       echo "0";
   }
?>