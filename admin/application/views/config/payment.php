<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 支付方式</title>
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
		<h1>支付方式</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">支付方式</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('config/addPayment');?>"><span class="glyphicon glyphicon-plus"></span> 添加支付方式</a>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>ID</th>
									<th>支付方式</th>
									<th>手续费用</th>
									<th>描述</th>
									<th>开发者</th>
									<th>客户端类型</th>
									<th>状态</th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['pay_id'];?></td>
									<td><?php echo $v['pay_name'];?></td>
									<td><?php echo $v['pay_fee'];?>%</td>
									<td><?php echo $v['pay_desc'];?></td>
									<td><?php echo $v['author'];?></td>
									<td><?php if($v['client_type']=='0'):;?>
										PC端
										<?php elseif($v['client_type']=='1'):;?>
										APP端
										<?php elseif($v['client_type']=='2'):;?>
										Wap/H5端
										<?php endif;?>
									</td>
									<td>
										<input type="checkbox" name="onoffswitchad" pay_id="<?php echo $v['pay_id'];?>" value="<?php echo $v['disabled'];?>" <?php if($v['disabled'] == 0):?>checked<?php endif;?> />
									</td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('config/editPayment');?>?pay_id=<?php echo $v['pay_id'];?>">配置</a>
										<a class="btn btn-sm btn-danger" href="javascript:delPayment(<?php echo $v['pay_id'];?>);">删除</a>
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
	/**删除支付方式**/
	function delPayment(pay_id){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : '<?php echo site_url('config/delPayment');?>',
				type : 'post',
				dataType : 'json',
				data : {'pay_id':pay_id},
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
	//支付方式关闭开启操作
	$("[name='onoffswitchad']").bootstrapSwitch({
		'onText' : '开',
		'offText' : '关'
	});
	$('input[name="onoffswitchad"]').on('switchChange.bootstrapSwitch', function(event, state) {
		var disabledvalue = this.value;//得到当前的值
		//点击后应该改变的值
		if(disabledvalue == 1){
			disabledvalue = 0;
		}else{
			disabledvalue = 1;
		}
		this.value = disabledvalue;
		var pay_id = this.getAttribute('pay_id');
		$.ajax({
			url : "<?php echo site_url('config/disabledPayment');?>",
			type : 'post',
			dataType : 'json',
			data : {'pay_id':pay_id,'disabled':disabledvalue},
			success:function(data){
				if(data.info != 1){
					layer.alert(data.tip, {icon: 5});
				}
			}
		});
	});
</script>
</body>
</html>