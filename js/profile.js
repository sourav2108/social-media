$(document).ready(function(){
    
function likenotification(pid)
{
$.ajax({
url: "likenotification.php",
type: "POST",
data: {pid:pid},
success: function(data){
    location.reload();
}
});
}

   $(".likebtn").click(function(){
       var pid=$(this).data("pid");
       var x=$(this);

       $.ajax({
           url: "checklike.php",
           type: "POST",
           data: {pid:pid},
           success: function(data){
               if(data==1)
               {
                   alert("already done");
               }
               else
               {
                $.ajax({
                 url: "like.php",
                 type: "POST",
                 data: {pid:pid},
                 success: function(data){
                      if(data==1)
                      {
                         x.addClass("bg-primary");
                         x.children().removeClass("text-primary");
                         x.children().addClass("text-white");
                         likenotification(pid);
                      }
                      else
                      {
                        alert("error");
                       }
                     }
                   });
               }
           }
       });
   });

   $(".cmtbtn").click(function(){
       var pid=$(this).data("pid");
       $("#pid").attr("value",pid);
       
   });

   $(".cmtpost").click(function(){
       var pid=$("#pid").val();
       var cmt=$("#cmt").val();
      if(cmt == "")
      {
        alert("plz enter your comment");
      }
      else
      {
        $.ajax({
            url: "insertcmt.php",
            type: "POST",
            data: {pid:pid,cmt:cmt},
            success: function(data){
                if(data==1)
                {
                    alert("successfully upload");
                    $("#cmtcl").trigger("click");
                    location.reload();
                }
                else
                {
                    alert("can't give comment");
                }
            }
        });
      }
       
   });
   
   $(".cmtno").click(function(){
       var pid=$(this).data("pid");
       $.ajax({
           url: "commentdetails.php",
           type: "POST",
           data: {pid:pid},
           success: function(data){
               $("#cmtdetails").html(data);
           }
       });
   });

   $(".like").click(function(){
       var pid=$(this).data("pid");
       $.ajax({
           url: "likedetails.php",
           type: "POST",
           data: {pid:pid},
           success: function(data){
               $("#likedetails").html(data);
           }
       });
   });
});