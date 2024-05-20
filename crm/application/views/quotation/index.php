<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>票商中心管理系统 | 报价单管理</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo CRM_STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.css" />
<script src="<?php echo CRM_STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/clipboard.min.js"></script>
<style>
    .inquirycode{
        margin-right: 15px;
        height: 40px;
        line-height: 40px;
        padding-left: 20px;
    }
</style>
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
		<h1>报价单管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">报价单管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
                                    <div class="box-header with-border" style="padding-left: 20px;">
                                            <div class="pull-left" style="">
                                                <div class="form-group pull-right">
                                                <form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('quation/index');?>">
                                                                <div class="form-group">
                                                                    <label for="inquirycode" class="control-label" style="padding-left: 20px;" >询价单号：</label>
                                                                    <input type="text" class="form-control" name="inquirycode" id="inquirycode" placeholder="询价单号" value="<?php if(isset($inquirycode)):?><?php echo $inquirycode;?><?php endif;?>" />
								</div>
<!--                                                                <div class="form-group">
                                                                    <label for="telphone" class="control-label" style="padding-left: 20px;" >联系电话：</label>
                                                                    <input type="text" class="form-control" name="telphone" id="telphone" placeholder="联系电话" value="<?php //if(isset($telphone)):?><?php //echo $telphone;?><?php //endif;?>" />
								</div>-->
                                                                <div class="form-group">
                                                                    <label for="inquirystatus" class="control-label" style="padding-left: 20px;" >询价单状态：</label>
									<select class="form-control" name="inquirystatus" id="inquirystatus">
                                                                                <option value="0">==选择询价单状态==</option>
										<option value="1" <?php if(isset($inquirystatus) && $inquirystatus == 1):?>selected="selected"<?php endif;?>>==待报价==</option>
										<option value="2" <?php if(isset($inquirystatus) && $inquirystatus == 2):?>selected="selected"<?php endif;?>>==已报价==</option>
                                                                                <option value="3" <?php if(isset($inquirystatus) && $inquirystatus == 3):?>selected="selected"<?php endif;?>>==已作废==</option>
                                                                                <option value="4" <?php if(isset($inquirystatus) && $inquirystatus == 4):?>selected="selected"<?php endif;?>>==已处理==</option>
									</select>
								</div>
<!--                                                                <div class="form-group">
                                                                    <label for="repairname" class="control-label" style="padding-left: 20px;">修理厂：</label>
                                                                    <input type="text" class="form-control" name="repairname" id="repairname" placeholder="修理厂" value="<?php //if(isset($repairname)):?><?php //echo $repairname;?><?php //endif;?>" />
								</div><br>-->
								<div class="form-group">
                                                                    <label for="starttime" class="control-label" style="padding-left: 20px;">日期从：</label>
                                                                    <input type="text" class="form-control" name="starttime" id="starttime" placeholder="询价时间" value="<?php if(isset($starttime)):?><?php echo $starttime;?><?php endif;?>" />
								</div>
								<div class="form-group">
                                                                    <label for="endtime" class="control-label" style="padding-left: 20px;">到：</label>
                                                                    <input type="text" class="form-control" name="endtime" id="endtime" placeholder="询价时间" value="<?php if(isset($endtime)):?><?php echo $endtime;?><?php endif;?>" />
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-info" name="dosearch" value="1" style="padding-left: 20px;">搜索</button>
								</div>
							</form>
                                                </div>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="tables">
                                                    <table class="table table-bordered">
                                                        <?php if(!empty($lists)):?>
                                                        <?php foreach($lists as $list): ?>
                                                        <tr>
                                                            <td colspan="6" style="background-color:#E6F7FE">
                                                            <span class="inquirycode">询价单号：<span><?php echo $list['inquirycode']?></span> <button class="btn btn-default copy" data-clipboard-text="<?php echo $list['inquirycode']?>">复制</button></span>
                                                                <span class="inquirycode"><?php echo$list['carmodel'] ?></span>
                                                                <?php if(!empty($list['vincode'])): ?>
                                                                <span class="inquirycode">
                                                                    车架号：
                                                                    <span class="vincode"><?php echo $list['vincode'] ?></span>
                                                                    <button class="btn btn-default copy" data-clipboard-text="<?php echo $list['vincode'] ?>">复制</button>
                                                                </span>
                                                                <?php endif; ?>   <!--</span>-->

                                                            <?php if($list['status'] == 1):?>
                                                                <span class="inquirycode" >
                                                                    <a href="<?php echo site_url('quation/quoting');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-default" role="button" title="报价单" >去报价</a>
                                                                </span>
                                                            <?php endif;?>
                                                            <?php if($list['status'] != 1):?>
                                                                <span class="inquirycode">
                                                                   <a href="<?php echo site_url('quation/detail');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-default" role="button" title="查看" >查看</a>
                                                                </span>
                                                            <?php endif;?>
                                                            <span class="inquirycode" >
                                                                <b><?php echo $list['addtime'];?></b>｜
                                                                <b><?php echo $list['sourcefrom'];?></b>｜
                                                                <b><?php echo $list['statusstring'];?></b>
                                                            </span>
                                                            <div class="clear"></div>
                                                            </td>
                                                        </tr>
                                                            <tr>
                                                                <th width="20%" style="text-align: center;">配件名称</th>
                                                                <th width="15%" style="text-align: center;">OE</th>
                                                                <th width="10%" style="text-align: center;">质量要求</th>
                                                                <th width="5%" style="text-align: center;">数量</th>
                                                                <th style="text-align: center;">备注</th>
                                                            </tr>
                                                            <?php if(!empty($list['parts'])):?>
                                                            <?php $counts=0 ?>
                                                            <?php foreach($list['parts'] as $ptval) :?>
                                                            <?php if($counts <=2) :?>
                                                            <tr>
                                                                <td style="text-align: center;"><?php echo $ptval['partname'];?></td>
                                                                <td style="text-align: center;"><?php echo $ptval['oecode']; ?></td>
                                                                <td style="text-align: center;"><?php  $ptval['partquality'];?></td>
                                                                <td style="text-align: center;"><?php echo $ptval['number'];?></td>
                                                                <td style="text-align: center;"><?php echo $ptval['remark'];?></td>
                                                            </tr>
                                                            <?php $counts++; endif;?>
                                                            <?php endforeach;?>
                                                            <?php else :?>
                                                            <tr>
                                                                <td colspan="5" style="background-color:#E6F7FE">暂无配件</td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
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
        var clipboard = new Clipboard('.copy');
        clipboard.on('success', function(e) {
            alert('复制成功');
        });

        clipboard.on('error', function(e) {
            alert('该浏览器不支持此复制功能，请手动选择复制');
        });
	$("#starttime").datetimepicker({
		language:  'zh-CN',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	});
	$("#endtime").datetimepicker({
		language:  'zh-CN',
		weekStart: 1,
		todayBtn: 1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	});
})
</script>
</body>
</html>