<?php
session_start();
require "database.php";
$txt=$_POST['scr'];
$ssid=$_SESSION['uid'];
$obj=new database();

if($obj->select("select * from user where name like '%$txt%' and uid <> $ssid"))
{
    $result=$obj->getresult();
    foreach($result as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
    {
        if(empty($dp))
        {
            $p="default.jpg";
        }
        else
        {
            $p="images/dp/$uid/$dp";
        }
        if($obj->select("select * from frnd where (to_id=$ssid and f_status=2 and from_id=$uid) or (to_id=$uid and from_id=$ssid and f_status=2)"))
        {
            
            echo "<li>
                    <a href='profile.php?uid=$uid' style='text-decoration: none;'>
                        <img src='$p'  class='mr-3 mt-2 rounded-circle' width='64' height='64'> <h5 style='text-transform: capitalize; display:inline;'>$name</h5>
                    </a>
                </li>";
        }
        else if($obj->select("select * from frnd where from_id=$ssid and f_status=1 and to_id=$uid"))
        {
            echo"   <li>
                        <a href='profile.php?uid=$uid' style='text-decoration: none;'>
                            <img src='$p'  class='mr-3 mt-2 rounded-circle' width='64' height='64'> <h5 style='text-transform: capitalize; display:inline;'>$name</h5>
                        </a>
                        <button class='btn ml-2' disabled >Request send</button>
                    </li>";
        }
        else
        {
            echo"   <li>
                        <a href='profile.php?uid=$uid' style='text-decoration: none;'>
                            <img src='$p'  class='mr-3 mt-2 rounded-circle' width='64' height='64'> <h5 style='text-transform: capitalize; display:inline;'>$name</h5>
                        </a>
                        <button class='btn ml-2 connbtn' data-uid='$uid' >Connect</button>
                    </li>";

        }
    }
}
else
{
    echo "<h4>No Match</h4>";
}
?>