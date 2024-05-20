<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 分类管理</title>
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
		<h1>分类管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('TicketsCategory/manage');?>">分类管理</a></li>
			<li class="active">修改分类</li>
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
						<form id="cateForm" class="form-horizontal" method="post" action="<?php echo site_url('TicketsCategory/category_save');?>">
							<div class="form-group">
								<label for="parentid" class="col-sm-2 control-label">上级分类：</label>
								<div class="col-sm-10">
									<select class="form-control" name="parentid" id="parentid">
										<option value="0">==创建一级分类==</option>
										<?php if(isset($showcategory)):?>
										<?php foreach($showcategory as $v):?>
										<?php
												$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
										?>
											<option value="<?php echo $v['id'];?>"><?php echo $nbsp;?><?php echo $v['spacer'].$v['cat_name'];?></option>
										<?php endforeach;?>
										<?php endif;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">分类名：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="输入分类名" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="c" class="col-sm-2 control-label">权重(排序)：</label>
								<div class="col-sm-10">
									<textarea name="desc"  class="form-control" id="desc"  placeholder="请输入该分类的相关描述"></textarea>
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
		/**添加、编辑权限分类验证**/
		$('#cateForm').bootstrapValidator({
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
							message: '上级分类未选择'
						}
					}
				},
				categoryname: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '分类名不能为空'
						}
					}
				}
			}
		});
	})
</script>
</body>
</html>