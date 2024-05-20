<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<title>票务选座系统[<?php echo $showInfo['name']; ?>]</title>
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
        cat_left=<?php echo $mapInfo['cat_left'];?>;
        cat_top=<?php echo $mapInfo['cat_top'];?>;
        cat_scaleVal=<?php echo $mapInfo['cat_scaleVal'];?>;
    </script>
    <script src="<?php echo CRM_STATIC_PATH; ?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo CRM_STATIC_PATH; ?>js/cart.js"></script>
    <script type="text/javascript">
    function creatFrame(){
        alert("alert success");
        console.log("console log success");
         $.ajax({
            url : "<?php echo CRM_STATIC_PATH; ?>creatFrame"
        });
        return("return success");
    }
    function errorTicket(errorString){
        alert(errorString);
        console.log(errorString);
        $.ajax({
            url : "<?php echo CRM_STATIC_PATH; ?>errorTicket/"+errorString
        });
        return errorString;
    }
    </script>
</head>
<body>
    <?php if($mapInfo['id']=="5"):?>
    <div id="button" style="position: relative;font-size: 14px;">
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #4dc7bc;color: #fff;border:1px solid #4dc7bc ;float: left;text-align: center;">280</div>
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #fcc257;color: #fff;border:1px solid #fcc257 ; float: left;margin-left: 5px;text-align: center;">580</div>
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #55a2d6;color: #fff;border:1px solid #55a2d6 ;float: left;margin-left: 5px;text-align: center;">880</div>
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #f48691;color: #fff;border:1px solid #f48691 ;float: left;margin-left: 5px;text-align: center;">1080</div>
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #8c4f9c;color: #fff;border:1px solid #8c4f9c ;float: left;margin-left: 5px;text-align: center;">1980</div><br />
    </div>
    <?php endif;?>
            
    <?php if($mapInfo['id']=="7"):?>
    <div id="button" style="position: relative;font-size: 14px;">
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #e2263c;color: #fff;border:1px solid #e2263c ;float: left;text-align: center;">80</div>
        <div class="price" style="cursor: pointer;width: 45px;height:20px;background-color: #ff7353;color: #fff;border:1px solid #ff7353 ; float: left;margin-left: 5px;text-align: center;">168</div>
    </div>
    <?php endif;?>
    <div id="svg" style="border:1px solid #eee;padding:5px;overflow: hidden;width: 97%;height:500px;-webkit-tap-highlight-color:transparent;">
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
                    <circle <?php if($v['status']=='1'):?><?php if($v['unit_price']=='80'):?> class="p80"<?php endif;?><?php if($v['unit_price']=='168'):?> class="p168"<?php endif;?><?php endif;?> r="11" cy="<?php echo $v['cy'];?>" cx="<?php echo $v['cx'];?>" section_name="<?php echo $v['section_name'];?>" unit_price="<?php echo $v['unit_price'];?>" id="<?php echo $v['seat_no'];?>"/>
				<?php endforeach;?>
                <?php endif;?>
                </g>
                <?php if($mapInfo['id']=="5"):?>
                <g class="price" id="price"><?php echo $mapInfo['price'];?></g>
                <?php endif;?>
            </g>
        </svg>
        <div id="home" onclick="home();" style="width: 20px;height: 20px;display: block;padding: 5px;position: relative;overflow: hidden;top: -967px;left: 0px;">
            <img src="<?php echo CRM_STATIC_PATH; ?>image/reload.png" />
        </div>
         <img src="<?php echo CRM_STATIC_PATH; ?>image/close.png" id="close" style="display:none;width:20px;position: relative;z-index: 102;top: -968px;left: 6px;" />
        <iframe id="panorama" src="<?php echo site_url('index/panorama');?>?section_id=1" style="display:none;border:0;width: 100%;height: 500px;position: relative;z-index: 100;top: -1020px;left: 1px;"></iframe>
    </div>
    <svg>
        <pattern id="pattern-seat-selected" patternUnits="objectBoundingBox" width="1" height="1">
        <?php if($mapInfo['id']=="5"):?>
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23333' d='M85.8 9l13.4 11.3c.8.7 1 1.9.3 2.8L41.7 91.9c-.5.5-1.1.8-1.7.7-.4 0-.9-.2-1.2-.5L.7 60.2c-.8-.7-1-2-.3-2.8L11.7 44c.7-.8 2-.9 2.8-.2l23.2 19.5L83 9.2c.8-.9 2-.9 2.8-.2z'/%3E%3C/svg%3E" x="0" y="0" ng-attr-width="6" ng-attr-height="6" width="6" height="6">
            </image>
        <?php endif;?>
        <?php if($mapInfo['id']=="7"):?>
            <image xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%23333' d='M85.8 9l13.4 11.3c.8.7 1 1.9.3 2.8L41.7 91.9c-.5.5-1.1.8-1.7.7-.4 0-.9-.2-1.2-.5L.7 60.2c-.8-.7-1-2-.3-2.8L11.7 44c.7-.8 2-.9 2.8-.2l23.2 19.5L83 9.2c.8-.9 2-.9 2.8-.2z'/%3E%3C/svg%3E" x="0" y="0" ng-attr-width="22" ng-attr-height="22" width="22" height="22">
            </image>
        <?php endif;?>
        </pattern>
    </svg> 
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/snap.svg-min.js"></script>
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/touch.js"></script>
    <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/cat.touchjs.js"></script>
    <script type="text/javascript">
    $("path[area='<?php echo $area;?>']").hide();
    var svg = Snap("#svg");
    var size = 1;
    var g = Snap("#all"); 
    var matrix = new Snap.matrix(1,0,0,1,0,0);
    var $targetObj = $('#all');
    function getAndSetCurrentMatrix(){
    	matrix = g.transform().localMatrix;
    }
    function home() {
        console.log(cat.touchjs.scaleVal);
        cat.touchjs.left=cat_left;
        cat.touchjs.top=cat_top;
        cat.touchjs.scaleVal=cat_scaleVal;
        cat.touchjs.rotateVal=0;
        cat.touchjs.curStatus = 0;
        var transformStyle = 'matrix(1,0,0,1,'+cat_left+','+cat_top+') scale('+cat_scaleVal+') rotate(0deg)';//-90,14
        $targetObj.css("transform", transformStyle).css("-webkit-transform", transformStyle);

    }
    
    $(function () {
            
            $(document).on('touchmove',function(ev){
                ev.preventDefault();//阻止默认事件
            });
            //初始化设置
            cat.touchjs.init($targetObj, function (left, top, scale, rotate) {
                //$('#left').text(left);
                //$('#top').text(top);
                //$('#scale').text(scale);
                //$('#rotate').text(rotate);
            });
            //初始化拖动手势（不需要就注释掉）
            cat.touchjs.drag($targetObj, function (left, top) {
            });
            //初始化缩放手势（不需要就注释掉）
            cat.touchjs.scale($targetObj, function (scale) {
                //$('#scale').text(scale);
            });
            home();
            
        });
    </script> 
    <form action="" method="post" id="selform" name="selform" style="display: none;"><input type="text" name="area" id="area"/></form>   
</body>
</html>
