<!DOCTYPE html>
<html>
<head>
	<title>票商中心管理系统 | 订单详情</title>
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
				<li><a href="<?php echo site_url('ticketsorder/detailOrde');?>">订单管理</a></li>
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
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>ORDER_ID</th>
                                            <th>ORDER_SN</th>
											<th>MOBILE</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(isset($datas)):?>
                                                <?php foreach($datas as $v):?>
                                                    <tr>
                                                        <td><?php echo $v['order_id'];?></td>
                                                        <td><?php echo $v['order_sn'];?></td>
                                                        <td><?php echo $v['mobile'];?></td>

                                                    </tr>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                            </tbody>
                                        </table>
										</div>
									</div>
								</div>
							</div>
						</li>
										<li>
											<i class="fa fa-clock-o bg-gray"></i>
										</li>
									</ul>
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