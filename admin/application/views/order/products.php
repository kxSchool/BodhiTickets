<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 咨询时间</title>
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
		<h1>咨询时间</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">咨询时间</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('order/addProducts');?>"><span class="glyphicon glyphicon-plus"></span> 添加咨询时间</a>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>ID</th>
									<th>商铺 </th>
									<th>开始时间 </th>
									<th>结束时间 </th>
									<th>预约 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['product_id'];?></td>
									<td><?php echo $v['seller_name'];?></td>
									<td><?php echo date('Y-m-d H:i',$v['start_time']);?></td>
									<td><?php echo date('Y-m-d H:i',$v['end_time']);?></td>
									<td>
										<?php if(isset($v['order_status']) && $v['order_status'] == 1):?>
											<span class="label label-success">已预约</span>
										<?php else:?>
											<span class="label label-info">可预约</span>
										<?php endif;?>
									</td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('members/editStar');?>?starid=<?php echo $v['product_id'];?>">编辑</a>
										<a class="btn btn-sm btn-danger" href="javascript:delStar(<?php echo $v['product_id'];?>);">删除</a>
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
<script>
	/**删除星级**/
	function delStar(starid){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : '<?php echo site_url('members/delStar');?>',
				type : 'post',
				dataType : 'json',
				data : {'starid':starid},
				success:function(data){
					if(data.info == 1){
						location.reload();
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		});
	}
</script>
</body>
</html>