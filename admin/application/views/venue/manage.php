<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 车型管理</title>
<script type="text/javascript" src="<?php echo $this->config->item('cityJson_url') ;?>"></script>
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
		<h1>场馆管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">场馆管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<div class="pull-left">
							<a type="button" class="btn btn-success" href="<?php echo site_url('venue/addVenues');?>"><span class="glyphicon glyphicon-plus">创建场馆</a>
						</div>
						<div class="pull-right">
							<form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('venue/manage');?>">
								<div class="form-group">
									<select class="form-control" name="fields" id="fields">
										<option value="0">==选择栏目==</option>
										<option value="venue_name"  <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'venue_name'):?>selected<?php endif;?><?php endif;?>>名称</option>
										<option value="Province"  <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'Province'):?>selected<?php endif;?><?php endif;?>>省份</option>
										<option value="City" <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'City'):?>selected<?php endif;?><?php endif;?>>城市</option>
										<option value="Village" <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'address'):?>selected<?php endif;?><?php endif;?>>县区</option>
										<option value="address"  <?php if(isset($fields) && !empty($fields)):?><?php if($fields == 'address'):?>selected<?php endif;?><?php endif;?>>地址</option>
									</select>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="search" id="search" placeholder="输入搜索内容..." value="<?php if(isset($search) && !empty($search)):?><?php echo $search;?><?php endif;?>"/>
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
                                <th>海报</th>
								<th>场馆名称</th>
								<th>省</th>
                                <th>市</th>
                                <th>县（区）</th>
								<th>地址</th>
								<th>操作</th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($datas)):?>
							<?php foreach($datas as $v):?>
							<tr class="region" province="<?php echo $v['province'];?>" city="<?php echo $v['city'];?>" village="<?php echo $v['village'];?>">
								<td><?php echo $v['id'];?></td>
                                <td><?php if(!empty($v['picname'])):;?><img src="<?php echo $v['picname'];?>" style="height:80px;vertical-align:middle;"><?php else:?>暂无Logo<?php endif;?></td>
								<td><?php echo $v['venue_name'];?></td>
								<td><div class="province"></div></td>
								<td><div class="city"><?php echo $v['city'];?></div></td>
								<td><div class="village"><?php echo $v['village'];?></div></td>
								<td><?php echo $v['address'];?></td>
								<td>
									<a class="btn btn-sm btn-info" href="<?php echo site_url('venue/editVenue');?>?id=<?php echo $v['id'];?>">编辑</a>
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
<script>
$(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%' // optional
	});
    
    $(".region").each(function () {
            pid=$(this).attr("province");
            cid=$(this).attr("city");
            vid=$(this).attr("village");
            var provincex=$(this).children('td').children(".province");
            var cityx=$(this).children('td').children(".city");
            var villagex=$(this).children('td').children(".village");
           
            $.each(province, function (i, item) {
                if (pid==item.id){
                    provincex.text(item.name);
                    $.each(item.city, function (ix, itemx) {
                        if (cid==itemx.id){
                            cityx.text(itemx.name);
                            $.each(itemx.city, function (iy, itemy) {
                                if (vid==itemy.id){
                                    villagex.text(itemy.name);
                                };
                            })
                        };
                    })
                };
            })
      
            
        
    })        
    
})
    
</script>
</body>
</html>