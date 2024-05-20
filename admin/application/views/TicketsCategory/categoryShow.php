<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 分类管理</title>
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
		<h1><?php echo isset($catname)?$catname:'关联表演';?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">分类管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>Show_ID</th>
								<th>表演</th>
								<th>权重 [1-100]</th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($showsinfo) && !empty($showsinfo)):?>
								<?php foreach($showsinfo as $v):?>
									<tr>
										<td><?php echo $v['show_id'];?></td>
										<td><?php echo $v['name'];?></td>
										<td>
											<input type="hidden"  value="<?php echo $v['show_id'];?>" name="showid[]">
											<input type="text"  value="<?php echo $v['sort'];?>" name="sort[]">
										</td>
									</tr>
								<?php endforeach;?>
							<?php else:;?>
								<tr>
									<td align="center" colspan = " 3 "><h1>暂无关联表演</h1></td>
								</tr>
							<?php endif;?>
							</tbody>
						</table>
						<br>
						<?php if(isset($showsinfo) && !empty($showsinfo)):?>
						<div align="center">
							<a type="button" class="btn btn-success" href="javascript:updateSort(<?php echo $cat_id;?>);">排 序</a>
						</div>
						<?php endif;?>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
	function updateSort(cat_id){
		//多选
		var showid = $('input[name="showid[]"]'); //品牌id 集合
		var sort = $('input[name="sort[]"]'); //品牌的权重值 集合

		//权重；
		var sort_arr = [];
		var sorts_str = '';
		for (i = 0; i < sort.length; i++) {
			if ($(sort[i]).val()) {
				var sorts = $(sort[i]).val();
				sort_arr.push(sorts);
			}
		}

		//品牌id：
		var show_arr = [];
		var shows_str = '';
		for (j = 0; j < showid.length; j++) {
			if ($(showid[j]).val()) {
				var showids = $(showid[j]).val();
				show_arr.push(showids);
			}
		}

		if((sort_arr.length > 0) && (show_arr.length > 0)) {
			sorts_str = sort_arr.join(',');
			shows_str = show_arr.join(',');
			$.ajax({
				url : "<?php echo site_url('TicketsCategory/updateSort');?>",
				type : 'post',
				dataType : 'json',
				data : {'sorts':sorts_str,'shows':shows_str,'cat_id':cat_id},
				success:function(data){
					console.log(data);
					if(data.info == 1){
						alert("更新成功！");
						location.reload();
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		}else{
			layer.alert('暂无记录！', {icon: 5});
		}
	}
</script>
</body>
</html>