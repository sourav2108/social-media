<?php
require "database.php";
$no=$_POST['no'];
$obj=new database();
if($obj->select("select password from user where mob_no=$no"))
{
    $r=$obj->getresult();
    echo "<h5>Password is  :".$r[0]['password']."</h5>";
}else
{
    echo "<h5>Mobile No does not exist....plz provid correct mobno</h5>";
}
?>