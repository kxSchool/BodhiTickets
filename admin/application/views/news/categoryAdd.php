<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 栏目管理</title>
<?php $this -> load -> view('common/top'); ?>
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
		<h1>栏目管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('news/category');?>">栏目管理</a></li>
			<li class="active">创建栏目</li>
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
						<form id="categoryForm" class="form-horizontal" method="post" action="<?php echo site_url('news/saveCategory');?>">
							<div class="form-group">
								<label for="parentid" class="col-sm-2 control-label">上级栏目：</label>
								<div class="col-sm-10">
									<select class="form-control" name="parentid" id="parentid">
										<option value="0">==创建一级栏目==</option>
										<?php foreach($categorys as $v):?>
										<?php
										$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
										?>
										<option value="<?php echo $v['catid'];?>"><?php echo $nbsp.$v['spacer'].$v['catname'];?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="catname" class="col-sm-2 control-label">栏目名：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="catname" id="catname" placeholder="输入栏目名" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">栏目类型：</label>
								<div class="col-sm-10">
									<input type="radio" name="type" value="0" checked="true" /> 普通分类
									<input type="radio" name="type" value="1" /> 单网页
								</div>
							</div>
							<div class="form-group">
								<label for="keywords" class="col-sm-2 control-label">栏目关键词：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="keywords" id="keywords" placeholder="输入栏目关键词" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">栏目描述：</label>
								<div class="col-sm-10">
									<textarea type="text" class="form-control" name="description" id="description" placeholder="输入栏目描述" ></textarea>
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
		/**添加、编辑栏目验证**/
		$('#categoryForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				parentid: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '上级栏目分类未选择'
						}
					}
				},
				catname: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '栏目名不能为空'
						}
					}
				}
			}
		});
	})
</script>
</body>
</html>