<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 添加分类标签</title>
<?php $this -> load -> view('common/top'); ?>
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
		<h1>添加分类标签</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('config/tag');?>">标签管理</a></li>
			<li class="active">添加分类标签</li>
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
						<form id="tagCategoryForm" class="form-horizontal" method="post" action="">
							<div class="form-group">
								<label for="catname" class="col-sm-2 control-label">标签分类名：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="catname" id="catname" placeholder="输入标签分类名" value="" />
								</div>
							</div>

							<div class="form-group">
								<label for="tags" class="col-sm-2 control-label">标签：</label>
								<div class="col-sm-10">
									<textarea type="text" class="form-control" name="tags" id="tags" placeholder="输入标签，标签之间用中文分号（；）分开" rows="6"></textarea>
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
		/**添加、编辑管理员验证**/
		$('#tagCategoryForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				catname: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '标签分类名不能为空'
						}
					}
				}
			}
		});
	})
</script>
</body>
</html>