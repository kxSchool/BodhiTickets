<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>票商中心管理系统 | 职员管理</title>
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
			<h1>职员管理</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li class="active">职员管理</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<div class="pull-left">
								<a type="button" class="btn btn-success" href="<?php echo site_url('staff/addStaff');?>"><span class="glyphicon glyphicon-plus"></span>添加职员</a>
							</div>
							<div class="pull-right">
								<form id="searchUsersForm" class="form-inline" method="post" action="<?php echo site_url('staff/index');?>">
									<?php if(isset($membersTables) && !empty($membersTables)):?>
										<div class="form-group">
											<select class="form-control" name="tablename" id="tablename">
												<option value="">==职员表==</option>
												<?php foreach($membersTables as $v):?>
													<option value="<?php echo $v['TABLE_NAME'];?>" <?php if(isset($searchtable) && $searchtable == $v['TABLE_NAME']):?>selected<?php endif;?>>==<?php echo $v['TABLE_NAME'];?>==</option>
												<?php endforeach;?>
											</select>
										</div>
									<?php endif;?>
									<div class="form-group">
										<select class="form-control" name="searchtype" id="searchtype">
											<option value="0">==搜索条件==</option>
											<option value="1" <?php if(isset($searchtype) && $searchtype == 1):?>selected<?php endif;?>>账号</option>
											<option value="2" <?php if(isset($searchtype) && $searchtype == 2):?>selected<?php endif;?>>真实姓名</option>
											<option value="3" <?php if(isset($searchtype) && $searchtype == 3):?>selected<?php endif;?>>手机号</option>
											<option value="4" <?php if(isset($searchtype) && $searchtype == 4):?>selected<?php endif;?>>所属店铺</option>
										</select>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="searchtext" id="searchtext" placeholder="输入搜索内容..." value="<?php if(isset($searchtext) && !empty($searchtext)):?><?php echo $searchtext;?><?php endif;?>" />
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
										<th>职员ID</th>
                                                                                <th>店铺ID</th>
										<th>登录账号</th>
										<th>真实姓名</th>
										<!--<th>性别</th>-->
										<th>手机号</th>
										<!--<th>邮箱</th>-->
										<th>环信账号</th>
										<!--<th>星级</th>-->
                                                                                <th>注册时间 </th>
										<th>锁定状态</th>
										<!--<th>上次登陆时间</th>-->
										<!--<th>权重</th>-->
										<th>操作管理</th>
									</tr>
									</thead>
									<tbody>
									<?php if(isset($datas) && !empty($datas)):?>
										<?php foreach($datas as $v):?>
											<tr>
												<td><input type="checkbox" name="subcheckbox[]" value="<?php echo $v['userid'];?>"/></td>
												<td><?php echo $v['userid'];?></td>
                                                                                                <td><?php echo $v['shopid'];?></td>
												<td><?php echo $v['username'];?></td>
												<td><?php echo $v['realname'];?></td>
												<!--<td><?php //if($v['sex'] == 1):?>男<?php //elseif($v['sex'] == 2):?>女<?php //elseif($v['sex'] == 0):?>保密<?php //endif;?></td>-->
												<td><?php echo $v['mobile'];?></td>
												<!--<td><?php //echo $v['email'];?></td>-->
												<td><?php echo $v['hxname']; ?></td>
												<!--<td><?php //echo isset($v['starname'])?$v['starname']:'';?></td>-->
												
												<td><?php echo date('Y-m-d H:i:s',$v['register_time']);?></td>
												<!--<td><?php //echo date('Y-m-d H:i:s',$v['login_time']);?></td>-->
												<!--<td><?php //echo $v['sort'];?></td>-->
                                                                                                <td>
													<?php if($v['disabled'] == 1):?>
														<span class="label label-danger">锁定</span>
														<?php elseif($v['disabled'] == 0):?>
														<span class="label label-info">未锁定</span>
													<?php endif;?>
												</td>
												<td>
													<a class="btn btn-sm btn-info" href="<?php echo site_url('staff/editStaff');?>?userid=<?php echo $v['userid'];?>">编辑</a>
                                                                                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('Manager/assignPriv');?>?roleid=<?php echo $v['roleid'];?>">分配权限</a>
                                                                                                        <!--<a class="btn btn-sm btn-danger" href="javascript:delRole(<?php //echo $v['roleid'];?>)">删除</a>-->
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
													<li><a href="javascript:updateMembers('disabled',1);">锁定</a></li>
													<li><a href="javascript:updateMembers('disabled',0);">取消锁定</a></li>
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
		//改变会员的锁定状态
		function updateMembers(type,value){
			var tablename = $("#tablename").val();
			// 都哪些被勾选啦
			var checked_ids_arr = [];
			var checked_ids = '';
			for (i = 0; i < subcheckboxs.length; i++) {
				if ($(subcheckboxs[i]).prop('checked')) {
					var id = $(subcheckboxs[i]).val();
					checked_ids_arr.push(id);
				}
			}
			if(checked_ids_arr.length > 0){
				checked_ids = checked_ids_arr.join(',');
				$.ajax({
					url : "<?php echo site_url('staff/updateMembers');?>",
					type : 'post',
					dataType : 'json',
					data : {'userids':checked_ids,'type':type,'value':value,'tablename':tablename},
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