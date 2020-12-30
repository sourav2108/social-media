<?php
session_start();
require "database.php";
$mob=$_POST['mob'];
$pass=$_POST['password'];

//echo $mob;
$obj=new database();
$res=$obj->select("select * from user where mob_no=$mob and password='$pass'");
if($res)
{
    $value=$obj->getresult();
    $_SESSION['name']=$value[0]['name'];
    $_SESSION['uid']=$value[0]['uid'];
    if($obj->update("user",["status"=>'online'],"uid=".$_SESSION['uid'].""))
    {
        echo "1";

    }
    else
    {
        echo "0";
    }
    
}
else
{
    echo "0";
}

?>