<!DOCTYPE html>
<html>
<head>
	<title>泡米票仓管理系统 | 订单详情</title>
	<?php $this ->load -> view('common/top'); ?>
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
	<?php $this ->load -> view('common/header'); ?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this ->load -> view('common/left'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>订单详情</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li><a href="<?php echo site_url('TicketsOrder/index');?>">订单管理</a></li>
				<li class="active">订单详情</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<!-- The time line -->
					<ul class="timeline">
						<!-- timeline item -->
						<li>
							<i class="fa fa-info-circle bg-blue"></i>
							<div class="timeline-item">
								<h3 class="timeline-header">订单基本信息</h3>
								<div class="timeline-body">
									<div class="box">
										<div class="box-body">
											<table class="table table-bordered">
												<tr>
													<th>订单编号：</th>
													<td><?php echo $orderInfo['order_sn'];?></td>
													<th>支付状态：</th>
													<td><?php echo $pay_status[$orderInfo['pay_status']];?></td>
												</tr>
												<tr>
													<th>下单用户：</th>
													<td><?php echo $memberInfo['username'];?></td>
													<th>商铺：</th>
													<td><?php echo $sellerInfo['username'];?>（<?php echo $sellerInfo['userid'];?>）</td>
												</tr>
												<tr>
													<th>下单时间：</th>
													<td><?php echo date('Y-m-d H:i',$orderInfo['add_time']);?></td>
													
												<tr>
													<th>支付金额：</th>
													<td><?php echo $orderInfo['goods_amount'];?></td>
													<th>付款方式：</th>
													<td><?php echo $orderInfo['payment'];?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</li>
                                                <li>
							<i class="fa fa-info-circle bg-blue"></i>
							<div class="timeline-item">
								<h3 class="timeline-header">订单商品信息</h3>
								<div class="timeline-body">
									<div class="box">
										<div class="box-body">
											<table class="table table-bordered">
												<tr>
													<th>商品名称</th>
													<th>自定义编码</th>
                                                                                                        <th>价格</th>
                                                                                                        <th>数量</th>
												</tr>
                                                                                                <?php if(!empty($orderGoodsInfo)) :?>
                                                                                                <?php foreach($orderGoodsInfo as $ogikey=>$ogival) :?>
												<tr>
													<td>
                                                                                                            <img src="<?php echo $ogival['thumb'];?>" style="padding-left:10px;width: 60px;height: 60px;">
                                                                                                            <a href="<?php echo config_item('shop_url')?>/b2b/goods?productid=<?php echo $ogival['product_id'] ?>" target="_blank">
                                                                                                                <?php echo $ogival['goods_name'] ;?>
                                                                                                            </a>
                                                                                                        </td>
													<td><?php echo $ogival['definedcode'] ;?></td>
													<td>￥<?php echo $ogival['goods_price'] ;?></td>
													<td>x<?php echo $ogival['goods_number'] ;?></td>
												</tr>
                                                                                                <?php endforeach; ?>
                                                                                                <?php endif; ?>
											</table>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li>
							<i class="fa fa-user bg-aqua"></i>
							<div class="timeline-item">
								<h3 class="timeline-header">买家基本资料</h3>
								<div class="timeline-body">
									<div class="box">
										<div class="box-body">
											<table class="table table-bordered">
												<tr>
													<th>买家名称：</th>
													<td><?php echo $orderInfo['consignee'];?></td>
													<th>性别：</th>
													<td><?php echo $orderVisitorInfo['sexname'];?></td>
													<th>年龄：</th>
													<td><?php echo $orderVisitorInfo['age'];?></td>
												</tr>
												<tr>
													<th>营业执照:</th>
													<td></td>
													<th>手机号码：</th>
													<td><?php echo $orderInfo['tel'];?></td>
												</tr>
												<tr>
													<th>收货地址：</th>
													<td colspan="5"><?php echo $orderInfo['address'];?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</li>
                                                <li>
							<i class="fa fa-user bg-aqua"></i>
							<div class="timeline-item">
								<h3 class="timeline-header">卖家基本资料</h3>
								<div class="timeline-body">
									<div class="box">
										<div class="box-body">
											<table class="table table-bordered">
												<tr>
													<th>卖家名称：</th>
													<td><?php echo $sellerInfo['realname'];?></td>
													<th>性别：</th>
													<td><?php echo $sellerInfo['sexname'];?></td>
													<th>年龄：</th>
													<td><?php echo $sellerInfo['age'];?></td>
												</tr>
												<tr>
													<th>营业执照:</th>
													<td></td>
													<th>手机号码：</th>
													<td><?php echo $sellerInfo['mobile'];?></td>
												</tr>
												<tr>
													<th>卖家联系地址：</th>
													<td colspan="5"><?php echo $sellerInfo['address'];?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li>
							<i class="fa fa-comments bg-yellow"></i>
							<div class="timeline-item">
								<h3 class="timeline-header">订单跟踪</h3>
								<div class="timeline-body">
									<?php if(isset($orderAction)):?>
									<ul class="timeline">
										<?php foreach($orderAction as $v):?>
										<li>
											<i class="fa fa-clock-o"></i>
											<div class="timeline-item">
												<span class="time"><i class="fa fa-clock-o"></i> <?php echo date('Y-m-d H:i',$v['log_time']);?></span>
												<div class="timeline-body">
													<?php echo $v['action_user'];?>   <?php echo $v['action_note'];?>
												</div>
											</div>
										</li>
										<?php endforeach;?>
										<li>
											<i class="fa fa-clock-o bg-gray"></i>
										</li>
									</ul>
									<?php endif;?>
								</div>
							</div>
						</li>
						<!-- END timeline item -->
						<li>
							<i class="fa fa-clock-o bg-purple"></i>
						</li>
					</ul>
				</div>
				<!-- /.col -->
			</div>
		</section><!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php $this ->load -> view('common/footer'); ?>
</body>
</html>