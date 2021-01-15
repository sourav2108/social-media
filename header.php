
<?php

$path;
require "database.php";
$obj=new database();
//   for image
  if($obj->select("select * from user where uid=".$_SESSION['uid'].""))
  {
     $val=$obj->getresult();
     if(empty($val[0]['dp']))
     {
         $path="default.jpg";
     }
     else
     {
         $path="images/dp/".$val[0]['uid']."/".$val[0]['dp']."";
         
     }
  }
// for frnd request notification

 if($obj->select("select * from frnd where to_id=".$_SESSION['uid']." and n_status=1"))
 {
     $r2=$obj->getresult();
     $no=sizeof($r2);
 }
 else
 {
     $no=0;
  }

//   for like notification
  if($obj->select("select * from likenotification where to_id=".$_SESSION['uid']." and status=0"))
 {
     $d=$obj->getresult();
     $lno=sizeof($d);
 }
 else
 {
     $lno=0;
  }

// for frnd request
  if($obj->select("select * from frnd where to_id=".$_SESSION['uid']." and f_status=1"))
 {
     $r3=$obj->getresult();
     $fno=sizeof($r3);
 }
 else
 {
     $fno=0;
  }

//   for msg 
  if($obj->select("select * from msg where to_id=".$_SESSION['uid']." and status=0"))
 {
     $r4=$obj->getresult();
     $msgno=sizeof($r4);
 }
 else
 {
     $msgno=0;
  }
  
?>
    <style>
        #uname
        {
            text-transform: capitalize;
            display:inline;
        }
        #hnav li
        {
            width: 30px;
            margin:5px 40px;
            text-align: center;
        }
        @media screen and (max-width: 600px)
        {
            #hnav li
            {
                margin:5px 10px;
            }
        }
    
    </style>
    <!-- for header -->
    <div class="container text-center">
         <h3>SKbook</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 border border-primary">
                
                    <div class="text-center">
                        <a href="profile.php" class="navbar-brand">
                            <?php echo "<h5 id='uname'>".$_SESSION['name']."</h5>"?>
                        </a>
                    </div>
                        <ul id="hnav" class="list-inline">
                            <li class="list-inline-item" id="hn"><a href="index.php"  ><i class="fas fa-home"></i></a></li>
                            <li class="list-inline-item" id="hn2"><a href="frnd.php" ><i class="fas fa-user-friends"></i><span class="badge badge-danger frndspan"><?php if($fno!=0){echo $fno;} ?></span></a></li>
                            <li class="list-inline-item" id="hn3"><a href="msg.php" ><i class="fas fa-comment-alt"></i><span class="badge badge-danger msgspan"><?php if($msgno!=0){echo $msgno;} ?></span></a></li>
                            <li class="list-inline-item" id="hn4"><a href="notification.php" ><i class="fas fa-bell"></i><span class="badge badge-danger ntspan"><?php if(($no+$lno)!=0){echo $no+$lno;} ?></span></a></li>
                            <li class="list-inline-item" id="hn5"><a href="profile.php" ><i class="far fa-id-card"></i></a></li>
                            <li class="list-inline-item dropstart" id="hn6">
                                <button class="dropdown-toggle btn btn-outline-primary " data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                <a href="logout.php" class="dropdown-item bg-primary text-white mb-2 rounded">logout</a>
                                <a href="#changepassmodal" data-toggle="modal" class="dropdown-item bg-primary text-white rounded mb-2">Change Password</a>
                                <a href="#changemobmodal" data-toggle="modal" class="dropdown-item bg-primary text-white rounded">Change Mobile No</a>
                                </div>
                            </li>
                        </ul>
                    
                </nav>
            </div>
        </div>
    </div>

    
    <!-- for change password  modal -->
<div class="modal fade" id="changepassmodal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Change Password</h5>
                <button type="button" style="background-color: red;" class="btn-close" data-dismiss="modal" aria-label="close">X</button>
            </div>
            <div class="modal-body">
                <label for="pass" class="form-label">Enter New Password</label>
                <input type="password" name="pass" class="form-control" id="pass">
                <label for="cpass" class="form-label">Re-enter Password</label>
                <input type="password" name="cpass" class="form-control" id="cpass">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success changep">Change</button>
            </div>
        </div>
    </div>
</div>

<!-- for change mobile no  modal -->
<div class="modal fade" id="changemobmodal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Change Mobile No</h5>
                <button type="button" style="background-color: red;" class="btn-close" data-dismiss="modal" aria-label="close">X</button>
            </div>
            <div class="modal-body">
                <label for="cmob" class="form-label">Enter New Mobile No</label>
                <input type="text" name="cmob" class="form-control" id="cmob">
                <div class="alert alert-warning al">Only Number are allow</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success changemob">Change</button>
            </div>
        </div>
    </div>
</div>
