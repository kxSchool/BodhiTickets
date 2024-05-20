<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 商铺审核</title>
<?php $this -> load -> view('common/top'); ?>
	<script>
		$(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
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
		<h1>商铺入驻</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">商铺入驻</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="pull-right">
							<form id="searchFeedbackForm" class="form-inline" method="post" action="<?php echo site_url('shopreview/index');?>">
								<div class="form-group">
									<select class="form-control" name="authority" id="authority">
										<option value="" >==请选择==</option>
										<option value="0" <?php if(isset($authority) && $authority == 0):?>selected="selected"<?php endif;?>>==未认证==</option>
										<option value="1" <?php if(isset($authority) && $authority == 1):?>selected="selected"<?php endif;?>>==认证失败==</option>
										<option value="2" <?php if(isset($authority) && $authority == 2):?>selected="selected"<?php endif;?>>==已认证==</option>
									</select>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info" name="dosearch" value="1">搜索</button>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>

									<th>会员ID</th>
									<th>用户名 </th>
									<th>状态 </th>
									<th>申请时间 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['userid'];?></td>
									<td><?php echo $v['username'];?></td>
									<td>
										<?php if($v['authority'] == 0):?>
											未认证
										<?php elseif($v['authority'] == 1):?>
											认证失败
										<?php elseif($v['authority'] == 2):?>
											已认证
										<?php endif;?>
									</td>
									<td><?php echo date('Y-m-d',$v['add_time']);?></td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('shopreview/detail').'?userid='.$v['userid'];?>">查看</a>
									</td>
								</tr>
								<?php endforeach;?>
								<?php endif;?>

								</tbody>
							</table>
						</div>
					</div><!-- /.box-body -->
					<?php if(isset($pages)):?>
					<div class="box-footer clearfix">
						<ul class="pagination pagination-sm no-margin pull-right">
							<?php echo $pages;?>
						</ul>
					</div>
					<?php endif;?>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
	<
</body>
</html>