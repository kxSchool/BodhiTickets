<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>票商中心管理系统 | 咨询时间</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.css" />
<script src="<?php echo STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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
		<h1>咨询时间</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('order/products');?>">咨询时间</a></li>
			<li class="active">添加咨询时间</li>
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
						<form id="productsForm" class="form-horizontal" method="post" action="<?php echo site_url('order/saveProducts')?>">
							<div class="form-group">
								<label for="seller_id" class="col-sm-2 control-label">商铺ID：</label>
								<div class="col-sm-10">
									<input class="form-control" name="seller_id" id="seller_id" placeholder="输入商铺ID" />
								</div>
							</div>
							<div class="form-group">
								<label for="start_time" class="col-sm-2 control-label">开始时间：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="start_time" id="start_time" placeholder="输入开始时间" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="end_time" class="col-sm-2 control-label">截止时间：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="end_time" id="end_time" placeholder="输入截止时间" value="" />
								</div>
							</div>
							<div class="form-group">
								<label for="number" class="col-sm-2 control-label">数量：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="number" id="number" placeholder="输入生成咨询时间的数量" value="" />
								</div>
							</div>
							<div class="col-sm-offset-2">
								<button type="submit" class="btn btn-success">生成保存</button>
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
		/**添加、编辑咨询时间验证**/
		$('#productsForm').bootstrapValidator({
			message: '此值无效',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				seller_id: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '商铺ID不能为空'
						}
					}
				},
				start_time: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '开始咨询时间不能为空'
						}
					}
				},
				end_time: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '咨询截止时间不能为空'
						}
					}
				},
				ad_link: {
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
		// 开始时间
		$("#start_time").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
		// 结束时间
		$("#end_time").datetimepicker({
			language:  'zh-CN',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			showMeridian: 1
		});
	})
</script>
</body>
</html>