<?php
session_start();
$id=$_SESSION['uid'];
require "database.php";
$pass=$_POST['pass'];
$obj=new database();
if($obj->update("user",["password"=>$pass],"uid=$id"))
{
    echo "1";
}
else
{
    echo "0";
}
?>