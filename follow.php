<?php
session_start();
require "database.php";
$id=$_POST['uid'];
$obj=new database();
if($obj->select("select * from follow where from_id=".$_SESSION['uid']." and to_id=$id"))
{
    $r=$obj->getresult();
    if($obj->delete("follow","fid=".$r[0]['fid'].""))
    {
         echo "follow";
    }
}
else
{
    $res=$obj->insert("follow",['from_id'=>$_SESSION['uid'],'to_id'=>$id]);
    if($res)
    {
        echo "unfollow";
    }
    else
    {
        echo "e";
    }
}

?>