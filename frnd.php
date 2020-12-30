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
        .connbtn
        {
            border-radius: 50px;
            border: 1px solid blue;
        }
    </style>
    <title>Friends</title>
</head>
<body>
    <?php 
    require "header.php";
    ?>
    <!-- for frnd request -->
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2 mt-4">
                <ul class="list-unstyled">
                 <?php
                    if($obj->select("select * from user where uid in(select from_id from frnd where to_id=".$_SESSION['uid']." and f_status=1)"))
                    {
                        $from=$obj->getresult();
                            
                        foreach($from as list("uid"=>$uid,"name"=>$name,"mob_no"=>$mob,"password"=>$pass,"create_date"=>$date,"dp"=>$dp,"gender"=>$gen,"dob"=>$dob))
                        {
                            $p;
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
                                        <img src="<?php echo $p?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='font-weight:bold; text-transform: capitalize; display:inline;'>$name</h5>"?>
                                    </a> <button class="btn btn-primary cbtn ml-1 mr-4" data-uid="<?php  echo $uid;?>">confirm</button><button data-uid="<?php  echo $uid;?>" class="btn btn-primary dbtn">delete</button>
                                </li>
                         <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
   
    <div class="container">
        <div class="row">
            <!-- for show  search frnd -->
            <div class="col-4 offset-2 mt-4 border-right border-dark">
                <h3 class=" border-bottom border-primary"><input type="text" placeholder="Search Friends..." id="scrfrnd" class="border-0 form-control"></h3>
                <ul class="list-unstyled" id="scrshow">
                   
                </ul>    
            </div>
            <!-- for confirmed frnd -->
            <div class="col-4 mt-4 text-center">
                <?php
                
                if($obj->select("select * from user where uid in((select from_id from frnd where to_id=".$_SESSION['uid']." and f_status=2)) or uid in(select to_id from frnd where from_id=".$_SESSION['uid']." and f_status=2)"))
                {
                    $r1=$obj->getresult();
                    $size=sizeof($r1);

                   ?>
                    <div class="border-bottom border-primary">
                        <h4 id="frndshow">Friend <span class="badge badge-danger"><?php echo $size;?></span></h4>
                    </div>

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
                            <ul class="list-unstyled">
                                <li>
                                    <a href="profile.php?uid=<?php echo $uid?>" style="text-decoration: none;">
                                        <img src="<?php echo $p1?>"  class="mr-3 mt-2 rounded-circle" width="64" height="64"  alt=""> <?php echo "<h5 style='text-transform: capitalize; display:inline;'>$name</h5>"?>
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
                    echo "<h3>You Have No Friend</h3>";
                }
                ?>
                
                   
            </div>
        </div>
    </div>
           


    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/count.js"></script>
    <script src="js/frnd.js"></script>
    <script>
        $(document).ready(function(){
            $("#scrfrnd").keyup(function(){
                var x=$(this).val();
                $.ajax({
                    url: "scrfrnd.php",
                    type: "POST",
                    data: {scr:x},
                    success: function(data){
                          $("#scrshow").html(data);
                    }
                });
            });
            $(document).on("click",".connbtn",function(){
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
        });
    </script>
</body>
</html>