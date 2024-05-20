<?php
//print_r(date('Y-m-d H:i:s',$eventInfo['show_date']));exit;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 修改全景</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.css" />
<script src="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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
		<h1>修改全景</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>"><i class="fa fa-home" ></i>表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?show_id=<?php echo $mapInfo['show_id'];?>">座位图管理</a></li>
			<li><a href="<?php echo site_url('section/manage');?>?map_id=<?php echo $sectionInfo['map_id'];?>">区域管理</a></li>
			<li class="active">修改全景</li>
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
						<form id="cateForm" class="form-horizontal" method="post" action="<?php echo site_url('panorama/panorama_save');?>?section_id=<?php echo $sectionInfo['id'];?>&id=<?php echo $panoramaInfo['id'];?>">
                            <input id="id" type="hidden" name="id" value="<?php echo $id;?>" />
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="background" class="col-sm-2 control-label">全景缩略图：</label>
								<div class="col-sm-10">
									<input id="mini" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="mini_name" type="hidden" name="mini_name" value="<?php echo $panoramaInfo['mini'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="front" class="col-sm-2 control-label">全景前方图：</label>
								<div class="col-sm-10">
									<input id="front" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="front_name" type="hidden" name="front_name" value="<?php echo $panoramaInfo['front'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="back" class="col-sm-2 control-label">全景后方图：</label>
								<div class="col-sm-10">
									<input id="back" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="back_name" type="hidden" name="back_name" value="<?php echo $panoramaInfo['back'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="left" class="col-sm-2 control-label">全景左方图：</label>
								<div class="col-sm-10">
									<input id="left" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="left_name" type="hidden" name="left_name" value="<?php echo $panoramaInfo['left'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="right" class="col-sm-2 control-label">全景右方图：</label>
								<div class="col-sm-10">
									<input id="right" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="right_name" type="hidden" name="right_name" value="<?php echo $panoramaInfo['right'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="top" class="col-sm-2 control-label">全景上方图：</label>
								<div class="col-sm-10">
									<input id="top" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="top_name" type="hidden" name="top_name" value="<?php echo $panoramaInfo['top'];?>" />
								</div>
							</div>
                            <div class="form-group" id="ad_image_code" style="display:block;">
								<label for="bottom" class="col-sm-2 control-label">全景下方图：</label>
								<div class="col-sm-10">
									<input id="bottom" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="bottom_name" type="hidden" name="bottom_name" value="<?php echo $panoramaInfo['bottom'];?>" />
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
		$("#mini").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['mini_url']) && !empty($panoramaInfo['mini_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['mini_url'];?>" class="file-preview-image">'
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
		$("#front").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['front_url']) && !empty($panoramaInfo['front_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['front_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#front").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#front_name").val(realpath);
			}
		});
        $("#front").on("fileclear", function (event, data, previewId, index) {
            $("#front_name").val('');
		});
        
        
        
        //上传图片
		$("#back").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['back_url']) && !empty($panoramaInfo['back_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['back_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#back").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#back_name").val(realpath);
			}
		});
        $("#back").on("fileclear", function (event, data, previewId, index) {
            $("#back_name").val('');
		});
        
        
        
        
        //上传图片
		$("#left").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['left_url']) && !empty($panoramaInfo['left_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['left_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#left").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#left_name").val(realpath);
			}
		});
        $("#left").on("fileclear", function (event, data, previewId, index) {
            $("#left_name").val('');
		});
        
        
        //上传图片
		$("#right").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['right_url']) && !empty($panoramaInfo['right_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['right_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#right").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#right_name").val(realpath);
			}
		});
        $("#right").on("fileclear", function (event, data, previewId, index) {
            $("#right_name").val('');
		});
        
        
        //上传图片
		$("#top").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['top_url']) && !empty($panoramaInfo['top_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['top_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#top").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#top_name").val(realpath);
			}
		});
        $("#top").on("fileclear", function (event, data, previewId, index) {
            $("#top_name").val('');
		});
        
        
        //上传图片
		$("#bottom").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=panorama&section_id=<?php echo  $sectionInfo['id'];?>" ,//上传文件路径
			<?php if(isset($panoramaInfo['bottom_url']) && !empty($panoramaInfo['bottom_url'])):?>
			initialPreview: [
				'<img src="<?php echo $panoramaInfo['bottom_url'];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#bottom").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#bottom_name").val(realpath);
			}
		});
        $("#bottom").on("fileclear", function (event, data, previewId, index) {
            $("#bottom_name").val('');
		});
	})
</script>
</body>
</html>