<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 座位管理</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>jquery-chosen/css/chosen.css" />
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
		<h1>座位管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>"><i class="fa fa-home" ></i>表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?show_id=<?php echo $mapInfo['show_id'];?>">座位图管理</a></li>
			<li><a href="<?php echo site_url('section/manage');?>?map_id=<?php echo $sectionInfo['map_id'];?>">区域管理</a></li>
			<li><a href="<?php echo site_url('price/manage');?>?section_id=<?php echo $priceInfo['section_id'];?>">价格区域</a></li>
			<li class="active">座位管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('seats/seats_add');?>?price_id=<?php echo $priceInfo['id'];?>"><span class="glyphicon glyphicon-plus"></span> 添加座位</a>
					</div><!-- /.box-header -->


					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>区域ID</th>
                                    <th>区域名称 </th>
                                    <th>行 </th>
                                    <th>列 </th>
                                    <th>号 </th>
                                    <th>CY </th>
                                    <th>CX </th>
                                    <th>区域价格 </th>
									<th class="col-sm-3">操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['id'];?></td>
                                    <td><?php echo $v['section_name'];?></td>
                                    <td><?php echo $v['row'];?></td>
                                    <td><?php echo $v['column'];?></td>
                                    <td><?php echo $v['seat_no'];?></td>
                                    <td><?php echo $v['cy'];?></td>
                                    <td><?php echo $v['cx'];?></td>
                                    <td><?php echo $v['unit_price'];?></td>
                                    <td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('seats/seats_edit');?>?map_id=<?php echo $mapInfo['id'];?>&id=<?php echo $v['id'];?>">编辑</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:delSeats(<?php  echo $v['id'];?>,<?php  echo $mapInfo['id'];?>)">删除</a>
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
<script src="<?php echo STATIC_PATH; ?>jquery-chosen/js/chosen.jquery.js"></script>
<script>
/**删除场次**/
	function delSeats(id,map_id){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : '<?php echo site_url('seats/seats_del'); ?>',
				type : 'post',
				dataType : 'json',
				data : {'id':id,'map_id':map_id},
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