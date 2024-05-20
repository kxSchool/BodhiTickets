//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
var carts;
function delCart(ids){
    $.ajax({
        url : delCart_url,
        type : 'post',
        dataType : 'json',
        data : {'seatNo':ids,'UserId':UserId,'AppId':AppId,'EventId':EventId},
        success:function(data){
            carts=data.cart;
            if(data.code == 200){
                creatFrame();
                $("#"+ids).attr("class",$("#"+ids).attr("class").replace(/selectseat/, "").replace(/ /, ""));
            }else{
                alert(data.alert);
            }
          }
    });
}
$(document).ready(function(){
    $.ajax({
        url : getCart_url,
        type : 'post',
        dataType : 'json',
        data : {'UserId':UserId,'AppId':AppId,'EventId':EventId},
        success:function(data){
            if(data.code == 200){
                carts=data.cart;
                for (var i in carts){
                    $("#"+carts[i]).attr("class","selectseat "+$("#"+carts[i]).attr("class"));
                }
            }
          }
    }); 
                    
    $("circle").click(function(){
        $("#svg").hide();
        if (($("#"+this.id).attr("class")!=null) && ($("#"+this.id).attr("class")!='')){
            ids=this.id;
            x=$("#"+this.id).attr("section_name");
            if(panoram.indexOf(x)>=0){
                iframe=panorama_url+"?section_name="+x;
                $('#panorama').attr('src',iframe);
                $("#close").show(500);
            }else{
                $("#panorama").hide();
                $('#panorama').attr('src',"");
                $("#close").hide(500);
            }
            if ($("#"+this.id).attr("class").indexOf('selectseat')>=0){
                    $.ajax({
                    url : delCart_url,
                    type : 'post',
                    dataType : 'json',
                    data : {'seatNo':ids,'UserId':UserId,'AppId':AppId,'EventId':EventId},
                    success:function(data){
                        carts=data.cart;
                        if(data.code == 200){
                            creatFrame();
                            $("#"+ids).attr("class",$("#"+ids).attr("class").replace(/selectseat/, "").replace(/ /, ""));
                            //alert("Cancel Success");
                        }else{
                            errorTicket(data.alert);
                        }
                      }
                    });
            }else{
                if (this.id!='bg-seatmap'){
                    $.ajax({
                    url : addCart_url,
                    type : 'post',
                    dataType : 'json',
                    data : {'seatNo':ids,'UserId':UserId,'AppId':AppId,'EventId':EventId},
                    success:function(data){
                        carts=data.cart;
                        if(data.code == 200){
                            creatFrame();
                            $("#"+ids).attr("class","selectseat "+$("#"+ids).attr("class"));
                            //alert("Order Success");
                        }else{
                            errorTicket(data.alert);
                        }
                      }
                    }); 
                }
            }
            $("#svg").show();
        }
    })
    //座位票价区块操作     
    $("#close").click(function(){
        if ($("#panorama").css('display')=="none"){
            $("#panorama").show();
            $("#home").hide(); 
            $("#all").hide();
        }else{
            $("#panorama").hide();
            $("#home").show();
            $("#close").hide();
            $("#all").show();
        }
     });        
//     $(".area").click(function(){
//        x=$(this).val();
//        if ($("#area_"+x).css('display')=="none"){
//            $("#area_"+x).show();
//            area[x]="1";
//        }else{
//            $("#area_"+x).hide();
//            area[x]="0";
//        }
//        if(panoram.indexOf(x)>=0){
//            iframe=panorama_url+"?section_name="+x;
//            $('#panorama').attr('src',iframe);
//            $("#close").show(500);
//        }else{
//            $("#panorama").hide();
//            $('#panorama').attr('src',"");
//            $("#close").hide(500);
//        }
//            
//     });
     $(".area_price").click(function(){
        x=$(this).val();
        if ($("."+x).css('display')=="none"){
            $("."+x).show();
            area_price[x]="1";
        }else{
            $("."+x).hide();
            area_price[x]="0";
        }
     });
     $(".price").click(function(){
        x=$(this).text();
        if (price["price_"+x]=="0"){
            $("circle[unit_price="+x+"]").show();
            price["price_"+x]="1";
        }else{
            $("circle[unit_price="+x+"]").hide();
            price["price_"+x]="0";
        }
     });
     $("path").click(function(){
        x=$(this).attr("area");
        if(panoram.indexOf(x)>=0){
            iframe=panorama_url+"?section_name="+x;
            $('#panorama').attr('src',iframe);
            $("#close").show(500);
        }else{
            $("#panorama").hide();
            $('#panorama').attr('src',"");
            $("#close").hide(500);
        }
        if ($(this).attr("price")>0){
            $(this).hide();
            //console.log(window.location.href);
            //console.log(x);
            $("#area").attr("value",x);
            $("#selform").attr("action",window.location.href);
            $("#selform").submit();
        }
            
     });
     $(".background").click(function(){
        if ($("#bg").css('display')=="none"){
            $("#bg").show();
            background["background"]="1";
        }else{
            $("#bg").hide();
            background["background"]="0";
        }
     });
     $(".map").click(function(){
        x=$(this).val();
        if ($("#seats").css('display')=="none"){
            $("#seats").show();
            map[x]="1";
        }else{
            $("#seats").hide();
            map[x]="0";
        }
     });                                         
        });