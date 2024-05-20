/*
* author: www.somethingwhat.com
*/
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
var cat = window.cat || {};
cat.touchjs = {
    left: cat_left, 
    top: cat_top,
    scaleVal: cat_scaleVal,    //缩放
    rotateVal: 0,   //旋转
    curStatus: 0,   //记录当前手势的状态, 0:拖动, 1:缩放, 2:旋转
    //初始化
    init: function ($targetObj, callback) {
        touch.on($targetObj, 'touchstart', function (ev) {
            cat.touchjs.curStatus = 0;
        });
        if (!window.localStorage.cat_touchjs_data)
            callback(0, 0, cat_scaleVal, 0);
        else {
            var jsonObj = JSON.parse(window.localStorage.cat_touchjs_data);
        }
            var l=0;
            var t=0;
            var transformStyle = 'matrix(1,0,0,1,'+l+','+t+') scale(' + cat.touchjs.scaleVal + ') rotate(' + cat.touchjs.rotateVal + 'deg)';
            $targetObj.css("transform", transformStyle).css("-webkit-transform", transformStyle);
    },
    //拖动
    drag: function ($targetObj, callback) {
        getAndSetCurrentMatrix();
        touch.on($targetObj, 'drag', function (ev) {
                var l=cat.touchjs.left + ev.x;
                var t=cat.touchjs.top + ev.y;
                var transformStyle = 'matrix('+cat.touchjs.scaleVal+',0,0,'+cat.touchjs.scaleVal+','+l*cat.touchjs.scaleVal+','+t*cat.touchjs.scaleVal+')';
                $targetObj.css("transform", transformStyle).css("-webkit-transform", transformStyle);
        });
        touch.on($targetObj, 'dragend', function (ev) {
            cat.touchjs.left = (cat.touchjs.left + ev.x)*1;
            cat.touchjs.top = (cat.touchjs.top + ev.y)*1;
            callback(cat.touchjs.left, cat.touchjs.top);
        });
    },
    //缩放 
    scale: function ($targetObj, callback) {
        
        var initialScale = cat.touchjs.scaleVal || cat_scaleVal;
        var currentScale;
        touch.on($targetObj, 'pinch', function (ev) {
            if (cat.touchjs.curStatus == 2) {
                return;
            }
            cat.touchjs.curStatus = 1;
            if($('#scale').text()==cat_scaleVal){
                initialScale=cat_scaleVal;
                cat.touchjs.scaleVal =cat_scaleVal;
            }
            currentScale = initialScale + ev.scale - 1;
            if (currentScale<4 && currentScale>cat_scaleVal){
                $('#scale').text(currentScale);
                cat.touchjs.scaleVal = currentScale;
                getAndSetCurrentMatrix();
                var transformStyle = 'matrix('+matrix.a*cat.touchjs.scaleVal+',0,0,'+matrix.d*cat.touchjs.scaleVal+','+(-1)*matrix.e*cat.touchjs.scaleVal+','+(-1)*matrix.f*cat.touchjs.scaleVal+') rotate(' + cat.touchjs.rotateVal + 'deg)';
                $targetObj.css("transform", transformStyle).css("-webkit-transform", transformStyle);
                callback(cat.touchjs.scaleVal);
            }
                
            
        });

        touch.on($targetObj, 'pinchend', function (ev) {
            if (cat.touchjs.curStatus == 2) {
                return;
            }
            if (currentScale<4 && currentScale>cat_scaleVal){
                initialScale = currentScale;
                cat.touchjs.left = (-1)*matrix.e*currentScale;
                cat.touchjs.top = (-1)*matrix.f*cat.touchjs.scaleVal;
                cat.touchjs.scaleVal = currentScale;
                callback(cat.touchjs.scaleVal);
            }
        });
    },
    onclick:function($targetObj, callback){
        callback($targetObj);
    }
};