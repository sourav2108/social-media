<?php
session_start();
require "database.php";

$obj=new database();
if($obj->update("user",["dp"=>null],"uid=".$_SESSION['uid'].""))
{
    echo "1";
}
else
{
    echo "0";
}
?>