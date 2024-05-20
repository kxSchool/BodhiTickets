<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 品牌管理</title>
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
		<h1>表演管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>">表演管理</a></li>
			<li class="active">创建表演</li>
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
						<form id="showForm" class="form-horizontal" method="post" action="<?php echo site_url('show/show_save')?>">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">表演名称：</label>
								<div class="col-sm-10 inputselect-1">
									<input type="text" class="form-control" name="name" id="name" placeholder="请输入品牌名称" value=""  autocomplete="off"/>
									<div id="inputselect" >
										<table cellpadding='2' cellspacing='0'>
											<tbody></tbody>
										</table>
									</div>
								</div>
							</div>
							<!--图片品牌-->
							<div class="form-group" id="ad_image_code">
								<label for="show_logo" class="col-sm-2 control-label">海报图片：</label>
								<div class="col-sm-10">
									<input id="show_logo" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="show_img_name" type="hidden" name="show_img_name" value="" />
								</div>
							</div>
							<div class="form-group">
									<label for="content" class="col-sm-2 control-label">内容：</label>
									<div class="col-sm-10">
										<!-- 加载编辑器的容器 -->
										<script id="desc" name="desc" type="text/plain"></script>
										<!-- 实例化编辑器 -->
										<script type="text/javascript">
											var ue = UE.getEditor('desc',{
												initialFrameHeight:480
											});
										</script>
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
		$("#show_logo").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=show" ,//上传文件路径
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#show_logo").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#show_img_name").val(realpath);
			}
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