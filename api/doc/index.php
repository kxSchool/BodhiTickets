<?php 
/*良子 2016-12-14*/
header('Content-Type: text/html; charset=utf-8');
session_start();

if (strtoupper($_SERVER['REQUEST_METHOD'])=='POST') {
	if($_POST['username']=='admin' && $_POST['password']=='123456') {
		$_SESSION['login'] = 1;
	}
} 

$isLogin = isset($_SESSION['login']) && !empty($_SESSION['login']) ? 1 : 0;


require_once __DIR__ . '/Parser.php';
$dir    = './docs';
$files = getDir($dir);
//var_dump($files);

$left = putFiles($files);

$path = isset($_GET['filename']) && !empty($_GET['filename']) ? $_GET['filename']:'';

$path = urldecode(base64_decode($path));


if (!empty($path) && is_file($path)) {
	$text = file_get_contents($path);
	$parser = new \HyperDown\Parser();
	$markdown = $parser->makeHtml($text);
} else {
	$markdown = '<h1>欢迎查阅合作商开发文档</h1>';
}




function getDir ($dir) {
	$files = scandir($dir);
	$data = [];
	foreach ($files as $key => $val ) {
		if ($val != '.' && $val!='..' && $val!=='.svn') {
			if (is_dir($dir.'/'.$val)) {
				$encode = mb_detect_encoding($val,array('ASCII','UTF-8','GB2312','GBK','BIG5'));
				$data[$key]['name']= mb_convert_encoding($val, "utf-8", $encode);
				$data[$key]['type']='d';
				$data[$key]['child']=getDir($dir.'/'.$val);
			} else {
				$encode = mb_detect_encoding($val,array('ASCII','UTF-8','GB2312','GBK','BIG5'));
				$data[$key]['name']= mb_convert_encoding($val, "utf-8", $encode);
				$data[$key]['type']='f';
				$data[$key]['link']=base64_encode(urlencode($dir.'/'.$val));
			}
		} 
	}
	return $data;
}



function putFiles($files, $i=1) {
	$text = '';
	foreach ($files as $key => $val) {
		$margin = $i * 10;					
		if($val['type']=='f'){ 
			$text .= '<h4 data-level="'.$i.'" style="margin-left:'.$margin.'px;"><a href="./index.php?filename='.$val['link'].'"> '.$val['name'].'</a></h4>';
		} else {
			$text .=  '<h4 data-level="'.$i.'" class="dir -" style="margin-left:'.$margin.'px; cursor:pointer;">'.$val['name'].'</h4>';
		}
		if(isset($val['child'])) {
			$text .= putFiles($val['child'],  $i+1 );
		}
	}
	return $text;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>API文档</title>
    <meta name="viewport" content="width=device-width,
                                     initial-scale=1.0, 
                                     maximum-scale=1.0, 
                                     user-scalable=no">
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="./js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="./js/html5shiv.min.js"></script>
    <script src="./js/respond.min.js"></script>
    <![endif]-->
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
	<script>
	   $(function(){
	   	   $("table").addClass("table table-bordered table-hover");
  		   $("#main").css({'min-height': $(window).height()});
		   $(".flatbtn-blu").click(function(){
	       	   $("#theForm").submit();
		   });

		   $(".dir").click(function(){
		   	   var _this = $(this);
			   $(this).nextUntil(".dir[data-level="+$(this).attr('data-level')+"]").each(function(){
			   	   if ($(this).attr('data-level')<=_this.attr('data-level')) {
					   return false;
				   }
				   if (_this.hasClass("-")) {
					   $(this).removeClass("-").addClass("+");
				       $(this).removeClass("show").addClass("hidden");
				   } else {
					   $(this).removeClass("+").addClass("-");
				       $(this).removeClass("hidden").addClass("show");
			       }
			   });
			   if(_this.hasClass("-")) {
				   $(this).removeClass("-").addClass("+");
			   } else {
				   $(this).removeClass("+").addClass("-");
			   }
		   });
	   });
    </script>
	<style>
		.hidden{display:none;}
		.show{display:block;}
	    #main {
		   overflow: hidden;
		   width: 100%;
		}
		#left {
			background: #fafafa;
			width: 20%;
			z-index: 2;
			
			float: left;
			margin-bottom: -10000px;
			padding-bottom: 10000px;
			border-right: 10px solid #3b4461;
		}
		#right {
			position: relative;
			left: 0px;
			background: #fafafa;
			width: 80%;
			float: right;
			padding: 5px 5px 5px 20px;
			margin-bottom: -10000px;
			padding-bottom: 10000px;
		}

	</style>
</head>
<body>

<div id="loginmodal" style="display:<?php if($isLogin){ echo 'none'; }else{echo 'block';}  ?>" >
        <div class="modal-header">
            <h3>接口文档</h3>
        </div>
        <div class="modal-body">
		    <form action="" method="post" id="theForm">
            <table>
                <tr>
                    <td width="65%">
                        <label for="username">用户名:</label>
                        <input type="text" name="username" value="" id="username" tabindex="1"/>
                        <label for="password">密码:</label>
                        <input type="password" name="password" value="" id="password" tabindex="2" />
                        <button class="flatbtn-blu"  tabindex="3">登录</button>
                    </td>
                </tr>
            </table>
            </form>    
        </div>
        
    </div>

<div id="main" style="display:<?php if($isLogin){ echo 'block'; }else{echo 'none';}  ?>" >
    <div id="left">
        <h3><a href="/doc">接口列表</a></h3>
		<?php echo $left; ?>
	    
    </div>
    <div id="right">
       <?php echo $markdown; ?>
	</div>
	<div style="clear:both"></div>
</div>


</body>

</html>