<?php
require "database.php";
$name=$_POST['name'];
$mob=$_POST['mobno'];
$pass=password_hash($_POST['pass'],PASSWORD_BCRYPT);
$dob=$_POST['dob'];
$gen=$_POST['gender'];
$d=date('Y-m-d');
$obj=new database();
$res=$obj->insert("user",['name'=>$name,'mob_no'=>$mob,'password'=>$pass,'create_date'=>$d,'gender'=>$gen,'dob'=>$dob]);
if($res)
{
    echo "1";
}
else
{
    echo "0";
}
?>