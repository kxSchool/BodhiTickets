  var svg = Snap("#svg");
    var size = 1;
    var g = Snap("#all");
     var ktime0 = 1;
      var ktime1 = 1;
      var bindtime=0;
    g.drag();
    //滚动放大    
    var gmini = Snap("#gmini");
 
    //修改
    gmini.drag();
      var $div0 = $("#gmini");
      /* 绑定鼠标左键按住事件 */
      $div0.bind("mousedown",function(event){
      	console.log(bindtime);
        	if(bindtime==0){
        		ktime0=3;
        	   ktime1=2;
        	}
        	bindtime++;
        $(document).bind("mousemove",function(ev){
            matrixz = gmini.transform().localMatrix;
             ssx="matrix("+1/matrixz.a+", 0, 0, "+1/matrixz.a+","+(-1*matrixz.e*1000)/(matrixz.a*150)+", "+(-1*matrixz.f*1000)/(matrixz.a*150)+")";
            $("#all").attr("transform",ssx);
        });
      });
    
    //修改
    var matrix = new Snap.matrix(1,0,0,1,0,0);
    function getAndSetCurrentMatrix(){
    	matrix = g.transform().localMatrix;
    }
    //定时器
        var clearFlag = 0;
            var count = 5;//设置3秒后自动消失
        var showModal = function(text){
              $("#alert_show").html(text);
    		  $("#alert_show").fadeIn();
                clearFlag = setInterval("autoClose()",1000);//每过一秒调用一次autoClose方法
           }
        var autoClose = function(){
            	 if(count>0){
                    count--;
               }else if(count<=0){
                    window.clearInterval(clearFlag); 
                   $("#alert_show").fadeOut();
                    count = 5;
                }
            }
    //修改
//    $("path").click(function(event){
//    	var point = getSvgCenterPoint();
//  	var x = point[0];
//  	var y = point[1];
//    	console.log("111");
//    		bindtime++;
//    	var e = event || window.event;
//          var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
//          var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
//          var x0 = e.pageX || e.clientX + scrollX;
//          var y0 = e.pageY || e.clientY + scrollY;
//         console.log(x0);
//         console.log(y);
//  	    var k=5.0;
////  	    ktime0=10;
////  	    ktime1=4;
//	     matrix.add(k,0,0,k,0,0);
//     ssx="matrix("+(1/matrix.a)+", 0, 0, "+(1/matrix.d)+","+(-x0/2)+","+(-y0)+")";
//     $("#all").attr("transform",ssx);  
//    })
    $("#svg").onmousewheel(function(n){
    	//修改
    	var point = getSvgCenterPoint();
    	var x = point[0];
    	var y = point[1];
    	if(n==1){
    		k = 1.15;
    		// ktime0++
    	}
    	else{
    		k = 0.95;
    		// ktime0--
    	}
//  	console.log( ktime0);
//  	if(ktime0>10){
//  	
//  		alert("已经放到最大了");
//  		ktime0=10;
//  		return false;
//  	}else if(ktime0<1){
//  		alert("已经放到最小了");
//  		ktime0=1;
//  		return false;
//  	}
    	getAndSetCurrentMatrix();
    	matrix.add(1,0,0,1,-(k-1)*x,-(k-1)*y);
    	matrix.add(k,0,0,k,0,0);
    	g.transform(matrix.toString());
        ssx="matrix("+(1/matrix.a)+", 0, 0, "+(1/matrix.d)+","+((-1*matrix.e*150)/1000)+", "+((-1*matrix.f*150)/1000-2)+")";
        $("#gmini").attr("transform",ssx);
    });
        var $div = $("#all");
      /* 绑定鼠标左键按住事件 */
      $div.bind("mousedown",function(event){
        $(document).bind("mousemove",function(ev){
            matrixz = g.transform().localMatrix;
            ssx="matrix("+1/matrixz.a+", 0, 0, "+1/matrixz.a+","+(-1*matrixz.e*150)/(matrixz.a*1000)+", "+(-1*matrixz.f*150)/(matrixz.a*1000)+")";
            $("#gmini").attr("transform",ssx);
        });
      });
      /* 当鼠标左键松开，接触事件绑定 */
      $(document).bind("mouseup",function(){
        $(this).unbind("mousemove");
      });
    function getSvgCenterPoint(){
    	var width = $("#svg").width();
    	var height = $("#svg").height();
    	return [width/2,height/2];
    }
    function getMiniCenterPoint(){
    	var width = $("#gmini").width();
    	var height = $("#gmini").height();
    	return [width/2,height/2];
    }
   
    function big(n){
       //修改
    	var point = getSvgCenterPoint();
    	var x = point[0];
    	var y = point[1];
    	if(n==1){
    		k = 1.25;
//  		if(ktime1<3){
//  			ktime1++;
//  		}else{
//  			ktime1=4;
//  		}
    	}
    	else{
    		k = 0.75;
//  		if(ktime1>0){
//  			ktime1--;
//  		}else{
//  			ktime1=-1;
//  		}
    	}
//  	console.log(ktime1);
//  	if(ktime1>3){
//  		showModal("已经放到最大了");
//  		return false;
//  	}else if(ktime1<0){
//  		showModal("已经放到最小了");
//  		return false;
//  	}
    	   getAndSetCurrentMatrix();
    	matrix.add(1,0,0,1,-(k-1)*x,-(k-1)*y);
    	matrix.add(k,0,0,k,0,0);
    	g.transform(matrix.toString());
        matrixz = g.transform().localMatrix;
        ssx="matrix("+1/matrixz.a+", 0, 0, "+1/matrixz.a+","+(-1*matrixz.e*150)/(matrixz.a*750)+", "+(-1*matrixz.f*150)/(matrixz.a*750)+")";
        $("#gmini").attr("transform",ssx);
    }

     $("circle").mouseenter(function(){
     		var e = event || window.event;
            var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
            var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
            var x0 = e.pageX || e.clientX + scrollX;
            var y0 = e.pageY || e.clientY + scrollY;
            
     
     	$(this).css("stroke",'#850f50');
		$("#select_seat").html("<span>座位：</span>"+$(this).attr('id').split("_")[1]+"排"+$(this).attr('id').split("_")[2]+"座");
		$("#select_section").html("<span>区域：</span>"+$(this).attr('section_name'));
		$("#select_price").html("<span>价格：</span>&nbsp;￥"+$(this).attr('unit_price'));
     	$("#alert_show").css('top',y0);
     	$("#alert_show").css('left',x0);
     	$("#alert_show").css('display','block');
     })
     $("circle").mouseleave(function(){
     	$(this).css("stroke","none");
     		$("#alert_show").css('display','none');
     	
     })