<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>泡米票仓管理系统 | 入驻审核详情</title>
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
			<h1>审核商铺</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li><a href="<?php echo site_url('shopreview/index');?>">入驻审核</a></li>
				<li class="active">审核商铺</li>
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
							<?php if(!empty($userinfo)): ?>
							<form id="theForm" class="form-horizontal" method="post" >
								<div class="form-group">
									<div class="col-sm-2"></div>
									<label class="col-sm-2 control-label">注册手机：</label>
									<input type="hidden" name="userid" value="<?php echo $userinfo['userid'];?>" />
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['mobile']; ?></label>

								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2"></div>
									<label class="col-sm-2 control-label">账号：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['username']; ?></label>

								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['shop_contact'])&&!empty($userinfo['refuse']['shop_contact'])): ?>checked="true"<?php endif; ?> name="shop_contact" value="1"  />通过</div>
									<label class="col-sm-2 control-label">联系人：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['shop_contact']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['contact_number'])&&!empty($userinfo['refuse']['contact_number'])): ?>checked="true"<?php endif; ?> name="contact_number" value="1"  />通过</div>
									<label class="col-sm-2 control-label">联系电话：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['contact_number']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['contact_number'])&&!empty($userinfo['refuse']['realname'])): ?>checked="true"<?php endif; ?> name="realname" value="1"  />通过</div>
									<label class="col-sm-2 control-label">公司名：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['realname']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['shop_address'])&&!empty($userinfo['refuse']['shop_address'])): ?>checked="true"<?php endif; ?> name="shop_address" value="1"  />通过</div>
									<label class="col-sm-2 control-label">公司地址：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo isset($userinfo['city_name'])?$userinfo['city_name']:''; ?><?php echo $userinfo['shop_address']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"></div>
									<label class="col-sm-2 control-label">商铺介绍：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['introduction']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"></div>
									<label class="col-sm-2 control-label">主营业务：</label>
									<label class="col-sm-8 control-label" style="text-align: left;"><?php echo $userinfo['sign']; ?></label>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['shop_image'])&&!empty($userinfo['refuse']['shop_image'])): ?>checked="true"<?php endif; ?>  name="shop_image" value="1"  />通过</div>
									<label class="col-sm-2 control-label">商铺图片：</label>
									<div class="col-sm-8">
										<?php if(isset($userinfo['shop_image'])&& !empty($userinfo['shop_image'])): ?>
											<?php foreach ($userinfo['shop_image'] as $image): ?>
											<p><img style="max-width: 450px;" src="<?php echo $image; ?>"></p>
											<?php endforeach; ?>
										<?php else: ?>
											末上传商铺图片
										<?php endif; ?>
									</div>
								</div>
								<hr/>

								<div class="form-group">
									<div class="col-sm-2" style="text-align: right;"><input type="checkbox" <?php if(isset($userinfo['refuse']['shop_zs'])&&!empty($userinfo['refuse']['shop_zs'])): ?>checked="true"<?php endif; ?> name="shop_zs" value="1"  />通过</div>
									<label class="col-sm-2 control-label">资质证件：</label>
									<div class="col-sm-8">
										<?php if(isset($userinfo['shop_zs'])&& !empty($userinfo['shop_zs'])): ?>
											<?php foreach ($userinfo['shop_zs'] as $image): ?>
												<p><img style="max-width: 450px;" src="<?php echo $image; ?>"></p>
											<?php endforeach; ?>
										<?php else: ?>
											末上传资质证件
										<?php endif; ?>
									</div>
								</div>
								<hr/>

								<div class="col-sm-offset-2">
									<button type="submit" class="btn btn-success allow">通过</button>
									<button type="submit" class="btn btn-success refuse">拒绝</button>
								</div>
							</form>
							<?php else : ?>
								<div>用户信息不存在</div>
							<?php endif; ?>
						</div>
					</div><!-- /.box -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->
	<?php $this -> load -> view('common/footer'); ?>
	<script>
		$(function(){
            $("button.allow").click(function(e){
            	e.preventDefault();
				if($("input:checked").size()<6) {
					layer.alert('审核通过需勾选所有选项', {
						icon: 3,
						skin: 'layer-ext-moon'
					});
					return false;
				}
				$("input.allow").val('请等待…');
				$("input.allow").attr("disabled","disabled");
				var str = '';
				$("input[type='checkbox']").each(function(i,n){
					str += $(n).attr('name')+'=1&'
				});
				str = str+'userid='+$("input[name='userid']").val();
				$.ajax({
					type: "post",
					url: "<?php echo site_url('shopreview/ajax_allow'); ?>" ,
					dataType: 'json',
					data: str,
					success: function (data) {
						if (data.success == 1) {
							$("input.allow").val('通过');
							$("input.allow").removeAttr("disabled");
							window.location.href = "<?php echo site_url('shopreview/index?authority=2'); ?>";
						} else {
							$("input.allow").val('通过');
							$("input.allow").removeAttr("disabled");
							layer.alert(data.msg, {
								icon: 3,
								skin: 'layer-ext-moon'
							});
						}
					},
					error: function () {
						$("input.allow").val('通过');
						$("input.allow").removeAttr("disabled");
					}
				});
			});

			$("button.refuse").click(function(e){
				e.preventDefault();
				if($("input:checked").size()==6) {
					layer.alert('请确定审核失败的项目', {
						icon: 3,
						skin: 'layer-ext-moon'
					});
					return false;
				}
				var str = '';
				$("input[type='checkbox']").each(function(i,n){
					if ($(this).is(":checked")) {
						str += $(this).attr('name')+'=1&'
					} else {
						str += $(this).attr('name')+'=0&'
					}
				});
				str = str+'userid='+$("input[name='userid']").val();

				$.ajax({
					type: "post",
					url: "<?php echo site_url('shopreview/ajax_refuse'); ?>",
					dataType: 'json',
					data: str,
					success: function (data) {
						if (data.success == 1) {
							$("input[type='submit']").val('下一步');
							$("input[type='submit']").removeAttr("disabled");
							window.location.href = "<?php echo site_url('shopreview/index?authority=1'); ?>";
						} else {
							$("input[type='submit']").val('下一步');
							$("input[type='submit']").removeAttr("disabled");
							layer.alert(data.msg, {
								icon: 3,
								skin: 'layer-ext-moon'
							});
						}
					},
					error: function () {
						$("input[type='submit']").val('下一步');
						$("input[type='submit']").removeAttr("disabled");
					}
				});
			})
		});

	</script>
</body>
</html>