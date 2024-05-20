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
		<h1>演出分类管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">演出分类管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<a type="button" class="btn btn-success" href="<?php echo site_url('TicketsCategory/category_add');?>"><span class="glyphicon glyphicon-plus"></span> 创建演出分类</a>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
							<tr>
								<th>ID</th>
								<th>分类</th>
								<th>父类ID</th>
<!--                                <th>品牌管理</th>-->
								<th>权重(排序)</th>
								<th>操作管理</th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($showcategory) && !empty($showcategory)):?>
								<?php foreach($showcategory as $v):?>
									<tr>
										<td><?php echo $v['cat_id'];?></td>
										<?php
										$nbsp = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$v['level']);
										?>
										<td> <span><?php echo $nbsp;?><?php echo $v['spacer'];?></span><?php echo $v['cat_name'];?></td>
										<td><?php echo $v['cat_pid'];?></td>
<!--										<td><a class="btn btn-sm btn-info" href="javascript:showManager(--><?php //echo $v['id'];?><!--);">关联品牌</a></td>-->
										<td><?php echo $v['cat_desc'];?></td>
                                        <td>
											<a class="btn btn-sm btn-info" href="<?php echo site_url('TicketsCategory/category_edit');?>?categoryid=<?php echo $v['id'];?>">编辑</a>
<!--											<a class="btn btn-sm btn-danger" href="javascript:delcategory(--><?php //echo $v['id'];?><!--);">删除</a>-->
											<!--关联品牌-->
											<?php if(isset($catids) && !empty($catids)):?>
											<?php if(in_array($v['cat_id'],$catids)):?>
											<a class="btn btn-sm btn-info" href="<?php echo site_url('TicketsCategory/categoryShow');?>?categoryid=<?php echo $v['id'];?>">关联表演</a>
											<?php endif;?>
											<?php endif;?>
											
										</td>
									</tr>
								<?php endforeach;?>
							<?php endif;?>
							</tbody>
						</table>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
        $(document).on("change", "input[name='showcheckorcancle']",function(){
            checkeds();
        });
        function checkeds() {
            var checkBoxAll = $("input[name='showcheckorcancle']").length;
            var checkLength = $("input[name='showcheckorcancle']:checked").length;
            $("#showcheckall").prop("checked", checkBoxAll == checkLength ? true : false);
        }
        
        $(document).on("click", "input[name='showcheckall']", function() {
            var oSwitch = $(this).is(':checked');
            $('input[name="showcheckorcancle"]').prop("checked", oSwitch);
        });
        
        $(document).on("click","input[name='showconfirm']", function() {
            var categoryid = $(this).attr('categoryid');
            var relative = $(this).attr('relative');
            var existshow = $(this).attr('existshow');
            var showid = '';
            $.each($("input[name='showcheckorcancle']:checked"),function(){
                showid += $(this).val()+",";
            });
            if(showid == ''){
                layer.alert('请选择品牌或者关闭弹窗!',{icon: 5});
                return;
            }
            if(existshow == showid){
                layer.alert('数据未做修改,请确认!否则请关闭弹窗!',{icon: 5});
                return;
            }
            $.ajax({
                url : '<?php echo site_url('TicketsCategory/setShow');?>',
                type : 'post',
                dataType : 'json',
                data : {
                    'categoryid': categoryid,
                    'showids' : showid,
                    'relative' : relative,
                },
                success:function(data){
                    if(data.info == 1){
                        layer.closeAll();
                    }else{
                        layer.alert(data.tip, {icon: 5});
                    }
                }
            });
        });
        
        function showManager(categoryid){
            $.ajax({
                url : '<?php echo site_url('TicketsCategory/getShow');?>',
                type : 'post',
                dataType : 'json',
                data : {
                    'categoryid' : categoryid,
                },
                success:function(data){
                        if(data.info == 1){
                            var content = '<table><tr><td>'
                                    +'<input id="showcheckall" name="showcheckall" value="" type="checkbox"><label for="checkAll"><span>全选</span></label>'
                                    + '</td></tr><tr><td>';
                            var lineflag = 0;
                            $.each(data.tip,function(i,val){
                                content += '<input type="checkbox" name="showcheckorcancle" value="'
                                        +val.id+'" '+val.selected+'/>'+val.name+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                if(lineflag==3){
                                    content += '<br>';
                                    lineflag=0;
                                }else{
                                    lineflag++;
                                }
                            });
                            content += '<td></tr></table>'
                                    +'<input style="position:fixed;bottom:10%;left:25%;" categoryid="'+categoryid+'" relative="'
                                    +data.relative+'" name="showconfirm" existshow="'
                                    +data.existshow+'" value="提交关联品牌" type="button">';
                            layer.open({ 
                                type: 1 ,//Page层类型 
                                area: ['300px', '300px'] ,
                                title: '选择或者取消品牌' ,
                                shade: 0.6 , //遮罩透明度
                                maxmin: false , //允许全屏最小化
                                anim: 5 , //0-6的动画形式，-1不开启
                                content: '<div style="padding:20px;">'+content+'</div>' 
                            });
                        }else{
                            layer.alert(data.tip, {icon: 5});
                        }
                }
            });
        }
	/**删除分类**/
	function delcategory(categoryid){
		layer.confirm('确认要删除该条记录吗？', {
			btn: ['确认','取消'] //按钮
		}, 
                function(){
			$.ajax({
				url : '<?php echo site_url('TicketsCategory/category_del');?>',
				type : 'post',
				dataType : 'json',
				data : {'categoryid':categoryid},
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