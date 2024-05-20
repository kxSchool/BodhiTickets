<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>票商中心管理系统 | 询价单管理</title>
<?php $this -> load -> view('common/top'); ?>
<link rel="stylesheet" href="<?php echo CRM_STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.css" />
<script src="<?php echo CRM_STATIC_PATH; ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/clipboard.min.js"></script>
<script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>jQuery/jquery-ui.min.js"></script>
<link href="<?php echo CRM_STATIC_PATH; ?>css/inquiry.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CRM_STATIC_PATH; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
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
		<h1>询价单管理</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li class="active">询价单管理</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
                                    <div class="box-header with-border" style="padding-left: 20px;">
                                            <div class="pull-left" style="">
                                                <div class="form-group pull-left">
                                                    <a href="<?php echo site_url('inquiry/add');?>" class="btn btn-primary btn-flat btn-ws" role="button">
                                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>询价开单
                                                    </a>
                                                </div>
                                                <div class="form-group pull-right">
                                                <form id="searchNewsForm" class="form-inline" method="post" action="<?php echo site_url('inquiry/index');?>">
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
					</div>
                                        <div class="box-body table-responsive no-padding" style="margin-right: 12px;">
                                <?php if(!empty($lists)):?>
                                <?php foreach($lists as $list): ?>
                                <table class="table table-bordered"  style="margin-bottom: 16px;background: #fff;">
                                    <tr>
                                        <td colspan="6" class="orderId" <?php echo inquiryStatusBgColor($list['status'],($list['addtime']+2*24*3600))?>>
                                            <span class="order_left">询价单号：<span><?php echo $list['inquirycode']?></span> <button class="btn btn-default btn-xs copy" data-clipboard-text="<?php echo $list['inquirycode']?>">复制</button></span>
                                            <?php if(!empty($list['vincode'])):?>
                                            <span class="order_left">
                                                车架号：
                                                <span class="vincode"><?php  echo $list['vincode'];?></span>
                                                <button class="btn btn-default btn-xs copy" data-clipboard-text="<?php  echo $list['vincode'];?>">复制</button></span>
                                            </span>
                                            <?php endif; ?>
                                            <span class="order_left w2"><?php echo $list['carmodel']?></span>
                                            <?php if($list['status']==2):?>
                                                <span class="order_right" >
                                                    <a href="<?php echo site_url('inquiry/offerdetail');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-info btn-flat btn-ws" role="button" title="报价单" >报价单</a>
                                                </span>
                                            <?php endif; ?>
                                            <?php if($list['status']!=3 && (time()<=$list['addtime']+2*24*3600)):?>
                                            <span class="order_right" >
                                                <button class="btn btn-info btn-flat zuofei btn-ws" data-inquirycode="<?php echo $list['inquirycode'];?>" role="button" title="作废" >作废</button>
                                            </span>
                                            <?php endif;?>
                                            <?php if($list['status']!=4):?>
                                                <span class="order_right">
                                                    <?php if($list['status']==2):?>
                                                        <a href="<?php echo site_url('inquiry/detail');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-default btn-flat btn-ws" role="button" title="原始单" >原始单</a>
                                                    <?php else :?>
                                                        <a href="<?php echo site_url('inquiry/detail');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-default btn-flat btn-ws" role="button" title="查看" style="padding: 3px 12px;">查看</a>
                                                    <?php endif;?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if($list['status'] ==4):?>
                                            <span class="order_right" >
                                                <a href="<?php echo site_url('inquiry/quoting');?>?inquirycode=<?php echo $list['inquirycode'];?>" class="btn btn-primary btn-flat btn-ws" role="button" title="去处理" >去处理</a>
                                            </span>
                                            <?php endif; ?>
                                            <span class="order_right" >
                                                <b><?php echo date('Y-m-d',$list['addtime']);?></b>｜
                                                <b><?php echo $list['sourcefrom'];?></b>｜
                                                <b><?php echo $list['statusstring'];?></b>
                                            </span>
                                            <div class="clear"></div>
                                    </tr>
                                    <?php if(!empty($list['parts'])):?>
                                    <tr>
                                        <th width="20%">配件名称</th>
                                        <th width="15%">OE</th>
                                        <th width="10%">质量要求</th>
                                        <th width="5%">数量</th>
                                        <th>备注</th>
                                    </tr>
                                    <?php foreach ($list['parts'] as $key => $part) :?>
                                        <tr>
                                            <td><?php echo empty($part['partname'])?'':$part['partname']; ?></td>
                                            <td><?php echo empty($part['oecode'])?'':$part['oecode']; ?></td>
                                            <td><?php echo empty($part['partquality'])?'':$part['partquality']; ?></td>
                                            <td><?php echo empty($part['number'])?'':$part['number']; ?></td>
                                            <td><?php echo empty($part['remark'])?'':$part['remark']; ?></td>
                                        </tr>
                                    <?php endforeach;?>
                                   <?php endif;?>
                                </table>
                            <?php endforeach;?>
                         <?php else:?>
                            <table class="table table-hover" style="margin-top:30px;">
                                <tr><td colspan="6" style="color:red; text-align: center;">暂时无数据</td></tr>
                            </table>
                        <?php endif;?>
                    </div>
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
<div id="dialog" title="" style="display:none;">
    <p></p>
</div>

<div id="zuofei" style="display:none;" title="作废此价单" >
    <div class="">
        <form action="javascript:void(0);" method="post" class="form-horizontal zuofeiForm">
            <a href="javascript:void(0);" style="color:red;padding-top:10px;display:block;text-decoration:none;">作废后将无法恢复，请谨慎选择！</a>
            <br/>
            <div class="form-group">
                <label  class="col-sm-2 control-label" style="text-align:left;padding-top: 5px;">原因：</label>
                <div class="col-sm-10">
                    <input type="text" name="cancel_reason" class="form-control" placeholder="请输入作废原因，25个字以内" maxlength="25" style="margin-left: -40px;">
                </div>
            </div>
            <div class="zuofei_error" style="display:none;color:red;" ></div>
        </form>
    </div>
</div>
<script>
$(function(){
        $(".zuofei").click(function(){
            $(".zuofei_error").empty("").hide();
            var inquirycode = $(this).attr("data-inquirycode");
            var cancelreason = $("#zuofei input[name='cancel_reason']").val();
            $("#zuofei").dialog({
                autoOpen: true,
                title:'询价单作废',
                resizable: true,
                modal: true,
                zIndex: 99999,
                minWidth:600,
                buttons: {
                    '确定': function () {
                        $(".zuofei_error").empty("").hide();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('inquiry/ajaxCancel');?>",
                            dataType: "json",
                            data: {
                                'inquirycode':inquirycode,
                                'cancelreason':cancelreason
                            },
                            success: function(result) {
                                if (result.success == 1) {
                                    window.location.href = "<?php echo site_url('inquiry/index');?>?inquirystatus=3";
                                } else {
                                    $(".zuofei_error").html("操作失败").show();
                                }
                            }
                        });
                    },
                    '取消': function () {
                        $(this).dialog("close");
                    }
                }
            });
        });

        
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