<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>泡米票仓管理系统 | 短信平台配置</title>
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
			<h1>短信平台配置</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li class="active">短信平台配置</li>
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
							<form class="form-horizontal" method="post" action="<?php echo site_url('config/sms');?>">
								<div class="form-group">
									<label for="userid" class="col-sm-2 control-label">平台用户ID：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="userid" id="userid" placeholder="输入短信平台用户ID" value="<?php if(isset($smsInfo['userid'])):?><?php echo $smsInfo['userid'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="account" class="col-sm-2 control-label">平台账号：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="account" id="account" placeholder="输入平台注册账号" value="<?php if(isset($smsInfo['account'])):?><?php echo $smsInfo['account'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">账号密码：</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" name="password" id="password" placeholder="输入账号密码" value="<?php if(isset($smsInfo['password'])):?><?php echo $smsInfo['password'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="sign" class="col-sm-2 control-label">短信签名：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="sign" id="sign" placeholder="输入短信签名" value="<?php if(isset($smsInfo['sign'])):?><?php echo $smsInfo['sign'];?><?php endif;?>" />
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
</body>
</html>