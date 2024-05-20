<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 添加支付方式</title>
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
		<h1>添加支付方式</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('config/payment');?>">支付方式</a></li>
			<li class="active">添加支付方式</li>
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
						<form id="paymentForm" class="form-horizontal" method="post" action="<?php echo site_url('config/savePayment')?>">
							<div class="form-group">
								<label for="pay_name" class="col-sm-2 control-label">支付方式：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="pay_name" id="pay_name" placeholder="支付方式" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="config" class="col-sm-2 control-label">支付配置：</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="config" id="config" placeholder="每个配置项换行隔开" rows="4"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="pay_fee" class="col-sm-2 control-label">每单费用：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="pay_fee" id="pay_fee" placeholder="每单成交费用，支付者承担的百分比费用" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="pay_desc" class="col-sm-2 control-label">支付描述：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="pay_desc" id="pay_desc" placeholder="输入支付方式描述" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="author" class="col-sm-2 control-label">开发者：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="author" id="author" placeholder="开发者" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="sort" class="col-sm-2 control-label">权重：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="sort" id="sort" placeholder="权重，用于排序，值越大，权重越大" value="0" />
								</div>
							</div>

							<div class="form-group">
								<label for="client_type" class="col-sm-2 control-label">客户端支付类型：</label>
								<div class="col-sm-10">
									<select class="form-control" name="client_type" id="client_type">
										<option value="0">PC端支付</option>
										<option value="1">APP端支付</option>
										<option value="2">H5页面支付</option>
									</select>
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
		/**添加、编辑支付方式验证**/
		$('#paymentForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				pay_name: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '支付方式名不能为空'
						}
					}
				}
			}
		});
	})
</script>
</body>
</html>