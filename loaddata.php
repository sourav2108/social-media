<?php
session_start();
require "database.php";
$id=$_GET['id'];
$obj=new database();
if($obj->select("select * from user where uid=$id"))
{
    $res=$obj->getresult();
    $x=json_encode($res);
    echo $x;
}
else
{
    echo "0";
}
?>