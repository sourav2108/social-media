<?php
session_start();

if(!isset($_SESSION['uid']))
{
    header("location: login.html");
}
else
{
    if(empty($_GET['uid']))
    {
        $id=$_SESSION['uid'];
        $nam=$_SESSION['name'];
    }
    else
    {
        $id=$_GET['uid'];
        $nam="User Profile Page";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title><?Php echo $nam ?></title>
    </head>
    <body>
        <?php include "header.php"; 

        if($obj->select("select * from user where uid=$id"))
        {
            $rt=$obj->getresult();
            foreach($rt as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
            {
                if(empty($dp))
                {
                    $pic="default.jpg";
                }
                else
                {
                    $pic="images/dp/$uid/$dp";
                }
                    ?>   
                <div class="container">
                    <div class="row">
                        <div class="col-8 offset-2 border  border-top-0 border-success">
                            <div class="text-center">
                                <img src="<?php echo $pic; ?>" class="rounded-circle mb-2 mt-4 dpim" width="200" height="200" ><br>
                                <?php        
                                if($id==$_SESSION['uid'])
                                {
                                 ?>
                                    <label class="btn btn-primary" id="dp" for="file">Change DP</label> <input class="d-none file" type="file" name="file" id="file">
                                    <button class="btn btn-primary" id="rembtn">Remove DP</button>
                                 <?php
                               }
                                ?>
                                <h2  style="text-transform: capitalize; color: green;"><?php echo $name ?></h2>
                                <?php        
                                if($id!=$_SESSION['uid'])
                                {
                                    if($obj->select("select * from frnd where to_id=".$_SESSION['uid']." and f_status=2 and from_id=$id"))
                                    {
                                        ?>

                                        <button class="btn btn-primary">Friend</button>
                                        <?php
                                    }
                                    else if($obj->select("select * from frnd where from_id=".$_SESSION['uid']." and f_status=2 and to_id=$id"))
                                    {
                                        ?>
                                        <button class="btn btn-primary">Friend</button>
                                        <?php
                                    }
                                    else if($obj->select("select * from frnd where from_id=".$_SESSION['uid']." and f_status=1 and to_id=$id"))
                                    {
                                        ?>
                                        <button class="btn btn-primary">Request Send</button>
                                        <?php
                                    }
                                    else if($obj->select("select * from frnd where to_id=".$_SESSION['uid']." and f_status=1 and from_id=$id"))
                                    {
                                        ?>
                                          <button class="btn btn-primary cbtn" data-uid="<?php echo $id?>">Confirm</button>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <button class="btn btn-primary connbtn" data-uid="<?php echo $id?>">Connect</button>
                                        <?php
                                    }
                                   ?>
                                    <button class="btn btn-primary" data-uid="<?php echo $id?>" data-toggle="modal" data-target="#msgmodal" id="mbtn">Message</button>
                                   <?php
                                }
                               ?>
                            </div>

                            <div class="ml-4" >
                                <h2 class="border-bottom border-primary">About</h2>

                                <div class="text-center">
                                    <h4 class="d-inline text-primary mr-5 ml-3">Gender : <span class="h5"><?php echo $gen ?></span></h4>
                                    <h4 class="d-inline text-primary">Date of Birth : <span class="h5"><?php echo $dob ?></span></h4><br>
                                    <div class="mt-3">
                                        <h4 class="d-inline text-primary mr-3 ">Mobile No : <span class="h5"><?php echo $mob ?></span></h4>
                                        <h4 class="d-inline text-primary "> Create Date : <span class="h5"><?php echo $date ?></span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 " id="act">
                                <h2 class="border-bottom border-primary">Friends</h2> 
                                <?php
                                if($obj->select("select * from user where uid in((select from_id from frnd where to_id=$id and f_status=2)) or uid in(select to_id from frnd where from_id=$id and f_status=2)"))
                                {
                                    $r1=$obj->getresult();
                                    foreach($r1 as list("uid"=>$uid1,"name"=>$name1,"mob_no"=>$mob1,"password"=>$pass1,"create_date"=>$date1,"dp"=>$dp1,"gender"=>$gen1,"dob"=>$dob1 ,"status"=>$status))
                                    {
                                       
                                        if(empty($dp1))
                                        {
                                            $pat="default.jpg";
                                        }
                                        else
                                        {
                                            $pat="images/dp/$uid1/$dp1";
                                        }
                                        if($status=="online")
                                        {
                                            ?>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="profile.php?uid=<?php echo $uid1?>" style="text-decoration: none;">
                                                        <img src="<?php echo $pat?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""><div style="height: 10px; width: 10px; background-color: green; border-radius: 50%; display:inline-block"></div> <?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name1</h5>"?>
                                                   </a>
                                                </li>

                                            </ul>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a href="profile.php?uid=<?php echo $uid1?>" style="text-decoration: none;">
                                                        <img src="<?php echo $pat?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""><?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name1</h5>"?>
                                                   </a>
                                                </li>

                                            </ul>
                                            <?php 
                                        }
                                    }
                                }
                                else
                                {
                                    echo "<h3> No Friends</h3>";
                                }
                                ?>
                            </div>
                            <div class="ml-4 mt-4">
                                <h2 class="border-bottom border-primary">Profile Photos</h2>
                              <?php
                                $dpdir="images/dp/$id/";
                                if(is_dir($dpdir))
                                {
                                    $open=opendir($dpdir);
                                    while($image=readdir($open))
                                    {
                                        if($image !="." && $image !="..")
                                        {
                                          ?>
                                            <img src="<?php echo $dpdir.$image ?>" class="w-25 m-2 h-25 m-2"  alt="dp">             
                                            <?php
                                        }
                                    }
                                }
                              ?>
                            </div>
                         
                            <div class="ml-4 mt-4">
                                <h2 class="border-bottom border-primary">All Posts</h2>
                               <?php
                                if($obj->select("select * from post where uid=$id order by pid desc"))
                                {
                                    $ans=$obj->getresult();
                                    foreach($ans as list("pid"=>$pid,"title"=>$t,"image"=>$im,"uid"=>$u,"time"=>$time,"cat"=>$cat))
                                    {
                                        // time calculation
                                        $now=time();
                                        $tim=($now-$time);
                                        if($tim<60)
                                        {
                                            $ago="$tim sec ago";
                                        }
                                        else if($tim>=60 && $tim<3600)
                                        {
                                             $xt=ceil($tim/60);
                                            $ago="$xt min  ago";
                                        }
                                        else if($tim>=3600 && $tim<86400)
                                        {
                                            $xc=ceil($tim/3600);
                                            $ago="$xc hr  ago";
                                        }
                                        else
                                        {
                                            $xs=ceil($tim/86400);
                                            $ago="$xs day ago";
                                        }
                                        if(!empty($im))
                                        {
                                            if($cat=="dp")
                                            {
                                                $upimgpath="images/dp/$id/$im";
                                                $about="update profile picture";
                                            }
                                            else
                                            {
                                                $upimgpath="images/post/$id/$im";
                                                $about="add post";
                                            }
                                          
                                        }
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

                                        if($obj->select("select * from cmttb where pid=$pid"))
                                        {
                                            $cmt1=$obj->getresult();
                                            $countcmt=sizeof($cmt1);
                                        }
                                        else
                                        {
                                            $countcmt=0;
                                        }

                                        if($obj->select("select * from liketb where pid=$pid"))
                                        {
                                            $lk=$obj->getresult();
                                            $countlk=sizeof($lk);
                                        }
                                        else
                                        {
                                            $countlk=0;
                                        }

                                        if($obj->select("select * from liketb where uid=".$_SESSION['uid']."  and pid=$pid")) 
                                        {
                                            
                                            ?>
                                            <div class="card">
                                                <a href="profile.php?uid=<?php echo $id?>"  style="text-decoration: none;">
                                                    <img src="<?php echo $pic?>" class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>$name</h5> $about"?><br> <span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                                                </a>
                                         
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
                                                        <img src="<?php echo $upimgpath ?>" class=' img-fluid rounded'>
                                                        <br>  
                                                       <?php
                                                    }
                                                    ?>
                                                    <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span></a>
                                                    <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary bg-primary likebtn"><i class="fas fa-thumbs-up text-white"></i></button>
                                                    <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcmt." "."comments"?></span></a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="card">
                                                <a href="profile.php?uid=<?php echo $id?>"  style="text-decoration: none;">
                                                    <img src="<?php echo $pic?>" class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>$name</h5> $about"?> <br><span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                                                </a>
                                         
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
                                                    }
                                                    ?>  
                                          
                                                    <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span></a>
                                                    <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary likebtn"><i class="fas fa-thumbs-up text-primary"></i></button>
                                                    <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcmt." "."comments"?></span></a>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                else
                                {
                                    echo "<h4 class='text-primary'>No Post</h4>";
                                }
                               ?>
                            </div>
                             
                        </div>
                    </div>
                </div>

               
              <!-- for msg modal -->

                <div class="modal fade" id="msgmodal" data-backdrop="static" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header mx-1 border-bottom border-primary">
                                <h5 class="modal-title" style='text-transform: capitalize;' ><?php echo $name?></h5>
                                <button type="button" style="background-color: red;" class="btn-close mcl" data-dismiss="modal" aria-label="close">X</button>
                            </div>
                            <div class="modal-body mx-1" >
                                <textarea name="mt" id="mt" cols="60" rows="4" autofocus style="resize:none;" class="form-control"></textarea>
                            </div>
                            <div class="text-center m-3">
                                <button class="btn btn-success ms" data-toid="<?php echo $id?>">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
             <?php
            }
        }    
        ?>

            
        <?php
            require_once "modal.php";
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="js/count.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/pfjs.js"></script>
        <script>
        $(document).ready(function(){
            $(".connbtn").click(function(){
                var id=$(this).data("uid");
                var x=$(this);
       
                $.ajax({
                    url: "ntinsert.php",
                    type: "POST",
                    data: {id:id},
                    success: function(data){
                        if(data==1)
                        {
                            x.html("Request send");
                            x.attr("disabled",true);
                        }
                        else
                        {
                            alert("can not send request");
                        }
                    }
                });
            });

            $(".cbtn").click(function(){
                var from_id=$(this).data("uid");
                var c=$(this);
                $.ajax({
                    url:"confirmfrnd.php",
                    type: "POST",
                    data: {id:from_id},
                    success: function(data){
                        if(data==1)
                        {
                            c.html("now you are friend");
                            c.attr("disabled",true);
                        }
                        else
                        {
                            alert("error");
                        }
                    }
                });
            });
            setInterval(function(){
                $("#act").load(" #act");
            },500);
        });
        </script>
    </body>
    </html>
 <?php
}
?>
