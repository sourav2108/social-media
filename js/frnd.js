$(document).ready(function(){
    $("#hn2").addClass("bg-primary");
    $("#hn2").children().addClass("text-white");
    

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
                    c.siblings(".dbtn").fadeOut();
                }
                else
                {
                    alert("error");
                }
            }
        });
    });

    $(".dbtn").click(function(){
        var from_id=$(this).data("uid");
         $.ajax({
            url:"deletefrnd.php",
            type: "POST",
            data: {id:from_id},
            success: function(data){
                if(data==1)
                {
                    location="frnd.php";
                }
                else
                {
                    alert("error");
                }
            }
        });
    });
   
});