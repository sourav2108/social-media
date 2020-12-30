<?php
session_start();
require_once "database.php";
$obj=new database();

if( $obj->update("msg",["status"=>1],"to_id=".$_SESSION['uid'].""))
{
    echo "1";
}
else
{
    echo "0";
}
?>
