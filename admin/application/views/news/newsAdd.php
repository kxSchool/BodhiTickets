<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 内容管理</title>
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

<script>
	$(function(){
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%'
		});
	})
</script>
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
		<h1>内容管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('news/index');?>">内容管理</a></li>
			<li class="active">创建内容</li>
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
						<form id="newsForm" class="form-horizontal" method="post" action="<?php echo site_url('news/saveNews');?>">
							<div class="form-group">
								<label for="catid" class="col-sm-2 control-label">所属栏目：</label>
								<div class="col-sm-10">
									<select class="form-control" name="catid" id="catid">
										<?php foreach($categorys as $v):?>
											<?php
											$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
											?>
											<option value="<?php echo $v['catid'];?>" <?php if(isset($v['childrenCount'])):?>disabled="disabled"<?php endif;?>><?php echo $nbsp.$v['spacer'].$v['catname'];?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">文章：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" id="title" placeholder="文章名" value="" />
								</div>
							</div>
							<div class="form-group" id="ad_image_code">
								<label for="thumb_input" class="col-sm-2 control-label">缩略图：</label>
								<div class="col-sm-10">
									<input id="thumb_input" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="thumb" type="hidden" name="thumb" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="content" class="col-sm-2 control-label">内容：</label>
								<div class="col-sm-10">
									<!-- 加载编辑器的容器 -->
									<script id="content" name="content" type="text/plain"></script>
									<!-- 实例化编辑器 -->
									<script type="text/javascript">
										var ue = UE.getEditor('content',{
											initialFrameHeight:480
										});
									</script>
								</div>
							</div>
							<div class="form-group">
								<label for="keywords" class="col-sm-2 control-label">关键词：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="keywords" id="keywords" placeholder="请输入文章关键词，用英文逗号分开" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">文章描述：</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="description" id="description" placeholder="输入文章描述"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="publishtime" class="col-sm-2 control-label">发布日期：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="publishtime" id="publishtime" placeholder="发布日期不填写，则为当前时间" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="views" class="col-sm-2 control-label">访问量：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="views" id="views" placeholder="不填写默认为0" value="0" />
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">外部链接：</label>
								<div class="col-sm-10">
									<input type="radio" name="islink" value="0" checked /> 否
									<input type="radio" name="islink" value="1" /> 是
								</div>
							</div>
							<div class="form-group" id="urlDiv" style="display:none;">
								<label for="url" class="col-sm-2 control-label">外部链接URL：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="url" id="url" placeholder="请输入合法的URL" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">文章状态：</label>
								<div class="col-sm-10">
									<input type="radio" name="status" value="1" checked /> 发布
									<input type="radio" name="status" value="2" /> 待发布
									<input type="radio" name="status" value="0" /> 草稿箱
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
		/**添加、编辑文章验证**/
		$('#newsForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				catid: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '文章所属栏目未选择'
						}
					}
				},
				title: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '文章标题不能为空'
						}
					}
				},
				url: {
					group: '.col-sm-10',
					validators: {
						uri: {
							allowLocal: true,
							message: '请输入合法的URl'
						}
					}
				}
			}
		});
		// 发布日期
		$("#publishtime").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		//当选择外部链接radio的时候
		$("input[name='islink']").on('ifChecked', function(event) {
			var islinkValue = $("input[name='islink']:checked").val();
			if(islinkValue == 0){
				$("#urlDiv").hide();
			}else if(islinkValue == 1){
				$("#urlDiv").show();
			}
		});
		//上传缩略图
		$("#thumb_input").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=thumb" ,//上传文件路径
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#thumb_input").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
				$("#thumb").val(realpath);
			}
		});
	})
</script>
</body>
</html>