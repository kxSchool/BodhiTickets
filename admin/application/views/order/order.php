<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 订单管理</title>
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
		<h1>订单管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">订单管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="pull-right">
							<form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('order/index');?>">
								<div class="form-group">
									<select class="form-control" name="type" id="type">
										<option value="1" <?php if(isset($type) && $type == 1):?>selected="selected"<?php endif;?>>==按下订单时间==</option>
										<option value="2" <?php if(isset($type) && $type == 2):?>selected="selected"<?php endif;?>>==按咨询开始时间==</option>
									</select>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="start_time" id="start_time" placeholder="开始时间" value="<?php if(isset($start_time)):?><?php echo $start_time;?><?php endif;?>" />
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="end_time" id="end_time" placeholder="结束时间" value="<?php if(isset($end_time)):?><?php echo $end_time;?><?php endif;?>" />
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="order_sn" id="order_sn" placeholder="订单编号" value="<?php if(isset($order_sn)):?><?php echo $order_sn;?><?php endif;?>" />
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info" name="dosearch" value="1">搜索</button>
								</div>
								<div class="form-group">
									<a class="btn btn-success" name="exportExcel" id="exportExcel">导出Excel表格</a>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>ID</th>
									<th>订单编号</th>
									<th>商铺 </th>
									<th>普通用户</th>
									<th>下单时间</th>
									<th>支付方式</th>
									<th>价格</th>
									<th>订单状态</th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['order_id'];?></td>
									<td><?php echo $v['order_sn'];?></td>
									<td><?php echo $v['seller_name'];?></td>
									<td><?php echo $v['user_name'];?></td>
									<td><?php echo date('Y-m-d H:i',$v['add_time']);?></td>
									<td><?php echo $v['payment'];?></td>
									<td><?php echo $v['goods_amount'];?></td>
									<td>
										<span class="label label-info"><?php echo $pay_status[$v['pay_status']];?></span>
										<span class="label label-success"><?php echo $order_status[$v['order_status']];?></span>
										<span class="label label-danger"><?php echo $shipping_status[$v['shipping_status']];?></span>
									</td>
									<td>
										<?php if($v['refund_status'] != 0 && $v['order_status'] != 2):?>
										<button class="btn btn-sm btn-danger" onclick="refundHandel(<?php echo $v['order_id'];?>)"><?php echo $refund_status[$v['refund_status']];?></button>
										<?php endif;?>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('order/detailOrder');?>?order_id=<?php echo $v['order_id'];?>">查看订单</a>
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
$(function(){
	//导出订单excel
	$("#exportExcel").click(function(){
		var postData = {};
		var type = $("#type").val();
		if(type.length > 0){
			postData.type = type;
		}
		var start_time = $("#start_time").val();
		if(start_time.length > 0){
			postData.start_time = start_time;
		}
		var end_time = $("#end_time").val();
		if(end_time.length > 0){
			postData.end_time = end_time;
		}
		var order_sn = $("#order_sn").val();
		if(order_sn.length > 0){
			postData.order_sn = order_sn;
		}
		var postArray = new Array();
		var i = 0;
		$.each(postData,function(k,v){
			postArray[i] = k + '=' + v;
			i++;
		})
		var postStr = postArray.join("&");
		var openUrl = '<?php echo site_url('order/exportOrderExcel')?>'+'?'+postStr;
		window.open(openUrl,'_blank')
	});
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
//处理申请退款
function refundHandel(order_id){
	//首先弹出来退款申请的理由
	$.ajax({
		url : "<?php echo site_url('order/ajaxGetOrderInfo');?>",
		type : 'post',
		dataType : 'json',
		data : {'order_id':order_id},
		success:function(data){
			if(data.info == 1){
				layer.confirm(data.data.refund_desc, {
					btn: ['同意','取消'] //按钮
				}, function(){
					$.ajax({
						url : "<?php echo site_url('order/ajaxRefundOrder');?>",
						type : 'post',
						dataType : 'json',
						data : {'order_id':order_id},
						success:function(data){
							if(data.info == 1){
								location.reload();
							}else{
								layer.alert(data.tip, {icon: 5});
							}
						}
					});
				}, function(index){
					layer.close(index);
				});
			}else{
				layer.alert(data.tip, {icon: 5});
			}
		}
	});
}
</script>
</body>
</html>