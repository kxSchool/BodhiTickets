
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>泡米票仓管理系统 | 表演管理</title>
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
			<li class="active">编辑表演</li>
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
						<form id="showForm" class="form-horizontal" method="post" action="<?php echo site_url('show/show_save');?>">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">表演名称：</label>
								<div class="col-sm-10">
									<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $id;?>" />
									<input type="text" class="form-control" name="name" id="name" placeholder="表演名" value="<?php echo $name;?>" />
								</div>
							</div>
							<!--图片品牌-->
							<div class="form-group" id="ad_image_code" style="display:block;">
								<label for="show_logo" class="col-sm-2 control-label">表演海报：</label>
								<div class="col-sm-10">
									<input id="show_logo" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="show_img_name" type="hidden" name="show_img_name" value="<?php echo $logoimg;?>" />
								</div>
							</div>
                            <div class="form-group">
									<label for="startdate" class="col-sm-2 control-label">发布日期：</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="startdate" id="startdate" placeholder="开始日期不填写，则为当前时间" value="<?php echo date('Y-m-d H:i:s',$startdate);?>" />
									</div>
                                    <label for="enddate" class="col-sm-2 control-label">结束日期：</label>
                                    <div class="col-sm-4">
										<input type="text" class="form-control" name="enddate" id="enddate" placeholder="结束日期不填写，则为当前时间" value="<?php echo date('Y-m-d H:i:s',$enddate);?>" />
									</div>
								</div>
                            <div class="form-group">
									<label for="content" class="col-sm-2 control-label">内容：</label>
									<div class="col-sm-10">
										<!-- 加载编辑器的容器 -->
										<script id="desc" name="desc" type="text/plain"><?php echo $desc;?></script>
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
		//上传图片
		$("#show_logo").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=show" ,//上传文件路径
			<?php if(isset($logoimg) && !empty($logoimg)):?>
			initialPreview: [
				'<img src="<?php echo $logoimgurl;?>" class="file-preview-image">'
			],
			<?php endif;?>
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
        $("#show_logo").on("fileclear", function (event, data, previewId, index) {
            $("#show_img_name").val('');
		});
        // 开始日期
		$("#startdate").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
        // 结束日期
		$("#enddate").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
	})
</script>
</body>
</html>