<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>票务选座系统[<?php echo $showInfo['name'];?>]</title>
    <style type="text/css">
        <?php echo $mapInfo['style'];?>
    </style>
    <script type="text/javascript">
        //////////////////////////////////////////////////////////////////////
        // 章爱军(永远的大牛)                                               //
        // Trial License: For evaluation only!                              //
        // (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
        //////////////////////////////////////////////////////////////////////
        addCart_url="<?php echo site_url('index/addCart'); ?>";
        delCart_url="<?php echo site_url('index/delCart'); ?>";
        getCart_url="<?php echo site_url('index/getCart'); ?>";
        panorama_url="<?php echo site_url('index/panorama'); ?>";
        panoram=<?php echo $panorama; ?>;
        price={"price_280":"1","price_580":"1","price_880":"1","price_1080":"1","price_1980":"1"};
        area_price={"area_101_price_1080":"1","area_101_price_1980":"1","C-1":"0","D-1":"0","E-1":"0","F-1":"0"};
        area={"A":"0","B":"0","C":"0","D":"0","E":"0","F":"0"};
        seat={"seat":"1"};
        background={"background":"1"};
        map={"seats":"1"};
        EventId="<?php echo $EventId; ?>";
        UserId="<?php echo $UserId; ?>";
        AppId="<?php echo $AppId; ?>";
        iframes='http://www.mydeershow.com/static/partials/main/c.html';
        //iframes='http://localhost:8082/static/partials/main/c.html';
    </script>
    <script src="<?php echo CRM_STATIC_PATH; ?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo CRM_STATIC_PATH; ?>js/cart.js"></script>
    <script type="text/javascript">
    function creatFrame(){
      if(typeof(oFrame)=='undefined'){
          oFrame = document.createElement('iframe');
          oFrame.src = iframes +'?a='+ Math.random();
          oFrame.style.display = 'none';
          document.body.appendChild(oFrame);
      }else{
          oFrame.src = iframes +'?a='+ Math.random();
      }
    }
    function errorTicket(errorString){
        alert(errorString);
    }
    </script>
