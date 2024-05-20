<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 标签管理</title>
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
		<h1>标签管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">标签管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('config/addTagCategory');?>"><span class="glyphicon glyphicon-plus"></span> 添加标签分类</a>
					</div><!-- /.box-header -->
					<?php if(isset($tagCategorys) && !empty($tagCategorys)):?>
					<div class="box-body">
						<div class="tables">
							<?php foreach($tagCategorys as $v):?>
							<table class="table table-bordered" style="border:3px solid rgb(236,240,245); padding-bottom:50px;">
								<thead>
								<tr>
									<th>
										<span style="font-size:1.2em;"><?php echo $v['catname'];?></span>
										<button class="btn btn-sm btn-danger pull-right" onclick="delTagCategory(<?php echo $v['catid'];?>);">删除分类</button>
										<button class="btn btn-sm btn-info pull-right" style="margin-right:10px;" onclick="addTag(this);">添加标签</button>
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td id="<?php echo $v['catid'];?>">
										<?php if(isset($v['tags']) && !empty($v['tags'])):?>
										<?php foreach($v['tags'] as $vv):?>
											<div class="pull-left" style="margin:5px;" id="<?php echo $vv['tagid'];?>" >
												<button type="button" class="close" aria-label="Close" style="margin-top:-10px; margin-left:-8px; z-index:100;" onclick="delTag(this);"><span aria-hidden="true">&times;</span></button>
												<input type="text" name="tag" onfocus="focusTag(this)"  onblur="blurTag(this)" class="form-control" style="width:120px; text-align:center;" value="<?php echo $vv['tagname'];?>" />
											</div>
										<?php endforeach;?>
										<?php endif;?>
									</td>
								</tr>
								</tbody>
							</table>
							<?php endforeach;?>
						</div>
					</div>
					<?php endif;?>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
$(function(){
	var oldTagVal = '';
	var newTagValue = '';
});
/**inputtag得到焦点**/
function focusTag(obj){
	oldTagVal = $(obj).val();
}
/**inputtag失去焦点**/
function blurTag(obj){
	newTagValue = $(obj).val();
	if(oldTagVal){//编辑已经存在的标签
		// 假如新旧值不一样且新值不为空的话，就改变标签的值
		if(newTagValue.length > 0 && oldTagVal != newTagValue){
			var tagid = $(obj).parent().attr('id');
			$.ajax({
				url : '<?php echo site_url('config/saveTag');?>',
				type : 'post',
				dataType : 'json',
				data : {'tagid':tagid,'tagname':newTagValue},
				success:function(data){
					if(data.info != 1){
						//更新失败，将值改为原来的值
						$(obj).val(oldTagVal);
						oldTagVal = '';
						newTagValue = '';
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		}else{
			$(obj).val(oldTagVal);
			oldTagVal = '';
			newTagValue = '';
		}
	}else{//保存新标签
		var catid = $(obj).parent().parent().attr('id');
		$.ajax({
			url : '<?php echo site_url('config/saveTag');?>',
			type : 'post',
			dataType : 'json',
			data : {'catid':catid,'tagname':newTagValue},
			success:function(data){
				if(data.info == 1){
					$(obj).parent().attr('id',data.tagid);
				}else{
					//添加新标签失败
					layer.alert(data.tip, {icon: 5});
				}
				oldTagVal = '';
				newTagValue = '';
			}
		});
	}
}
/**添加标签**/
function addTag(obj){
	var template = '';
	template += '<div class="pull-left" style="margin:5px;" id="" >';
	template += '<button type="button" class="close" aria-label="Close" style="margin-top:-10px; margin-left:-8px; z-index:100;" onclick="delTag(this);"><span aria-hidden="true">&times;</span></button>';
	template += '<input type="text" name="tag" onfocus="focusTag(this)"  onblur="blurTag(this)" class="form-control" style="width:120px; text-align:center;" value="" />';
	template += '</div>';
	var appendWhere = $(obj).parent().parent().parent().siblings('tbody').children('tr').children('td');
	appendWhere.append(template);
}
/**删除标签**/
function delTag(obj){
	var tagid = $(obj).parent().attr('id');
	if(tagid){//删除存在的标签
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(index){
			$.ajax({
				url : '<?php echo site_url('config/delTag');?>',
				type : 'post',
				dataType : 'json',
				data : {'tagid':tagid},
				success:function(data){
					if(data.info == 1){
						layer.close(index);
						$(obj).parent().remove();
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		});
	}else{//删除点击添加标签按钮创建的标签，尚未保存的标签
		$(obj).parent().remove();
	}
}
/**删除标签分类**/
function delTagCategory(catid){
	if(catid){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, function(index){
			$.ajax({
				url : '<?php echo site_url('config/delTagCategory');?>',
				type : 'post',
				dataType : 'json',
				data : {'catid':catid},
				success:function(data){
					if(data.info == 1){
						layer.close(index);
					}else{
						layer.alert(data.tip, {icon: 5});
					}
				}
			});
		});
	}else{
		layer.alert('尚未选择要删除的标签分类', {icon: 5});
	}
}
</script>
</body>
</html>