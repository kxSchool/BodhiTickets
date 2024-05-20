<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 内容管理</title>
<?php $this -> load -> view('common/top'); ?>
	<script>
		$(function(){
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		})
	</script>
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
		<h1>内容管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">内容管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="pull-left">
							<a type="button" class="btn btn-success" href="<?php echo site_url('news/addNews');?>"><span class="glyphicon glyphicon-plus">创建文章</a>
						</div>
						<div class="pull-right">
							<form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('news/index');?>">
								<div class="form-group">
									<select class="form-control" name="catid" id="catid">
										<option value="0">==选择栏目==</option>
										<?php if(isset($categorys)):?>
										<?php foreach($categorys as $v):?>
											<?php
											$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
											?>
											<option value="<?php echo $v['catid'];?>" <?php if(isset($v['childrenCount'])):?>disabled="disabled"<?php endif;?> <?php if(isset($searchcatid) && $v['catid'] == $searchcatid):?>selected<?php endif;?>><?php echo $nbsp.$v['spacer'].$v['catname'];?></option>
										<?php endforeach;?>
										<?php endif;?>
									</select>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="search" id="search" placeholder="输入搜索内容..." value="<?php if(isset($search) && !empty($search)):?><?php echo $search;?><?php endif;?>" />
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
							<tr>
								<th><input type="checkbox" id="checkall"/></th>
								<th>ID</th>
								<th>标题 </th>
								<th>栏目 </th>
								<th>访问量 </th>
								<th>发布日期 </th>
								<th>状态 </th>
								<th>排序 </th>
								<th>操作管理</th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($datas)):?>
							<?php foreach($datas as $v):?>
							<tr>
								<td><input type="checkbox" name="subcheckbox[]" value="<?php echo $v['id'];?>"/></td>
								<td><?php echo $v['id'];?></td>
								<td><?php echo str_cut($v['title'],80,'......');?></td>
								<td><?php echo $v['catname'];?></td>
								<td><?php echo $v['views'];?></td>
								<td><?php echo date('Y-m-d H:i:s',$v['publishtime']);?></td>
								<td>
									<?php if($v['status'] == 0):?>
									<span class="label label-default">草稿</span>
									<?php elseif($v['status'] == 1):?>
									<span class="label label-info">已发布</span>
									<?php elseif($v['status'] == 2):?>
									<span class="label label-primary">未发布</span>
									<?php endif;?>

									<?php if($v['top'] == 1):?>
										<span class="label label-success">置顶</span>
									<?php endif;?>

									<?php if($v['recommend'] == 1):?>
										<span class="label label-success">推荐</span>
									<?php endif;?>

								</td>
								<td>
									<input type="text" class="form-control" value="<?php echo $v['listorder'];?>" newsid="<?php echo $v['id']; ?>" name="listorder" style="width:60px;text-align:center;" />
								</td>
								<td>
									<a class="btn btn-sm btn-info" href="<?php echo site_url('news/editNews');?>?id=<?php echo $v['id'];?>">编辑</a>
									<a class="btn btn-sm btn-danger" href="javascript:delNews(<?php echo $v['id'];?>);">删除</a>
								</td>
							</tr>
							<?php endforeach;?>
							<?php endif;?>
							<tr>
								<td>
									<input type="checkbox" id="belowcheckall" />
								</td>
								<td colspan="8">
									<div class="btn-group dropup">
										<button type="button" class="btn btn-default">状态修改</button>
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu">
											<li><a href="javascript:updateNews('recommend',1);">推荐</a></li>
											<li><a href="javascript:updateNews('recommend',0);">取消推荐</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="javascript:updateNews('top',1);">置顶</a></li>
											<li><a href="javascript:updateNews('top',0);">取消置顶</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="javascript:updateNews('status',1);">发布</a></li>
											<li><a href="javascript:updateNews('status',2);">取消发布</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="javascript:updateNews('status',0);">加入草稿箱</a></li>
										</ul>
									</div>
									<a type="button" class="btn btn-success" href="javascript:listorderNews();">保存排序</a>
									<a type="button" class="btn btn-danger" href="javascript:batchDelNews();">批量删除</a>
								</td>
							</tr>
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
	var subcheckboxs = $('input[name="subcheckbox[]"]');
	//文章推荐、取消推荐、文章置顶、文章状态改变
	function updateNews(type,value){
		// 都哪些被勾选啦
		var checked_ids_arr = [];
		var checked_ids = ''
		for (i = 0; i < subcheckboxs.length; i++) {
			if ($(subcheckboxs[i]).prop('checked')) {
				var id = $(subcheckboxs[i]).val();
				checked_ids_arr.push(id);
			}
		}
		if(checked_ids_arr.length > 0){
			checked_ids = checked_ids_arr.join(',');
			$.ajax({
				url : "<?php echo site_url('news/updateNews');?>",
				type : 'post',
				dataType : 'json',
				data : {'ids':checked_ids,'type':type,'value':value},
				success:function(data){
					if(data.info == 1){
						location.reload();
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		}else{
			layer.alert('没有选中任何选中的记录！', {icon: 5});
		}
	}
	/**批量删除文章**/
	function batchDelNews(){
		// 都哪些被勾选啦
		var checked_ids_arr = [];
		var checked_ids = ''
		for (i = 0; i < subcheckboxs.length; i++) {
			if ($(subcheckboxs[i]).prop('checked')) {
				var id = $(subcheckboxs[i]).val();
				checked_ids_arr.push(id);
			}
		}
		if(checked_ids_arr.length > 0){
			checked_ids = checked_ids_arr.join(',');
			$.ajax({
				url : "<?php echo site_url('news/batchDelNews');?>",
				type : 'post',
				dataType : 'json',
				data : {'ids':checked_ids},
				success:function(data){
					if(data.info == 1){
						location.reload();
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		}else{
			layer.alert('没有选中任何选中的记录！', {icon: 5});
		}
	}
	/**文章排序**/
	function listorderNews(){
		//当前页面所有排序的input
		var listorders = $("input[name='listorder']");
		var postListorder = {};
		for(i=0; i<listorders.length; i++){
			var id = $(listorders[i]).attr('newsid');
			var listorderValue = $(listorders[i]).val();
			postListorder[id] = listorderValue;
		}
		$.ajax({
			url : "<?php echo site_url('news/listorderNews');?>",
			type : 'post',
			dataType : 'json',
			data : {'postListorder':postListorder},
			success:function(data){
				if(data.info == 1){
					location.reload();
				}else{
					layer.alert(data.tip, {icon: 5});
				}
			}
		});
	}
</script>
</body>
</html>