</head>
<body>
<div id="alert_show">
		<p id="select_seat"></p >
		<p id="select_section"></p >
		<p id="select_price"></p >
	</div>
    
    <div id="svg" style="border:0;padding:5px;overflow: hidden;width: 1100px;height:677px;margin-left:auto;margin-right:auto;">
        <svg id="svgmap" width="1100" height="966" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  style="cursor: default;display:block;overflow: hidden;">
            <g class="transform" id="all" transform="matrix(0.5134,0,0,0.5134,303.3275,72.6637)">
                <image id="bg" x="0" y="0" width="1000" height="1000" xlink:href="<?php echo $mapInfo['background_url'];?>"></image>
                <g class="map_area"><?php echo $mapInfo['area']; ?></g>
                <g class="seats" id="seats">
                <?php if($mapInfo['id']=="5"):?>
                <?php foreach($seatsInfo as $v):?>
                    <circle <?php if($v['status']=='1'):?><?php if($v['unit_price']=='280'):?> class="p280"<?php endif;?><?php if($v['unit_price']=='580'):?> class="p580"<?php endif;?><?php if($v['unit_price']=='880'):?> class="p880"<?php endif;?><?php if($v['unit_price']=='1080'):?> class="p1080"<?php endif;?><?php if($v['unit_price']=='1980'):?> class="p1980"<?php endif;?><?php endif;?> r="3" cy="<?php echo $v['cy'];?>" cx="<?php echo $v['cx'];?>" section_name="<?php echo $v['section_name'];?>" unit_price="<?php echo $v['unit_price'];?>" id="<?php echo $v['seat_no'];?>"/>
				<?php endforeach;?>
                <?php endif;?><?php if($mapInfo['id']=="7"):?>
                <?php foreach($seatsInfo as $v):?>
                    <circle <?php if($v['status']=='1'):?><?php if($v['unit_price']=='80'):?> class="p80"<?php endif;?><?php if($v['unit_price']=='168'):?> class="p168"<?php endif;?><?php endif;?> r="13" cy="<?php echo $v['cy'];?>" cx="<?php echo $v['cx'];?>" section_name="<?php echo $v['section_name'];?>" unit_price="<?php echo $v['unit_price'];?>" id="<?php echo $v['seat_no'];?>"/>
				<?php endforeach;?>
                <?php endif;?>
                </g>
                <?php if($mapInfo['id']=="5"):?>
                <g class="price" id="price"><?php echo $mapInfo['price'];?></g>
                <?php endif;?>
            </g>
        </svg> 
        <div style="width: 150px;height: 153px;display: block;border: 1px solid #eee;padding: 5px;position: relative;overflow: hidden;top: -478px;float:right;right: 9px;">
            <div class="zoom-btns">
                <button id="sm-zoom-in-btn" onclick="big(1);" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAMAAABFjsb+AAAABlBMVEX///////9VfPVsAAAAAXRSTlMAQObYZgAAABVJREFUeAFjgANGOGvQizFigqHoDwAc8gAmwNKSrQAAAABJRU5ErkJggg==);font-size: 1.40625rem;text-decoration: none;color: #FFF;background-color: #afd8de;width: 2.1875rem;height: 2.1875rem;line-height: 2.1875rem;-webkit-border-radius: .1875rem;-moz-border-radius: .1875rem;border-radius: .1875rem;text-align: center;border: 0;padding: 0;outline: 0;background-position: 50% 50%;background-repeat: no-repeat;" aria-label="Zoom In"></button>
                <button id="sm-zoom-out-btn" onclick="big(0);" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAABCAMAAAALkGVuAAAAA1BMVEX///+nxBvIAAAACklEQVR4AWPAAgAAFAABYb2svwAAAABJRU5ErkJggg==);font-size: 1.40625rem;text-decoration: none;color: #FFF;background-color: #afd8de;width: 2.1875rem;height: 2.1875rem;line-height: 2.1875rem;-webkit-border-radius: .1875rem;-moz-border-radius: .1875rem;border-radius: .1875rem;text-align: center;border: 0;padding: 0;outline: 0;background-position: 50% 50%;background-repeat: no-repeat;margin-left: 65px;" aria-label="Zoom Out" ng-disabled="!mapScaled"></button>
            </div>
            <div class="img-wrapper" ng-show="mapScaled" style="overflow: hidden;">
                <img class="ng-scope" id="mini" ng-if="model.seatSelectType !== 'open'"  ng-src="<?php echo $mapInfo['mini_url'];?>" src="<?php echo $mapInfo['mini_url'];?>">
                <svg id="minimap"  style="display: block;position: relative;top: -118px;height: 400px;">
                    <g class="frame"  id="gmini"  transform="translate(0,0) scale(1)">
                        <rect class="overlay" width="112px" height="57px" style="fill: #007b8e;stroke: #007b8e;stroke-width:0;fill-opacity: .2;"></rect>
                    </g>
                </svg>
            </div>
        </div>
        <img src="<?php echo CRM_STATIC_PATH; ?>image/close.png" id="close" style="display:none;width:20px;position: relative;z-index: 102;top: -966px;left: 1080px;" />
        <iframe id="panorama" src="<?php echo site_url('index/panorama');?>"?section_id=1" style="display:none;border:0;width: 1100px;height: 700px;position: relative;z-index: 100;top:-1131px"></iframe>
        <div id="button" style="position: relative;top: -348px;font-size: 14px;">
            <?php if($mapInfo['id']=="5"):?>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #4dc7bc;color: #fff;border:1px solid #4dc7bc ;float: left;text-align: center;">280</div>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #fcc257;color: #fff;border:1px solid #fcc257 ; float: left;margin-left: 5px;text-align: center;">580</div>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #55a2d6;color: #fff;border:1px solid #55a2d6 ;float: left;margin-left: 5px;text-align: center;">880</div>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #f48691;color: #fff;border:1px solid #f48691 ;float: left;margin-left: 5px;text-align: center;">1080</div>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #8c4f9c;color: #fff;border:1px solid #8c4f9c ;float: left;margin-left: 5px;text-align: center;">1980</div><br />
            <?php endif;?>
            <?php if($mapInfo['id']=="7"):?>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #e9c2c3;color: #fff;border:1px solid #e9c2c3 ;float: left;text-align: center;">80</div>
            <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #afc3ce;color: #fff;border:1px solid #afc3ce ; float: left;margin-left: 5px;text-align: center;">168</div>
            <?php endif;?>
        </div>
        <div id="loading" style="display:none;width: 1100px;height: 677px;top: -1020px;position: relative;">
        <img src="<?php echo CRM_STATIC_PATH; ?>image/loading.gif" style="display: block;position:fixed;left:50%;top:50%;margin-left:width/2;margin-top:height/2;"/>
        </div>
    </div>
    
    <svg>
        <pattern id="pattern-seat-selected" patternUnits="objectBoundingBox" width="1" height="1">
        <?php if($mapInfo['id']=="5"):?>
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23333' d='M85.8 9l13.4 11.3c.8.7 1 1.9.3 2.8L41.7 91.9c-.5.5-1.1.8-1.7.7-.4 0-.9-.2-1.2-.5L.7 60.2c-.8-.7-1-2-.3-2.8L11.7 44c.7-.8 2-.9 2.8-.2l23.2 19.5L83 9.2c.8-.9 2-.9 2.8-.2z'/%3E%3C/svg%3E" x="0" y="0" ng-attr-width="6" ng-attr-height="6" width="6" height="6">
            </image>
        <?php endif;?>
        <?php if($mapInfo['id']=="7"):?>
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23333' d='M85.8 9l13.4 11.3c.8.7 1 1.9.3 2.8L41.7 91.9c-.5.5-1.1.8-1.7.7-.4 0-.9-.2-1.2-.5L.7 60.2c-.8-.7-1-2-.3-2.8L11.7 44c.7-.8 2-.9 2.8-.2l23.2 19.5L83 9.2c.8-.9 2-.9 2.8-.2z'/%3E%3C/svg%3E" x="0" y="0" ng-attr-width="25" ng-attr-height="25" width="25" height="25">
            </image>
        <?php endif;?>
        </pattern>
    </svg> 
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/snap.svg-min.js"></script>
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/wheel.js"></script>
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/map.js"></script>
    <script type="text/javascript">
    var svg = Snap("#svg");
    var size = 1;
    var g = Snap("#all");
    g.drag();
    //滚动放大    
    var gmini = Snap("#gmini");
    var matrix = new Snap.matrix(1,0,0,1,0,0);
    function getAndSetCurrentMatrix(){
    	matrix = g.transform().localMatrix;
    }
    $("#svg").onmousewheel(function(n){
    	getAndSetCurrentMatrix();
    	var point = getSvgCenterPoint();
    	var x = point[0];
    	var y = point[1];
    	var k = 1;
    	if(n==1){
    		k = 1.05;
    	}
    	else{
    		k = 0.95;
    	}
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
        getAndSetCurrentMatrix();
    	var point = getSvgCenterPoint();
    	var x = point[0];
    	var y = point[1];
    	var k = 1;
    	if(n==1){
    		k = 1.35;
    	}
    	else{
    		k = 0.75;
    	}
    	matrix.add(1,0,0,1,-(k-1)*x,-(k-1)*y);
    	matrix.add(k,0,0,k,0,0);
    	g.transform(matrix.toString());
        matrixz = g.transform().localMatrix;
        ssx="matrix("+1/matrixz.a+", 0, 0, "+1/matrixz.a+","+(-1*matrixz.e*150)/(matrixz.a*750)+", "+(-1*matrixz.f*150)/(matrixz.a*750)+")";
        $("#gmini").attr("transform",ssx);
    }
    </script>
    
    
</body>
</html>
