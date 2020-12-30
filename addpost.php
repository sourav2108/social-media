<?php
session_start();
$id=$_SESSION['uid'];
require "database.php";
if(!empty($_POST['title']))
{
    $title=$_POST['title'];
}
else
{
    $title=null;
}
if(!empty($_FILES['file']['name']))
{
    $filename=$_FILES['file']['name'];
$tmp=$_FILES['file']['tmp_name'];
$ext=pathinfo($filename,PATHINFO_EXTENSION);
$arr=['jpg','png','jpeg'];
if(in_array($ext,$arr))
{
    $filename =time().".".$ext;
}
else
{
    echo "plz provide correct formate";
}
$finaldes="images/post/$id/";
if(file_exists($finaldes))
{
    move_uploaded_file($tmp,$finaldes.$filename);
}
else
{
    mkdir($finaldes);
    move_uploaded_file($tmp,$finaldes.$filename);
}

}
else
{
    $filename=null;
}
$t=time();
$ob=new database();
if($ob->insert("post",["title"=>$title,"image"=>$filename,"uid"=>$id,"time"=>$t]))
{
    echo "successfully upload";
}
else
{
    echo "something went wrong ..... try later";
}

?>