
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
    <style>
       @media screen and (max-width: 600px){
            #activefrndinhome
            {
                display: none;
            }
        }
    </style>
    <title>HOME</title>
</head>

<body>
    
 <?php require "header.php" ?>

    <div class="container">
        <div class="row">
            <!-- for all post -->
            <div class="col-sm-5 offset-sm-2 border border-top-0 border-primary">
                <div class="text-right">
                    <button class="btn btn-success mt-3" data-toggle="modal" data-target="#postmodal">Add Post</button>
                </div><br>
                <?php
                
                if($obj->select("select * from post where uid=".$_SESSION['uid']."  or uid in(select uid from user where uid in((select from_id from frnd where to_id=".$_SESSION['uid']." and f_status=2)) or uid in(select to_id from frnd where from_id=".$_SESSION['uid']." and f_status=2)) order by pid desc"))
                {
                    $output=$obj->getresult();
                    foreach($output as list("pid"=>$pid,"title"=>$t,"image"=>$im,"uid"=>$ui,"time"=>$tm,"cat"=>$cat))
                    {
                        // time calculation
                        $now=time();
                        $time=($now-$tm);
                        if($time<60)
                        {
                            $ago="$time sec ago";
                        }
                        else if($time>=60 && $time<3600)
                        {
                            $xt=ceil($time/60);
                            $ago="$xt min  ago";
                        }
                        else if($time>=3600 && $time<86400)
                        {
                            $xc=ceil($time/3600);
                            $ago="$xc hr  ago";
                        }
                        else
                        {
                            $xs=ceil($time/86400);
                            $ago="$xs day ago";
                        }
                        if(!empty($im))
                            {
                                if($cat=="dp")
                                {
                                    $upimgpath="images/dp/$ui/$im";
                                    $about="update profile picture";
                                }
                                else
                                {
                                    $upimgpath="images/post/$ui/$im";
                                    $about="add post";
                                }
                                  
                            }
                        // for comment count
                        if($obj->select("select * from cmttb where pid=$pid"))
                        {
                            $cmt1=$obj->getresult();
                            $countcm=sizeof($cmt1);
                        }
                        else
                        {
                            $countcm=0;
                        }
                        
                        // for like count
                        if($obj->select("select * from liketb where pid=$pid"))
                        {
                            $lk=$obj->getresult();
                            $countlk=sizeof($lk);
                        }
                        else
                        {
                            $countlk=0;
                        }
                          
                        // for post user details
                        if($obj->select("select * from user where uid=$ui"))
                        {
                            $out=$obj->getresult();
                            if(!empty($out[0]['dp']))
                            {
                                $dir="images/dp/$ui/".$out[0]['dp']."";
                            }
                            else
                            {
                                $dir="default.jpg";
                            }
                            
                            // for post image path set
                            if(!empty($t))
                            {
                                if($cat=="dp")
                                {
                                    $about="update profile picture";
                                }
                                else
                                {
                                    $about="add post";
                                }
                                  
                            }
                            // for cheacking login user already like or not
                            if($obj->select("select * from liketb where uid=".$_SESSION['uid']."  and pid=$pid")) 
                            {
                                ?>
                                <!-- show post which current user already like -->
                                <div class="card">
                                    <a href="profile.php?uid=<?php echo $ui?>"  style="text-decoration: none;">
                                         <img src="<?php echo $dir?>" class="mr-3 mt-2 mb-0 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>".$out[0]['name']."</h5>  $about"?>
                                    </a><span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                               
                                    <div class="card-body text-center">

                                        <?php
                                        if(!empty($t))
                                        {
                                        ?>
                                        <p class="card-text"><?php echo $t;?><p>
                                        <?php
                                        }

                                        if(!empty($im))
                                        {
                                        ?>
                                        <img src="<?php echo $upimgpath ?>" class='img-fluid rounded'>
                                        <br>
                                        <?php
                                        }?>

                                        <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span></a>
                                        <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary bg-primary likebtn"><i class="fas fa-thumbs-up text-white"></i></button>
                                        <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcm." "."comments"?></span></a>
                                    </div>
                                </div>
                             <?php 
                            } 
                            else
                            {
                                
                             ?>
                               <!-- show post which current user not like -->
                                <div class="card">
                                    <a href="profile.php?uid=<?php echo $ui?>"  style="text-decoration: none;">
                                    <img src="<?php echo $dir?>" class="mr-3 mt-2 mb-0 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>".$out[0]['name']."</h5>   $about"?>
                                    </a><span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                               
                                    <div class="card-body text-center">
                                        <?php
                                        if(!empty($t))
                                        {
                                         ?>
                                          <p class="card-text"><?php echo $t;?><p>
                                         <?php
                                        }
                                        if(!empty($im))
                                        {
                                         ?>
                                           <img src="<?php echo $upimgpath?>" class='img-fluid rounded'>
                                           <br>
                                         <?php
                                        }?>
                            
                                        <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span>
                                        </a>
                                        <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary likebtn"><i class="fas fa-thumbs-up text-primary"></i></button>
                                        <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcm ." "."comments"?></span></a>
                                    </div>
                                </div>

                              <?php
                            }
                        }
                    }
                }
                else
                {?>
                
                    <div class="card">
                        <a href="#"  style="text-decoration: none;">
                            <img src="default.jpg" class="mr-3 mt-2 mb-0 rounded-circle" width="64" height="64"  alt=""><h5 style='text-transform: capitalize; display:inline'>Default User</h5> add post
                        </a>
                        <div class="card-body">
                            <p class="card-text">Welcome to SKbook<p>
                            <img src="welcome.jpg" class="img-fluid">
                        </div>
                    </div>
                    <?php
                }
                ?>

             <!-- for activ friend -->
            </div>
            <div class="col-sm-3 border-right border-primary" id="activefrndinhome">
                <div class="border-bottom border-primary">
                    <h4 id="frndshow" class="mt-3">Active Friend</h4>
                </div>
                <div id="activefrnd">
                <?php
                
                if($obj->select("select * from user where status='online' and uid in(select from_id from frnd where to_id=".$_SESSION['uid']." and f_status=2) or status='online' and uid in(select to_id from frnd where from_id=".$_SESSION['uid']." and f_status=2)"))
                {
                    $r1=$obj->getresult();
                 ?>
                    <div>
                      <?php
                        foreach($r1 as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
                        {
                            $p1;
                            if(empty($dp))
                            {
                                $p1="default.jpg";
                            }
                            else
                            {
                                $p1="images/dp/$uid/$dp";
                            }

                          ?>
                            <ul class="list-unstyled" >
                                <li><a href="#msgmodal" data-toggle="modal" class="msg" data-uid="<?php echo $uid?>"  style="text-decoration: none;">
                                    <img src="<?php echo $p1?>"  class="mr-1 mt-2 rounded-circle" width="64" height="64"  alt=""><div style="height: 10px; width: 10px; background-color: green; border-radius: 50%; display:inline-block"></div> <?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name</h5>"?>
                                    </a>
                                </li>
                            </ul>
                          <?php
                        }
                        ?>
                    </div>
                   <?php
                }
                else
                {
                    echo "<h5 class='text-primary'> No Friends are Active</h5>";
                }
                ?>
                </div>
            </div>

        </div>
    </div>
 <!-- for post modal -->
    <div class="modal fade" id="postmodal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">ADD POST</h5>
                    <button type="button" style="background-color: red;" class="btn-close" data-dismiss="modal" id="pcl" aria-label="close">X</button>
                </div>
                <div class="modal-body">
                    <form id="pfm">
                        <label for="title">Write Something About Post</label>
                        <input type="text" autocomplete="off" name="title" id="title" class="form-control">

                        <label for="img">Select Image</label>
                        <input type="file" name="file" id="img" class="form-control">
                        <input type="submit" class="btn btn-primary mt-2 text-center" value="Post">
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                    <form action="" class="form-inline">
                        <input type="hidden" name="toid" id="toid">
                        <input type="text" id="txt" autocomplete="off" size="50" class="form-control border border-primary"><button class="btn btn-outline-success send"><i class="fas fa-paper-plane sendicon"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <?php
 require_once "modal.php";
 ?>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/count.js"></script>
    <script src="js/showmsg.js"></script>
    <script src="js/index.js"></script>
    
    
</body>
</html>
