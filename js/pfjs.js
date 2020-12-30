$(document).ready(function(){
    $("#hn5").addClass("bg-primary");
    $("#hn5").children().addClass("text-white");

    $(document).on('change','#file',function(){
    var property=document.getElementById("file").files[0];
    var image_name=property.name;
    var image_ext=image_name.split('.').pop().toLowerCase();
    if(jQuery.inArray(image_ext,['png','jpg','jpeg'])== -1)
    {
        alert("Invalid Image File");
    }
     else
     {
        var image_size= property.size;
    if(image_size>6000000)
    {
        alert("image size to Big");
    }
    else
    {
        var form_data=new FormData();
        form_data.append("file",property);
        $.ajax({
            url: "uploadimage.php",
            type: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data){
                if(data==0)
                {
                    alert("something went wrong....try later");
                }
                else
                {
                    
                    location.reload();   
                }
            }
        });
    }
     }
 });

 $("#rembtn").click(function(){
     $.ajax({
          url: "deletedp.php",
          type: "POST",
          success: function(data){
              if(data==1)
              {
                  location="profile.php";
              }
              else
              {
                  alert("something went wrong....try again");
              }
          }
     });
 });

 $(".ms").click(function(){
      var toid=$(this).data("toid");
      var msg=$("#mt").val();
      if(msg !="")
      {
          $.ajax({
              url: "storemsg.php",
              type: "POST",
              data: {toid:toid,msg:msg},
              success: function(data){
                  if(data==1)
                  {
                    $("#mt").val("");
                    location.reload();
                  }
                  else
                  {
                      alert("can't send msg");
                  }
              }
          });
      }
      else
      {
          alert("plz enter your msg");
      }
 });

 $(".connbtn").click(function(){
    var id=$(this).data("uid");
    var x=$(this);
        alert("hii");
    // $.ajax({
    //     url: "ntinsert.php",
    //     type: "POST",
    //     data: {id:id},
    //     success: function(data){
    //         if(data==1)
    //         {

    //             x.html("Request send");
    //             x.attr("disabled",true);
    //         }
    //         else
    //         {
    //          alert("can not send request");
    //         }
    //     }
    // });
});
   
});