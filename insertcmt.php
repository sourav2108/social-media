<?php
session_start();
require "database.php";
$pid=$_POST['pid'];
$cmt=$_POST['cmt'];

$obj=new database();
if($obj->insert("cmttb",["uid"=>$_SESSION['uid'],"pid"=>$pid,"comment"=>$cmt]))
{
    echo "1";
}
else
{
    echo "0";
}
?>