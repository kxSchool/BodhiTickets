<?php
//print_r(date('Y-m-d H:i:s',$eventInfo['show_date']));exit;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 修改场次</title>
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
		<h1>修改场次-----<?php echo $showInfo['name'];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('event/manage');?>">场次管理</a></li>
			<li class="active">修改场次</li>
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
						<form id="cateForm" class="form-horizontal" method="post" action="<?php echo site_url('event/event_save');?>?show_id=<?php echo $eventInfo['show_id'];?>">
							<div class="form-group">
								<label for="id" class="col-sm-2 control-label">演出场馆：</label>
								<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $eventInfo['id'];?>" />
								<div class="col-sm-10">
									<select class="form-control" name="venue_id" id="venue_id">
										<option value="0">==选择演出场馆==</option>
										<?php if(isset($venues)):?>
										<?php foreach($venues as $v):?>
											<option value="<?php echo $v['id'];?>" <?php if($eventInfo['venue_id'] == $v['id']):?>selected<?php endif;?>><?php echo $v['venue_name'];?></option>
										<?php endforeach;?>
										<?php endif;?>
									</select>
								</div>
							</div>
							<div class="form-group">
									<label for="show_date" class="col-sm-2 control-label">演出日期：</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="show_date" id="show_date" placeholder="开始日期不填写，则为当前时间" value="<?php echo date('Y-m-d H:i:s',$eventInfo['show_date']);?>" />
									</div>
								</div>
							<div class="form-group">
								<label for="map_id" class="col-sm-2 control-label">座位图号：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="map_id" id="map_id" placeholder="座位图号" value="<?php echo $eventInfo['map_id'];?>" />
								</div>
                            </div>
							<div class="form-group">
								<label for="order" class="col-sm-2 control-label">权重排序：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="order" id="order" placeholder="输入排序" value="<?php echo $eventInfo['order'];?>" />
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
							message: '演出场馆未选择'
						}
					}
				},
				categoryname: {
					group: '.col-sm-10',
					validators: {
						notEmpty: {
							message: '演出时间不能为空'
						}
					}
				}
			}
		});
        // 开始时间
		$("#show_date").datetimepicker({
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