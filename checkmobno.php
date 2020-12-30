<?php
require "database.php";
$mobno=$_POST['mobno'];
$obj=new database();
if($obj->select("select * from user where mob_no=$mobno"))
{
    echo "1";
}else
{
    echo "0";
}
?>