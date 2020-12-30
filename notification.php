<?php
session_start();
if(!isset($_SESSION['name']))
{
     header("location:login.html");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>NOTIFICATION</title>
</head>
<body>
    <?php require "header.php" ;?>

    <!-- for frnd request notification -->
    <div class="container">
        <div class="row">
            <div class="col-4 offset-2 mt-4">
                <ul class="list-unstyled">
                  <?php
                    if($obj->select("select * from user where uid in(select from_id from frnd where to_id=".$_SESSION['uid'].")"))
                    {
                        $from=$obj->getresult();
    
                        foreach($from as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
                        {
                            if(empty($dp))
                            {
                                $p="default.jpg";
                            }
                            else
                            {
                                $p="images/dp/$uid/$dp";
                            }
                            ?>
                            <li>
                                <a href="profile.php?uid=<?php echo $uid?>" style="text-decoration: none;">
                                    <img src="<?php echo $p?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='font-weight:bold; text-transform: capitalize; display:inline;'>$name</h5> send friend request"?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<h4 class='text-primary'>No Notification</h4>";
                    }
                    $obj->update("frnd",["n_status"=>2],"n_status=1");
                    ?>
                </ul>
            </div>

           <!-- for post like notification -->
            <div class="col-4 mt-4">
                <ul class="list-unstyled">
                 <?php
                    if($obj->select("select * from likenotification where to_id=".$_SESSION['uid']." order by lnid desc"))
                    {
                        $from2=$obj->getresult();
    
                        foreach($from2 as list("from_id"=>$fmid1,"to_id"=>$tid1,"status"=>$st1,"pid"=>$p))
                        {

                            if($obj->select("select * from user where uid=$fmid1"))
                            {
                                $fm=$obj->getresult();
                                foreach($fm as list("uid"=>$u,"name"=>$nam,"mob_no"=>$mobno,"password"=>$pas,"create_date"=>$dat,"dp"=>$dp1,"gender"=>$gen1,"dob"=>$dob1))
                                {
                                    if(empty($dp1))
                                    {
                                        $p1="default.jpg";
                                    }
                                    else
                                    {
                                        $p1="images/dp/$u/$dp1";
                                    }

                                    $obj->select("select cat from post where pid=$p");
                                    $cout=$obj->getresult();
                                    if($cout[0]['cat']=="dp")
                                    {
                                        $abut=" like your profile pic";
                                    }
                                    else
                                    {
                                        $abut=" like your post";
                                    }
                                    if($st1==0)
                                    {
                       
                                      ?>
                                        <li>
                                            <a href="likepostdetails.php?pid=<?php echo $p?>" style="background-color:lightblue; text-decoration: none;">
                                                <img src="<?php echo $p1?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='font-weight:bold; color: black; text-transform: capitalize; display:inline;'>$nam</h5> <span style='color:black;'>$abut</span>"?> </a>
                                        </li>
                                        <?php
                                    }
                                    else
                                    {
                                      ?>
                                        <li>
                                            <a href="likepostdetails.php?pid=<?php echo $p?>" style="text-decoration: none;">
                                                <img src="<?php echo $p1?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='font-weight:bold; text-transform: capitalize; display:inline;'>$nam</h5> <span>$abut</span>"?> 
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
    
                    $obj->update("likenotification",["status"=>1],"status=0");
                   ?>
               </ul>
           </div>
       </div>
   </div>
    
           


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/count.js"></script>
    <script>
        $(document).ready(function(){
            $("#hn4").addClass("bg-primary");
            $("#hn4").children().addClass("text-white");
        });
    </script>
</body>
</html>