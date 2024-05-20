<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>票商中心管理系统 | 订单管理</title>
<?php $this -> load -> view('common/top'); ?>
<!--<link rel="stylesheet" href="--><?php //echo STATIC_PATH; ?><!--datetimepicker/bootstrap-datetimepicker.min.css" />-->
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
                            <form id="searchNewsForm" class="form-inline" method="get" action="">
                                <div class="form-group">
                                    <select class="form-control" name="fields" id="fields">
                                        <option value="0">==选择栏目==</option>
                                        <option value="action_user"  <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'action_user'):?>selected<?php endif;?><?php endif;?>>用户名</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" id="search" placeholder="输入搜索内容..." value="<?php if(isset($search) && !empty($search)):?><?php echo $search;?><?php endif;?>"/>
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
                                <th>ID</th>
                                <th>普通用户</th>
                                <th>下单时间</th>
                                <th>操作管理</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($datas)):?>
                                    <?php foreach($datas as $v):?>
                                        <tr>
                                            <td><?php echo $v['action_id'];?></td>
                                            
                                            <td><?php echo $v['action_user'];?></td>
                                            <td><?php echo $v['log_time'];?></td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" href="<?php echo site_url('ticketsorder/detailOrde') ?>?order_id=<?php echo $v['order_id'];?>">查看详情</a>
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