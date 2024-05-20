<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/360.js"></script>
<title>C区</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<meta name="Keywords" content="C区" />
<meta name="Description" content="C区" />
<meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type"/>
<meta content="no-cache,must-revalidate" http-equiv="Cache-Control"/>
<meta content="no-cache" http-equiv="pragma"/>
<meta content="0" http-equiv="expires"/>
<meta content="telephone=no, address=no" name="format-detection"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<style>
body, div, h1, h2, h3, span, p {
    font-family: Verdana,Arial,Helvetica,sans-serif;
    color: #000000; 
}
/* fullscreen */
html {
    height:100%;
}
body {
    height:100%;
    margin: 0px;
    overflow:hidden;
}
</style>
</head>
<body onselectstart="return true;" ondragstart="return false;">
<div id="container" style="width:100%;height:100%;">
	This content requires HTML5/CSS3, WebGL, or Adobe Flash Player Version 9 or higher.
</div>
<script type="text/javascript">
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
	if (ggHasHtml5Css3D() || ggHasWebGL()) {
		pano=new pano2vrPlayer("container");
		pano.readConfigUrl("<?php echo site_url('index/xml');?>?id=<?php echo $id; ?>");
	} else{
		alert("not support 360view");
	}
</script>
<noscript>
<p>
<b>Please enable Javascript!</b>
</p>
</noscript>
</body>
</html>