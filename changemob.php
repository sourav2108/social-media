<?php
session_start();
$id=$_SESSION['uid'];
require "database.php";
$no=$_POST['no'];
$obj=new database();
if($obj->update("user",["mob_no"=>$no],"uid=$id"))
{
    echo "1";
}
else
{
    echo "0";
}
?>