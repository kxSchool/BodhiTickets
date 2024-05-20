<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 资源管理</title>
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
		<h1>资源管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">资源管理</li>
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
						<div class="tables">
							<table class="table table-bordered">
							<thead>
							<tr>
								<th>ID</th>
								<th>文件名</th>
								<th>文件原名</th>
								<th>类型</th>
								<th>大小</th>
								<th>上传时间</th>
								<th>操作管理</th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($datas)):?>
							<?php foreach($datas as $v):?>
							<tr>
								<td><?php echo $v['id'];?></td>
								<td><?php echo $v['filename'];?></td>
								<td><?php echo $v['originname'];?></td>
								<td><?php echo $v['fileext'];?></td>
								<td><?php echo $v['filesize'];?></td>
								<td><?php echo date('Y-m-d H:i:s',$v['uploadtime']);?></td>
								<td>
									<?php if($v['canLook'] == 1):?>
										<a class="btn btn-sm btn-success" href="javascript:lookResource(<?php echo $v['id'];?>);">查看</a>
									<?php else:?>
										<a class="btn btn-sm btn-info" href="javascript:downloadResource(<?php echo $v['id'];?>);">下载</a>
									<?php endif;?>
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
	function lookResource(id){
		$.ajax({
			url : '<?php echo site_url('news/lookResource');?>',
			type : 'post',
			dataType : 'json',
			data : {'id':id},
			success:function(data){
				if(data.info == 1){
					layer.open({
						type: 1,
						title: false,
						closeBtn: 1,
						area: [data.width+'px', data.height+'px'],
						fix: false, //不固定
						skin: 'layui-layer-nobg', //没有背景色
						shadeClose: true,
						content: '<img src="'+data.imageurl+'" />'
					});
				}else{
					layer.alert(data.tip, {icon: 5});
				}
			}
		});
	}
	function downloadResource(id){
		$.ajax({
			url : '<?php echo site_url('news/downloadResource');?>',
			type : 'post',
			dataType : 'json',
			data : {'id':id},
			success:function(data){
				if(data.info != 1){
					layer.alert(data.tip, {icon: 5});
				}else{
					//开始下载
					window.open('<?php echo site_url("news/doDownloadResource");?>?id='+id+'');
				}
			}
		});
	}
</script>
</body>
</html>