<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 栏目管理</title>
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
		<h1>栏目管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">栏目管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('news/addCategory');?>"><span class="glyphicon glyphicon-plus"></span> 创建栏目</a>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>ID</th>
									<th>栏目</th>
									<th>数量</th>
									<th>类型 </th>
									<th>菜单 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($categorys) && !empty($categorys)):?>
								<?php foreach($categorys as $v):?>
								<tr>
									<td><?php echo $v['catid'];?></td>
									<?php
										$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
									?>
									<td> <span><?php echo $nbsp.$v['spacer'];?></span><?php echo $v['catname'];?></td>
									<td><?php echo $v['count'];?></td>
									<td><?php if($v['type'] == 0):?>普通分类<?php else:?>单网页<?php endif;?></td>
									<td><input type="checkbox" name="onoffswitchcategory" catid="<?php echo $v['catid'];?>" value="<?php echo $v['ismenu'];?>" <?php if($v['ismenu'] == 1):?>checked<?php endif;?> /></td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('news/editCategory');?>?catid=<?php echo $v['catid'];?>">编辑</a>
										<a class="btn btn-sm btn-danger" href="javascript:delCategory(<?php echo $v['catid'];?>);">删除</a>
									</td>
								</tr>
								<?php endforeach;?>
								<?php endif;?>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
	/**删除栏目**/
	function delCategory(catid){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : "<?php echo site_url('news/delCategory');?>",
				type : 'post',
				dataType : 'json',
				data : {'catid':catid},
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
	$(function(){
		//广告关闭开启操作
		$("[name='onoffswitchcategory']").bootstrapSwitch({
			'onText' : '开',
			'offText' : '关'
		});
		$('input[name="onoffswitchcategory"]').on('switchChange.bootstrapSwitch', function(event, state) {
			var ismenuvalue = this.value;//得到当前的值
			//点击后应该改变的值
			if(ismenuvalue == 1){
				ismenuvalue = 0;
			}else{
				ismenuvalue = 1;
			}
			this.value = ismenuvalue;
			var catid = this.getAttribute('catid');
			$.ajax({
				url : "<?php echo site_url('news/ismenuCategory');?>",
				type : 'post',
				dataType : 'json',
				data : {'catid':catid,'ismenu':ismenuvalue},
				success:function(data){
					if(data.info != 1){
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		});
	})
</script>
</body>
</html>