<?php
//print_r(date('Y-m-d H:i:s',$eventInfo['show_date']));exit;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 修改区域</title>
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
		<h1>修改区域</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>">表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?show_id=<?php echo $mapInfo['show_id'];?>">座位图管理</a></li>
			<li><a href="<?php echo site_url('section/manage');?>?map_id=<?php echo $sectionInfo['map_id'];?>">区域管理</a></li>
			<li class="active">修改区域</li>
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
						<form id="cateForm" class="form-horizontal" method="post" action="<?php echo site_url('section/section_save');?>?id=<?php echo $sectionInfo['id'];?>">
                                <div class="form-group">
								<label for="section_name" class="col-sm-2 control-label">区域名称：</label>
								<div class="col-sm-10">
                                    <input type="text" class="form-control" name="section_name" id="section_name" value="<?php echo $sectionInfo['section_name'];?>" />
                                </div>
                            </div>
							<div class="form-group">
								<label for="fillcolor" class="col-sm-2 control-label">颜色数值：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="fillcolor" id="fillcolor" placeholder="输入颜色" value="<?php echo $sectionInfo['fillcolor'];?>" />
								</div>
							</div>
                            <div class="form-group">
								<label for="section_path" class="col-sm-2 control-label">区块路径：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="section_path" id="section_path" placeholder="输入区块路径：" value="<?php echo $sectionInfo['section_path'];?>" />
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