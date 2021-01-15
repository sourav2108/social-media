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
    <title>MASSAGE</title>
</head>
<body>
    <?php 
    require "header.php"; 
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mt-4 offset-sm-2">
                <div class="border-bottom" style="overflow-x: auto; ">
                    <h3>Messages</h3>
                    <?php
                    if($obj->select("select * from user where status='online' and uid in(select from_id from frnd where to_id=".$_SESSION['uid']." and f_status=2) or status='online' and uid in(select to_id from frnd where from_id=".$_SESSION['uid']." and f_status=2)"))
                    {
                        
                        $act=$obj->getresult();
                        foreach($act as list("uid"=>$uidact,"name"=>$nameact,"mob_no"=>$mobact,"password"=>$passact,"create_date"=>$dateact,"dp"=>$dpact,"gender"=>$genact,"dob"=>$dobact))
                        {
                            $p1;
                            if(empty($dpact))
                            {
                                $pact="default.jpg";
                            }
                            else
                            {
                                $pact="images/dp/$uidact/$dpact";
                            }
                            ?>
                            <ul class="list-unstyled float-left" >
                                <li><a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uidact?>"  style="text-decoration: none; margin-right: 20px;">
                                    <img src="<?php echo $pact?>"  class="mt-2 rounded-circle" width="34" height="34"  alt=""><div style="height: 6px; width: 6px; background-color: green; border-radius: 50%; display:inline-block"></div>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }   
 
                    }     
                    ?>
                </div>
                <ul class="list-unstyled" style="clear: both;">
                    <?php
                    if($obj->select("select * from user where uid in(select distinct(from_id) from msg where to_id=".$_SESSION['uid']."  order by mid desc)"))
                    {
                        $cc=0;
                        $output=$obj->getresult();
                        foreach($output as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob,"status"=>$st))
                        {
                            
                            if(empty($dp))
                            {
                                $p1="default.jpg";
                            }
                            else
                            {
                                $p1="images/dp/$uid/$dp";
                            }

                            if($obj->select("select uid from user where uid in(select distinct(from_id) from msg where to_id=".$_SESSION['uid']." and status=0)"))
                            {
                                $cc=1;
                                $res=$obj->getresult();
                                foreach($res as list("uid"=>$u))
                                {
                                    if($uid==$u)
                                    {
                                        if($st=='online')
                                        {
                                       ?>
                                            <li style="background-color: lightblue; border-radius: 20px;">
                                                <a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uid?>"  style="text-decoration: none;">
                                                    <img src="<?php echo $p1?>"  class="mr-1 mt-2 rounded-circle" width="64" height="64"  alt=""><div style="height: 10px; width: 10px; background-color: green; border-radius: 50%; display:inline-block"></div> <?php echo "<h5 style='text-transform: capitalize; color: black; display:inline;'>$name</h5> <span style='color:black;'> send Massage </span>"?>
                                                </a>
                                            </li>
                                         <?php 
                                        }
                                        else
                                        {
                                            ?>
                                            <li style="background-color: lightblue; border-radius: 20px;">
                                                <a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uid?>"  style="text-decoration: none;">
                                                    <img src="<?php echo $p1?>"  class="mr-1 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; color: black; display:inline;'>$name</h5> <span style='color:black;'> send Massage </span>"?>
                                                </a>
                                            </li>
                                            <?php
                                        } 
                                    }
                                }
                            }

                           else
                            {
                                if($st=='online')
                                {
                                ?>
                                    <li>
                                        <a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uid?>"  style="text-decoration: none;">
                                            <img src="<?php echo $p1?>"  class="mr-1 mt-2 rounded-circle" width="64" height="64"  alt=""><div style="height: 10px; width: 10px; background-color: green; border-radius: 50%; display:inline-block"></div> <?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name</h5> send Massage"?>
                                        </a>
                                    </li>
                                 <?php
                                }
                                else
                                {
                                    ?>
                                    <li>
                                        <a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uid?>"  style="text-decoration: none;">
                                            <img src="<?php echo $p1?>"  class="mr-1 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name</h5> send Massage"?>
                                        </a>
                                    </li>
                                    <?php 
                                }
                            }
                            
                        }
                    }
                    else
                    {
                        echo "<h3>You Have No Unseen Message</h3>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php
        $obj->update("msg",["status"=>1],"to_id=".$_SESSION['uid']."");
    ?>
    <!-- for msg modal -->
    <div class="modal fade" id="msgmodal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mx-1 border-bottom border-primary">
                    <h5 class="modal-title p " style='text-transform: capitalize;' ></h5>
                    <button type="button" style="background-color: red;" class="btn-close msgcl" data-dismiss="modal" aria-label="close">X</button>
                </div>
                <div class="modal-body border border-top-0 border-primary mx-1 mb-3" id="msgshow" style="height: 300px; overflow-y: auto; overflow-x: hidden;">
               
                </div>
                <div class="ml-1 mb-4">
                    <form action="#" class="form-inline msgfm" >
                        <input type="hidden" name="toid" id="toid">
                        <input type="text" id="txt" autocomplete="off" size="50" class="form-control border border-primary"><button class="btn btn-outline-success send"><i class="fas fa-paper-plane sendicon"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>     


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/count.js"></script>
    <script src="js/showmsg.js"></script>
    <script>
        $(document).ready(function(){
            
            $("#hn3").addClass("bg-primary");
            $("#hn3").children().addClass("text-white");

        });
    </script>
</body>
</html>