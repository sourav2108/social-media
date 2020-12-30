<?php
session_start();
require_once "database.php";
$pid=$_POST['pid'];
$ob=new database();
if($ob->select("select uid from liketb where pid=$pid"))
{
    $r=$ob->getresult();
    foreach($r as list("uid"=>$cuid))
    {
        if($ob->select("select * from user where uid=$cuid"))
        {
            $r1=$ob->getresult();
            foreach($r1 as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
            {
                if(empty($dp))
                {
                    $p1="default.jpg";
                }
                else
                {
                    $p1="images/dp/$uid/$dp";
                }
             echo " <li><a href='profile.php?uid= $uid' style='text-decoration: none;'>
                        <img src='$p1'  class='mr-3 mt-2 rounded-circle' width='64' height='64'> <h5 style='text-transform: capitalize; display:inline;'>$name</h5>
                    </li>";
            }
        }
         
    }
     
}
else
{
    echo "<li><h3>No One Likes </h3></li>";
}
?>