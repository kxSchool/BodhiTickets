<?php
//print_r(date('Y-m-d H:i:s',$eventInfo['show_date']));exit;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 修改座位</title>
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
		<h1>修改座位</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>"><i class="fa fa-home" ></i>表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?map_id=<?php echo $section['map_id'];?>">座位图管理</a></li>
			<li><a href="<?php echo site_url('section/manage');?>?map_id=<?php echo $section['map_id'];?>">区域管理</a></li>
			<li class="active">修改座位</li>
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
						<form id="cateForm" class="form-horizontal" method="post" action="<?php echo site_url('seats/seats_save');?>?map_id=<?php echo $seatsInfo['map_id'];?>&id=<?php echo $seatsInfo['id'];?>">
                            <div class="form-group">
								<label for="seat_no" class="col-sm-2 control-label">座位号：</label>
								<div class="col-sm-10">
                                    <input type="text" class="form-control" name="seat_no" id="seat_no" value="<?php echo $seatsInfo['seat_no'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
								<label for="cy" class="col-sm-2 control-label">CY：</label>
								<div class="col-sm-10">
                                    <input type="text" class="form-control" name="cy" id="cy" placeholder="Y坐标" value="<?php echo $seatsInfo['cy'];?>" />
                                </div>
                            </div>
							<div class="form-group">
								<label for="cx" class="col-sm-2 control-label">CX：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="cx" id="cx" placeholder="X坐标" value="<?php echo $seatsInfo['cx'];?>" />
								</div>
							</div>
                            <div class="form-group">
								<label for="row" class="col-sm-2 control-label">排号：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="row" id="row" placeholder="输入排号" value="<?php echo $seatsInfo['row'];?>" />
								</div>
							</div>
                            <div class="form-group">
								<label for="column" class="col-sm-2 control-label">列号：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="column" id="column" placeholder="输入列号" value="<?php echo $seatsInfo['column'];?>" />
								</div>
							</div>
                            <div class="form-group">
								<label for="status" class="col-sm-2 control-label">状态：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="status" id="status" placeholder="输入状态：1为上架可售；2为已售；" value="<?php echo $seatsInfo['status'];?>" />
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
        
	})
</script>
</body>
</html>