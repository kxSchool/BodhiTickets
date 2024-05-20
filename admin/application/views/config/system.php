<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 基本设置</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap-fileinput/css/fileinput.min.css" />
<script src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput_locale_zh.js" charset="UTF-8"></script>
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
		<h1>基本设置</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">基本设置</li>
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
						<form class="form-horizontal" method="post" action="<?php echo site_url('config/system');?>">
							<div class="form-group" id="ad_image_code">
								<label for="log" class="col-sm-2 control-label">网站logo：</label>
								<div class="col-sm-10">
									<input id="log_upload" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="log" type="hidden" name="log" value="<?php if(isset($websiteInfo['log'])):?><?php echo $websiteInfo['log'];?><?php endif;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">网站标题：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" id="title" placeholder="输入网站标题" value="<?php if(isset($websiteInfo['title'])):?><?php echo $websiteInfo['title'];?><?php endif;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="keywords" class="col-sm-2 control-label">网站关键词：</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="keywords" id="keywords" placeholder="输入网站关键词"><?php if(isset($websiteInfo['keywords'])):?><?php echo $websiteInfo['keywords'];?><?php endif;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">网站描述：</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="description" id="description" placeholder="输入网站描述"><?php if(isset($websiteInfo['description'])):?><?php echo $websiteInfo['description'];?><?php endif;?></textarea>
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
		//上传图片
		$("#log_upload").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=logo" ,//上传文件路径
			<?php if(isset($websiteInfo['log_show'])):?>
			initialPreview: [
				'<img src="<?php echo $websiteInfo['log_show'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"],
		});
		$("#log_upload").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#log").val(realpath);
			}
		});
	})
</script>
</body>
</html>