<?php
session_start();
require "database.php";
$toid=$_POST['id'];
$ob=new database();
$x=$ob->insert("frnd",["from_id"=>$_SESSION['uid'],"to_id"=>$toid,"f_status"=>"1","n_status"=>"1"]);
if($x)
{
    echo "1";
}
else
{
    echo "0";
}
?>