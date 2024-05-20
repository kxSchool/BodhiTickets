<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 证书审核</title>
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
		<h1>证书审核</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">证书审核</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="pull-right">
							<form id="searchFeedbackForm" class="form-inline" method="post" action="<?php echo site_url('members/certificate');?>">
								<div class="form-group">
									<select class="form-control" name="authority" id="authority">
										<option value="3" <?php if(isset($authority) && $authority == 3):?>selected="selected"<?php endif;?>>==全部证书==</option>
										<option value="0" <?php if(isset($authority) && $authority == 0):?>selected="selected"<?php endif;?>>==申请认证==</option>
										<option value="1" <?php if(isset($authority) && $authority == 1):?>selected="selected"<?php endif;?>>==已认证==</option>
										<option value="2" <?php if(isset($authority) && $authority == 2):?>selected="selected"<?php endif;?>>==拒绝认证==</option>
									</select>
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
									<th>编号ID</th>
									<th>用户名 </th>
									<th>证书资质</th>
									<th>培训机构</th>
									<th>状态 </th>
									<th>申请时间 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php if($v['authority'] == 0):?><input type="checkbox" name="subcheckbox[]" value="<?php echo $v['id'];?>"/><?php endif;?></td>
									<td><?php echo $v['id'];?></td>
									<td><?php echo $v['username'];?></td>
									<td><?php echo $v['title'];?></td>
									<td><?php echo $v['institution'];?></td>
									<td>
										<?php if($v['authority'] == 0):?>
											申请认证
										<?php elseif($v['authority'] == 1):?>
											通过认证
										<?php elseif($v['authority'] == 2):?>
											拒绝认证
										<?php endif;?>
									</td>
									<td><?php echo date('Y-m-d',$v['add_time']);?></td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('members/certificateDetail').'?id='.$v['id'];?>">查看</a>
									</td>
								</tr>
								<?php endforeach;?>
								<?php endif;?>
								<tr>
									<td>
										<input type="checkbox" id="belowcheckall" />
									</td>
									<td colspan="5">
										<div class="btn-group dropup">
											<button type="button" class="btn btn-default">证书审核</button>
											<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="caret"></span>
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<ul class="dropdown-menu">
												<li><a href="javascript:batchUpdatecertificate(1);">通过认证</a></li>
												<li><a href="javascript:batchUpdatecertificate(2);">拒绝认证</a></li>
											</ul>
										</div>
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
		/**批量更新证书审核**/
		function batchUpdatecertificate(authority){
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
					url : "<?php echo site_url('members/batchUpdatecertificate');?>",
					type : 'post',
					dataType : 'json',
					data : {'ids':checked_ids,'authority':authority},
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
	</script>
</body>
</html>