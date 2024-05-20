<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 表演管理</title>
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
		<h1>表演管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">表演管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('show/show_add');?>"><span class="glyphicon glyphicon-plus"></span> 创建表演</a>
						<div class="pull-right">
							<form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('show/manage');?>">
								<div class="form-group">
									<select name="show_select" data-placeholder="选择表演" style="width:500px;" id="show_select" class="show_select" >
									</select>
									<input type="hidden"  id = 'showselected' value="<?php if(isset($show_select)):?><?php echo $show_select;?><?php endif;?>">
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
									<th>ID</th>
									<th>表演海报 </th>
									<th>表演名称 </th>
                                    <th>上架状态 </th>
									<th>操作管理</th>
								</tr>
								</thead>
								<tbody>
								<?php if(isset($datas) && !empty($datas)):?>
								<?php foreach($datas as $v):?>
								<tr>
									<td><?php echo $v['id'];?></td>
									<td align="center"><?php if(!empty($v['logoimg'])):;?><img src="<?php echo $v['logoimg'];?>" style="height:80px;vertical-align:middle;"><?php else:?>暂无Logo<?php endif;?></td>
									<td><?php echo $v['name'];?></td>
                                    <td><input type="checkbox" name="onoffswitchcategory" showid="<?php echo $v['id'];?>" value="<?php echo $v['ismenu'];?>" <?php if($v['ismenu'] == 1):?>checked<?php endif;?> /></td>
									<td>
										<a class="btn btn-sm btn-info" href="<?php echo site_url('show/show_edit');?>?id=<?php echo $v['id'];?>">编辑</a>
<!--									<a class="btn btn-sm btn-danger" href="javascript:delShow(--><?php //echo $v['id'];?><!--);">删除</a>-->
										<a class="btn btn-sm btn-info" href="<?php echo site_url('show/show_category');?>?id=<?php echo $v['id'];?>">关联分类</a>
                                        <a class="btn btn-sm btn-info" href="<?php echo site_url('map/manage');?>?show_id=<?php echo $v['id'];?>">添加座位图</a>
                                        <a class="btn btn-sm btn-info" href="<?php echo site_url('event/manage');?>?show_id=<?php echo $v['id'];?>">添加场次</a>
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
	$(function(){
		$("option").click(function(){
			$('.show_select').removeAttr("size");
			$('.show_select').blur();
			this.attr("selected","");
		});

		$('.show_select').focus(function(){
			$('.show_select').attr("size","5");
		})


		$('.show_select').empty();
		$('.show_select').append("<option value=''>选择表演</option>");
		$.ajax({
			url : '<?php echo site_url('show/getAllShows');?>',
			type : 'post',
			dataType : 'json',
			data : {},
			success:function(data){
				if(data.info == 1){
					var opts = "";
					var shows = data.shows;
					for(var i=0;i<shows.length;i++){
						opts += "<option value='" + data.shows[i] + "' >" + data.shows[i] + "</option>";
					}
					$('.show_select').append(opts);
					var showselected = $("#showselected").val();
					if(showselected.length > 0){
						$(".show_select option[value='"+showselected+"']").prop("selected","selected");
					}
					$('.show_select').trigger("chosen:updated");
				}else{
					layer.alert(data.tip, {icon: 5});
				}
			}
		});

		$('.show_select').chosen({
			no_results_text : "未找到匹配的表演：",
			search_contains: true,
			disable_search_threshold: 10,
			max_selected_options: 5
		});




		$('.show_select').chosen().change(function(){
			//这个改变是选择的值变动之后才触发的回调
		});



	});
    //表演关闭开启操作
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
			var showid = this.getAttribute('showid');
			$.ajax({
				url : "<?php echo site_url('show/ismenuShow');?>",
				type : 'post',
				dataType : 'json',
				data : {'showid':showid,'ismenu':ismenuvalue},
				success:function(data){
					if(data.info != 1){
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		});
        
	/**删除品牌**/
	function delShow(id){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(){
			$.ajax({
				url : '<?php echo site_url('show/show_del');?>',
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