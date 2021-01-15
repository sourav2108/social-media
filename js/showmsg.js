$(document).ready(function(){
    var msgtoid=2;
    $(document).on("click",".msg",function(){
        var x=$(this).data("uid");
        $.getJSON("loaddata.php?id="+x+"", function(data){
            $(".p").html(data[0].name);
            $("#toid").attr("value",data[0].uid);
            msgtoid=data[0].uid;
        });
        $.ajax({
            url: "updatemsg.php",
            type: "POST",
            success: function(data){

            }
        });
    });

    $(".send, .sendicon").mouseenter(function(){
        $(".sendicon").addClass("text-white");
        $(".sendicon").removeClass("text-success");
    });
    $(".send, .sendicon").mouseout(function(){
        $(".sendicon").addClass("text-success");
        $(".sendicon").removeClass("text-white");
    });


    setInterval(function(){
        loadmsg(msgtoid);
    },500);

    function loadmsg(id)
    {
        $.ajax({
            url: "loadmsg.php",
            type: "POST",
            data: {id:id},
            success: function(data){
                 $("#msgshow").html(data);
            }
        });
    }
    function store(toi,msg)
    {
        $.ajax({
            url: "storemsg.php",
            type: "POST",
            data: {toid:toi, msg:msg},
            success: function(data){
               if(data==1)
               {
                $("#txt").val("");
                loadmsg(toi);
               }
               else
               {
                   alert("error");
               }
            }
           });
    }
    $("#txt").keydown(function(e){
        var to=$("#toid").val();
        var ms=$("#txt").val();
        if(e.keyCode===13)
        {
            if(msg !="")
            {
                store(to,ms);
                break;
            }
            else
            {
                alert("plz write msg");
            }  
        }
    });
    $(".send").click(function(e){
        e.preventDefault();
        var toi=$("#toid").val();
        var msg=$("#txt").val();
        if(msg !="")
        {
            store(toi,msg);
        }
        else
        {
            alert("plz write msg");
        }  
    });

    $(".msgcl").click(function(){
        location.reload();
    });
});