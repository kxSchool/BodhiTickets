<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 座位图管理</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.css" />
<script src="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>

<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap-fileinput/css/fileinput.min.css" />
<script src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput_locale_zh.js" charset="UTF-8"></script>
<!-- 配置文件 -->
	<script type="text/javascript" src="<?php echo STATIC_PATH; ?>ueditor/ueditor.config.js"></script>
	<!-- 编辑器源码文件 -->
	<script type="text/javascript" src="<?php echo STATIC_PATH; ?>ueditor/ueditor.all.js"></script>
    	<style>
		table {
			font-family: '微软雅黑', '宋体', '黑体';
		}

		td {
			background-color: rgb(249,252,255);
			height: 24px;
			width: 1500px;
		}

		td:hover {
			background-color: rgb(168,213,252);
			cursor: default;
		}

		.inputselect-1{
			position: relative;
		}
		.inputselect-1 #inputselect{
			position: absolute;
			top:34px;
			left:15px;
			right:15px;
			background: #fff;
			border:1px solid #ddd;
			z-index:5;
		}
		.inputselect-1 #inputselect td{
			padding-left: 12px;
		}
	</style>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<?php $this -> load -> view('common/header'); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php $this -> load -> view('common/left'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>座位图管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>">表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?show_id=<?php echo $show_id;?>">座位图管理</a></li>
			<li class="active">创建座位图</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="showForm" class="form-horizontal" method="post" action="<?php echo site_url('map/map_save')?>?show_id=<?php echo $mapInfo['show_id'];?>">
							<div class="form-group">
								<label for="map_name" class="col-sm-2 control-label">座位图名称：</label>
								<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $mapInfo['id'];?>" />
								<div class="col-sm-10 inputselect-1">
									<input type="text" class="form-control" name="map_name" id="map_name" placeholder="请输入座位图名称" value="<?php echo $mapInfo['map_name'];?>"  autocomplete="off"/>
									<div id="inputselect" >
										<table cellpadding='2' cellspacing='0'>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
                            <div class="form-group">
								<label for="map_name" class="col-sm-2 control-label">初始放缩比例：</label>
								<div class="col-sm-10 inputselect-1">
									<input type="text" class="form-control" name="cat_scaleVal" id="cat_scaleVal" placeholder="请输入座位图初始放缩比例" value="<?php echo $mapInfo['cat_scaleVal'];?>"  autocomplete="off"/>
								</div>
							</div>
                            <div class="form-group">
								<label for="map_name" class="col-sm-2 control-label">初始左移值：</label>
								<div class="col-sm-10 inputselect-1">
									<input type="text" class="form-control" name="cat_left" id="cat_left" placeholder="请输入座位图初始左移值" value="<?php echo $mapInfo['cat_left'];?>"  autocomplete="off"/>
								</div>
							</div>
                            <div class="form-group">
								<label for="map_name" class="col-sm-2 control-label">初始上移值：</label>
								<div class="col-sm-10 inputselect-1">
									<input type="text" class="form-control" name="cat_top" id="cat_top" placeholder="请输入座位图初始上移值" value="<?php echo $mapInfo['cat_top'];?>"  autocomplete="off"/>
								</div>
							</div>
							<!--图片品牌-->
							<div class="form-group">
								<label for="c" class="col-sm-2 control-label">场馆地图样式：</label>
								<div class="col-sm-10">
									<textarea name="style"  class="form-control" id="style"  placeholder="请输入该场馆地图样式描述"><?php echo $mapInfo['style'];?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="c" class="col-sm-2 control-label">场馆区域图：</label>
								<div class="col-sm-10">
									<textarea name="area"  class="form-control" id="area"  placeholder="请输入该场馆区域地图的相关描述"><?php echo $mapInfo['area'];?></textarea>
								</div>
							</div>
                            <div class="form-group">
								<label for="c" class="col-sm-2 control-label">场次价格图：</label>
								<div class="col-sm-10">
									<textarea name="price"  class="form-control" id="price"  placeholder="请输入该场次价格区图的相关描述"><?php echo $mapInfo['price'];?></textarea>
								</div>
							</div>    
                             <div class="form-group">
								<label for="c" class="col-sm-2 control-label">场馆座位图：</label>
								<div class="col-sm-10">
									<textarea name="seats"  class="form-control" id="seats"  placeholder="请输入该场馆座位图的相关描述"><?php echo $mapInfo['seats'];?></textarea>
								</div>
							</div> 
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="backgroud" class="col-sm-2 control-label">场馆背景图：</label>
								<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $mapInfo['id'];?>" />
								<div class="col-sm-10">
									<input id="background" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="background_name" type="hidden" name="background_name" value="<?php echo $mapInfo['background'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="mini" class="col-sm-2 control-label">场馆缩略图：</label>
								<div class="col-sm-10">
									<input id="mini" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="mini_name" type="hidden" name="mini_name" value="<?php echo $mapInfo['mini'];?>" />
								</div>
							</div>
							<div class="col-sm-offset-2">
								<button type="submit" class="btn btn-success">保存</button>
							</div>
						</form>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
	$(function(){
		/**添加、编辑品牌验证**/
		$('#showForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				name: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '品牌名不能为空'
						}
					}
				}
			}
		});
		// 开始时间
		$("#start_time").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		// 结束时间
		$("#end_time").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		//改变品牌类型时
		$("#change_ad_code").on('change',function(){
			var optionValue = $(this).val();
			if(optionValue == 0){
				$("#ad_text_code").hide();
				$('#ad_image_code').show();
				$('#ad_image_link').show();
			}else{
				$('#ad_image_code').hide();
				$('#ad_image_link').hide();
				$("#ad_text_code").show();
			}
		})
			//上传图片
		$("#mini").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=map_mini" ,//上传文件路径
			<?php if(isset($logoimg) && !empty($logoimg)):?>
			initialPreview: [
				'<img src="<?php echo $logoimgurl;?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#mini").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#mini_name").val(realpath);
			}
		});
        $("#mini").on("fileclear", function (event, data, previewId, index) {
            $("#mini_name").val('');
		});
        //上传图片
		$("#background").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=map_background" ,//上传文件路径
			<?php if(isset($logoimg) && !empty($logoimg)):?>
			initialPreview: [
				'<img src="<?php echo $logoimgurl;?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#background").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#background_name").val(realpath);
			}
		});
        $("#background").on("fileclear", function (event, data, previewId, index) {
            $("#background_name").val('');
		});


        $("#showname").keyup(function(){
            $('tbody').html("");
            var name = $("#name").val();
            if(name.length != 0){
                $.ajax({
                    url : "<?php echo site_url('show/getShowLikeName');?>",
                    type : 'post',
                    dataType : 'json',
                    data : {'show':name},
                    success:function(data){
                        if(data.info == 1){
                            var tds = "";
                            for(var i=0,len=data.shows.length;i<len;i++){
                                tds += "<tr><td>"+data.shows[i]+"</td></tr>";
                            }
                            $('tbody').html(tds);
                        }else{
                            layer.alert(data.tip, {icon: 5});
                        }
                    }
                });
            }
        });
	});

//点击选项自动填充到输入框
//	document.querySelector('tbody').onclick = function(e) {
//		var wd = e.target.innerHTML;
//        document.getElementById("name").value= wd ;
//        document.getElementsByTagName("tbody")[0].innerHTML = "";
//	};

</script>
</body>
</html>