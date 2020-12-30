<?php
session_start();
if(!isset($_SESSION['uid']))
{
     header("location:login.html");
} 
else
{
    $pid=$_GET['pid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Post Details</title>
</head>
<body>
     <?php
      include "header.php";
      if($obj->select("select * from user where uid=".$_SESSION['uid'].""))
      {
          $user=$obj->getresult();
          foreach($user as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
          {
            if(!empty($dp))
            {
                $dir="images/dp/$uid/$dp";
            }
            else
            {
                $dir="default.jpg";
            }
              if($obj->select("select * from post where pid=$pid"))
              {
                  $post=$obj->getresult();
                  foreach($post as list("pid"=>$pid,"title"=>$t,"image"=>$im,"uid"=>$ui,"time"=>$tm,"cat"=>$cat))
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
                            $upimgpath="images/dp/$uid/$im";
                            $about="update profile picture";
                        }
                        else
                        {
                            $upimgpath="images/post/$uid/$im";
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
     <div class="container">
        <div class="row">
            <div class="col-8 offset-2 mt-4">
                    <div class="card">
                              <a href="profile.php?uid=<?php echo $uid?>"  style="text-decoration: none;">
                               <img src="<?php echo $dir?>" class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>$name</h5>  $about"?> 
                               </a> <span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                               
                            <div class="card-body text-center">
                                 <?php
                                 if(!empty($t))
                                 {
                                     ?>
                                     <p class="card-text"><?php echo $t;?><p>
                                     <?php
                                 }
                                 ?>
                                 <?php
                                 if(!empty($im))
                                 {
                                     
                                   echo "<img src='$upimgpath' class='img-fluid rounded'>";  
                                    
                                 }
                                 ?>
                                 <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span></a>
                                 <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary bg-primary likebtn"><i class="fas fa-thumbs-up text-white"></i></button>
                                 <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcmt." "."comments"?></span></a>
                            </div>
                         </div>
                    </div>
              </div>
       </div>                          
                  <?php
                     }
                    else
                    {
                  ?>
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2 mt-4">              
                  <div class="card">
                            <a href="profile.php?uid=<?php echo $uid?>"  style="text-decoration: none;">
                               <img src="<?php echo $dir?>" class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline'>$name</h5> $about"?>
                               </a> <span style="color: #34b7f1; margin-left:70px;"><?php echo $ago?></span>
                               
                             <div class="card-body text-center">
                                 <?php
                                 if(!empty($t))
                                 {
                                     ?>
                                     <p class="card-text"><?php echo $t;?><p>
                                     <?php
                                 }
                                 ?>
                                 <?php
                                 if(!empty($im))
                                 {
                                     
                                   echo "<img src='$upimgpath' class='img-fluid rounded'>";  
                                    
                                 }
                                 ?>
                                <a href="#showlike" class="like" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countlk." "."likes"?></span></a>
                                 <button style="width:90px;border-radius: 50px;" data-pid="<?php echo $pid?>" class="mt-3 border border-primary likebtn"><i class="fas fa-thumbs-up text-primary"></i></button>
                                 <button style="width:90px;border-radius: 50px;" data-toggle="modal" data-target="#cmtmodal" data-pid="<?php echo $pid?>" class="mt-3 ml-3 border border-primary cmtbtn"><i class="fas fa-comment text-primary"></i></button><a href="#scmt" class="cmtno" data-toggle="modal" data-pid="<?php echo $pid?>" style="text-decoration:none;"><span class="badge badge-primary"><?php echo $countcmt ." "."comments"?></span></a>
                             </div>
                           </div>
                      </div>            
                  </div>
              </div>
             <?php
                     }
                     
               }
            } 
            }
        }

        require_once "modal.php";
     ?>
     <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/profile.js"></script>
    <script>
        $(document).ready(function(){
            $("#hn4").addClass("bg-primary");
            $("#hn4").children().addClass("text-white");

        });
    </script>
</body>
</html>
<?php
}
?>