<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 品牌分类</title>
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
		<h1><?php echo $name;?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>">表演管理</a></li>
			<li class="active">表演-分类</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>ID</th>
								<th>分类</th>
								<th><input type="checkbox" id="checkall"/></th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($LastLevelData) && !empty($LastLevelData)):?>
								<?php foreach($LastLevelData as $v):?>
									<tr>
										<td><?php echo $v['cat_id'];?></td>
										<td><?php echo $v['cat_name'];?></td>
										<!--没有子类的情况下才显示-->
                                        <td><input type="checkbox" name="subcheckbox[]" value="<?php echo $v['cat_id'];?>"  <?php if(isset($ids)):?><?php if(in_array($v['cat_id'],$ids)):?>checked<?php endif;?><?php endif;?>/></td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
							</tbody>
						</table>
						<br>
						<div align="center">
							<input type="hidden" value="">
							<a type="button" class="btn btn-success" href="javascript:updateShowCategory(<?php echo $id;?>);">确 认</a>
						</div>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
		//多选
		var subcheckboxs = $('input[name="subcheckbox[]"]');
		//改变会员的锁定状态
		function updateShowCategory(show_id){
			// 都哪些被勾选啦
			var checked_ids_arr = [];
			var checked_ids = '';
			for (i = 0; i < subcheckboxs.length; i++) {
				if ($(subcheckboxs[i]).prop('checked')) {
					var id = $(subcheckboxs[i]).val();
					checked_ids_arr.push(id);
				}
			}
			if(checked_ids_arr.length > 0){
				checked_ids = checked_ids_arr.join(',');
				$.ajax({
					url : "<?php echo site_url('show/updateShowCategory');?>",
					type : 'post',
					dataType : 'json',
					data : {'cat_id':checked_ids,'show_id':show_id},
					success:function(data){
						if(data.info == 1){
							alert("更新成功！");
							location.reload();
						}else{
							layer.alert(data.tip, {icon: 5});
						}
					}
				});
			}else{
				layer.alert('没有选中任何选中的记录！', {icon: 5});
			}
		}
</script>
</body>
</html>