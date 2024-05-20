<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 全景管理</title>
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
		<h1>全景管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('show/manage');?>"><i class="fa fa-home" ></i>表演管理</a></li>
			<li><a href="<?php echo site_url('map/manage');?>?show_id=<?php echo $mapInfo['show_id'];?>">场馆管理</a></li>
			<li><a href="<?php echo site_url('section/manage');?>?map_id=<?php echo $sectionInfo['map_id'];?>">区域管理</a></li>
			<li class="active">全景管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('panorama/panorama_add');?>?section_id=<?php echo $section_id;?>"><span class="glyphicon glyphicon-plus"></span> 添加全景</a>
					</div><!-- /.box-header -->


					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>全景ID</th>
                                    <th>全景名称 </th>
                                    <th>缩略图 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['id'];?></td>
                                    <td><?php echo $sectionInfo['section_name'];?></td>
                                    <td><div style="display: block;width: 80px;height:80px;overflow: hidden;"><?php if(!empty($v['mini'])):;?><img src="<?php echo $v['mini'];?>" style="width:80px;vertical-align:middle;"><?php else:?>暂无Logo<?php endif;?></div></td>
                                    <td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('panorama/panorama_edit');?>?id=<?php echo $v['id'];?>">编辑</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:delPanorama(<?php  echo $v['id'];?>)">删除</a>
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
	function delPanorama(id){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : '<?php echo site_url('panorama/panorama_del'); ?>',
				type : 'post',
				dataType : 'json',
				data : {'id':id},
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