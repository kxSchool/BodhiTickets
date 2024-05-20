<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>泡米票仓管理系统 | 邮箱配置</title>
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
			<h1>邮箱配置</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li class="active">邮箱配置</li>
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
							<form class="form-horizontal" method="post" action="<?php echo site_url('config/mail');?>">
								<div class="form-group">
									<label for="protocol" class="col-sm-2 control-label">邮件发送协议：</label>
									<div class="col-sm-10">
										<input type="radio" name="protocol" value="mail" <?php if( isset($mailInfo['protocol']) && $mailInfo['protocol'] == 'mail'):?>checked<?php endif;?> /> mail
										<input type="radio" name="protocol" value="sendmail" <?php if( isset($mailInfo['protocol']) && $mailInfo['protocol'] == 'sendmail'):?>checked<?php endif;?> /> sendmail
										<input type="radio" name="protocol" value="smtp" <?php if( isset($mailInfo['protocol']) && $mailInfo['protocol'] == 'smtp'):?>checked<?php endif;?> /> smtp
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_host" class="col-sm-2 control-label">SMTP 服务器地址：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="smtp_host" id="smtp_host" placeholder="输入SMTP 服务器地址" value="<?php if(isset($mailInfo['smtp_host'])):?><?php echo $mailInfo['smtp_host'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_user" class="col-sm-2 control-label">SMTP 用户名：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="smtp_user" id="smtp_user" placeholder="输入SMTP 用户名" value="<?php if(isset($mailInfo['smtp_user'])):?><?php echo $mailInfo['smtp_user'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_pass" class="col-sm-2 control-label">SMTP 密码：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="smtp_pass" id="smtp_pass" placeholder="输入SMTP 密码" value="<?php if(isset($mailInfo['smtp_pass'])):?><?php echo $mailInfo['smtp_pass'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_port" class="col-sm-2 control-label">SMTP 端口：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="smtp_port" id="smtp_port" placeholder="输入SMTP 端口" value="<?php if(isset($mailInfo['smtp_port'])):?><?php echo $mailInfo['smtp_port'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_timeout" class="col-sm-2 control-label">SMTP 超时时间（单位：秒）：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="smtp_timeout" id="smtp_timeout" placeholder="输入SMTP 超时时间（单位：秒）" value="<?php if(isset($mailInfo['smtp_timeout'])):?><?php echo $mailInfo['smtp_timeout'];?><?php endif;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_keepalive" class="col-sm-2 control-label">SMTP 持久连接：</label>
									<div class="col-sm-10">
										<input type="radio" name="smtp_keepalive" value="false" <?php if( isset($mailInfo['smtp_keepalive']) && $mailInfo['smtp_keepalive'] == 'false'):?>checked<?php endif;?> /> 否
										<input type="radio" name="smtp_keepalive" value="true" <?php if( isset($mailInfo['smtp_keepalive']) && $mailInfo['smtp_keepalive'] == 'true'):?>checked<?php endif;?> /> 是
									</div>
								</div>
								<div class="form-group">
									<label for="smtp_crypto" class="col-sm-2 control-label">SMTP 加密方式：</label>
									<div class="col-sm-10">
										<input type="radio" name="smtp_crypto" value="tls" <?php if( isset($mailInfo['smtp_crypto']) && $mailInfo['smtp_crypto'] == 'tls'):?>checked<?php endif;?> /> tls
										<input type="radio" name="smtp_crypto" value="ssl" <?php if( isset($mailInfo['smtp_crypto']) && $mailInfo['smtp_crypto'] == 'ssl'):?>checked<?php endif;?> /> ssl
									</div>
								</div>
								<div class="form-group">
									<label for="validate" class="col-sm-2 control-label">验证邮件地址：</label>
									<div class="col-sm-10">
										<input type="radio" name="validate" value="false" <?php if( isset($mailInfo['validate']) && $mailInfo['validate'] == 'false'):?>checked<?php endif;?> /> 否
										<input type="radio" name="validate" value="true" <?php if( isset($mailInfo['validate']) && $mailInfo['validate'] == 'true'):?>checked<?php endif;?> /> 是
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