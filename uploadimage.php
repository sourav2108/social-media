<?php
session_start();
require_once "database.php";
$filename=$_FILES['file']['name'];
$tmp=$_FILES['file']['tmp_name'];
$ext=pathinfo($filename,PATHINFO_EXTENSION);
$filename =time().".".$ext;
$des="images/dp/".$_SESSION['uid']."/";
$ob=new database();
$t=time();
if($ob->update("user",["dp"=>$filename],"uid=".$_SESSION['uid'].""))
{
    if(file_exists($des))
    {
        move_uploaded_file($tmp,$des.$filename);
    }
    else
    {
        mkdir($des);
        move_uploaded_file($tmp,$des.$filename);
    }
    if($ob->insert("post",["title"=>null,"image"=>$filename,"uid"=>$_SESSION['uid'],"time"=>$t,"cat"=>"dp"]))
    {
    echo "1";
    }
}
else
{
    echo "0";
}
?>