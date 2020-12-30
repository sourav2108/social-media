$(document).ready(function(){

    setInterval(function(){
        $.ajax({
            url: "countunseenmsg.php",
            type: "POST",
            success: function(data)
            {
                if(data !=0)
                {
                    $(".msgspan").html(data);
                }
            }
        });
    },500);

    setInterval(function(){
        $.ajax({
            url: "countunseennotification.php",
            type: "POST",
            success: function(data)
            {
                if(data !=0)
                {
                    $(".ntspan").html(data);
                }
            }
        });
    },500);

    setInterval(function(){
        $.ajax({
            url: "countunseenfrnd.php",
            type: "POST",
            success: function(data)
            {
                if(data !=0)
                {
                    $(".frndspan").html(data);
                }
            }
        });
    },500);

    $(".changep").click(function(){
       var pass=$("#pass").val();
       var cpass=$("#cpass").val();
       if(pass=="" && cpass=="")
       {
           alert("plz enter some thing");
       }
       else
       {
           if(pass.length<5)
           {
               alert("password atleast 5 char");
           }
           else
           {
               if(pass!==cpass)
               {
                   alert("no matche ..rechack");
               }
               else
               {
                   $.ajax({
                       url: "changepass.php",
                       type: "POST",
                       data: {pass:pass},
                       success: function(data){
                           if(data==1)
                           {
                               alert("successfully change password");
                               location="logout.php";
                           }
                           else{
                               alert("error");
                           }
                       }
                   });
               }
           }
       }
    });
    $(".al").hide();
    $("#cmob").keyup(function(){
        var no=$(this).val();
        var patt=/^[0-9]{10}/;
        if(!patt.test(no))
        {
           $(".al").show();
           $(".changemob").attr("disabled",true);
        }
        else
        {
            $(".al").hide();
            $(".changemob").attr("disabled",false);
        }
    });

    $(".changemob").click(function(){
        var no=$("#cmob").val();
        if(no=="")
        {
            alert("plz enter some input");
        }
        else if(no.length !=10)
        {
            alert("plz enter correct mob no");
        }
        else
        {
            $.ajax({
                url: "changemob.php",
                type: "POST",
                data: {no:no},
                success: function(data){
                    if(data==1)
                    {
                        alert("successfully change mobile no");
                        location="logout.php";
                    }
                    else{
                        alert("error");
                    }
                }
            });
        }
    });
});