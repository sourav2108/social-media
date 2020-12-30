<?php
session_start();
require "database.php";
$obj=new database();
$obj->update("user",["status"=>'offline'],"uid=".$_SESSION['uid']."");
session_destroy();
header("location: login.html");
?>