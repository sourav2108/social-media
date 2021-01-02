<?php
session_start();
require "database.php";
$mob=$_POST['mob'];
$pass=$_POST['password'];

//echo $mob;
$obj=new database();
$res=$obj->select("select * from user where mob_no=$mob");
if($res)
{
    $value=$obj->getresult();
    if(password_verify($pass,$value[0]['password']))
    {
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
    
    
}
else
{
    echo "0";
}

?>