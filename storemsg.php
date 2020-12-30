<?php
session_start();
require "database.php";
$toid=$_POST['toid'];
$msg=$_POST['msg'];
$id=$_SESSION['uid'];
$obj=new database();
if($obj->insert("msg",["from_id"=>$id,"to_id"=>$toid,"msg"=>$msg]))
{
    echo "1";
}
else
{
    echo "0";
}
?>