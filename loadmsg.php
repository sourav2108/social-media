<?php
session_start();
require_once "database.php";
$toid=$_POST['id'];
$obj=new database();
if($obj->select("select * from msg where (from_id=".$_SESSION['uid']." and to_id=$toid) or (from_id=$toid and to_id=".$_SESSION['uid'].")"))
{
    $out=$obj->getresult();
    foreach($out as list("mid"=>$mid,"from_id"=>$fmid,"to_id"=>$tid,"msg"=>$msg,"time"=>$time))
    {
        if($fmid==$_SESSION['uid'])
        {
            echo "<div style='text-align:right;'>
            <p style='font-size:10px;'>$time</p>
            <p style='background-color: lightblue; word-wrap: break-word; display: inline-block; border-radius: 10px; max-width: 70%;'>
              $msg
            </p>
                   </div>";
        }
        else
        {
            echo "<div style='text-align:left;'>
                    <p style='font-size:10px;'>$time</p>
                    <p style='background-color: yellow; word-wrap: break-word; display: inline-block; border-radius: 10px; max-width: 70%;'>
                      $msg
                    </p>
                  </div>";
        }

    }
}
else
{
    echo "<h3>Start Conversation</h3>";
}
?>