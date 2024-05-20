<!DOCTYPE html>
<html>
<head>
	<title>票商中心管理系统 | 询价单详情</title>
	<?php $this ->load -> view('common/top'); ?>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/clipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>jQuery/jquery-ui.min.js"></script>
        <link href="<?php echo CRM_STATIC_PATH; ?>css/inquiry.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CRM_STATIC_PATH; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
	<?php $this ->load -> view('common/header'); ?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this ->load -> view('common/left'); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>询价单详情</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li><a href="<?php echo site_url('inquiry/index');?>">询价单管理</a></li>
				<li class="active">询价单详情</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			    <div class="admin_list w-m"  >
                                <div  style="margin-top:30px;">
                                    <!--客户信息-->
                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry clearfix">
                                            <h4 class="list-group-item-heading w7">
                                                <strong>客户信息</strong>
                                                <p class="list-group-item-text w6">
                                                    <span class="label_info">询价单号：</span>
                                                    <span><?php echo $inquiryinfo['inquirycode']; ?> <button class="btn btn-default btn-xs copy" data-clipboard-text="<?php echo $inquiryinfo['inquirycode']; ?>">复制</button></span>
                                                    <span class="label_info" style="margin-left:10px;">询价时间：</span>
                                                    <span><?php echo $inquiryinfo['addtime'];?> </span>
                                                    <?php if(!empty($inquiryinfo['offtertime'])) :?>
                                                        <span class="label_info" style="margin-left:10px;">报价时间：</span>
                                                        <span><?php echo date('Y-m-d H:i:s' , $inquiryinfo['offtertime']); ?></span>
                                                    <?php endif; ?>
                                                </p>
                                            </h4>
                                            <div class="fl">
                                                <p class="list-group-item-text w3">
                                                    <span class="label_info">收货人：</span>
                                                    <span>
                                                        <?php if(!empty($memberInfo['shippingname'])) :?>
                                                            <?php echo $memberInfo['shippingname'];?>
                                                        <?php else:?>
                                                            <?php echo empty($memberInfo['realname']) ? '未填写' : $memberInfo['realname'];?>
                                                        <?php endif;?>
                                                    </span>
                                                </p>
                                                <?php if(!empty($memberInfo['realname'])) :?>
                                                    <p class="list-group-item-text w3">
                                                        <span class="label_info">门店名：</span>
                                                        <span><?php echo empty($memberInfo['realname']) ? (empty($memberInfo['realname'])?'不详':$memberInfo['realname']) : $memberInfo['realname'];?></span>
                                                    </p>
                                                <?php endif;?>

                                                <p class="list-group-item-text">
                                                    <span class="label_info">联系方式：</span>
                                                    <span>
                                                        <?php if(!empty($memberInfo['shippingphone'])) :?>
                                                            <?php echo $memberInfo['shippingphone'];?>
                                                        <?php else:?>
                                                            <?php echo empty($memberInfo['mobile']) ? '未填写' : $memberInfo['mobile'];?>
                                                        <?php endif;?>
                                                    </span>
                                                </p>
                                                <p class="list-group-item-text">
                                                    <span class="label_info">收货地址：</span>
                                                    <span>
                                                        <?php if(!empty($memberInfo['shippingaddress'])) :?>
                                                            <?php echo $memberInfo['shippingaddress'];?>
                                                        <?php else:?>
                                                            <?php echo "为填写收货地址"; ?>
                                                        <?php endif?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="fr w10">
                                                <p class="list-group-item-text">
                                                    <span>共<span style="color:red; margin:auto 5px; font-size:16px;"><?php echo count($inquiryinfo['parts']);?></span>个配件 </span>
                                                </p>
                                                <p class="list-group-item-text w8">
                                                    <span><?php echo $inquiryinfo['statusstring'];?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry">
                                            <h4 class="list-group-item-heading"><strong>车型信息</strong></h4>
                                            <p class="list-group-item-text">
                                                <span>
                                                    <?php echo $inquiryinfo['carmodel'];?>
                                                    <?php if(!empty($inquiryinfo['vincode'])) :?>
                                                    (车架号: <?php echo $inquiryinfo['vincode']; ?> <button class="btn btn-default copy" data-clipboard-text="<?php echo $inquiryinfo['vincode']; ?>">复制</button>)
                                                    <?php endif;?>
                                                </span>
                                            </p>

                                        </div>
                                    </div>

                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry">
                                            <h4 class="list-group-item-heading"><strong>配件列表</strong></h4>
                                            <table class="table table-hover table-bordered w20">
                                                <tr class="title">
                                                    <th width="2%">序</th>
                                                    <th width="15%">供应商</th>
                                                    <th width="20%">配件名称</th>
                                                    <th width="10%">OE</th>
                                                    <th width="5%">品质</th>
                                                    <th width="10%">品牌名</th>
                                                    <th width="10%">备注</th>
                                                    <th width="5%">数量</th>
                                                    <th width="5%">库存</th>
                                                    <th width="5%">单价</th>
                                                    <th width="10%">报价速度</th>
                                                </tr>
                                                <?php foreach ($inquiryinfo['parts'] as $ipkey=>$ipval) :?>
                                                    <tr class="w18">
                                                        <td><?php echo ($ipkey+1);?></td>
                                                        <td></td>
                                                        <td><?php echo $ipval['partname'];?></td>
                                                        <td><?php echo $ipval['oecode'];?></td>
                                                        <td><?php echo $ipval['partquality'];?></td>
                                                        <td></td>
                                                        <td><?php echo $ipval['remark'];?></td>
                                                        <td><?php echo $ipval['number'];?></td>
                                                        <td></td>
                                                        <td style="color: #dd4b39;"></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php foreach($competeparts as $ctpkey=>$ctpval) :?>
                                                    <!--<volist name="part['offerPart']" id="offerCompany" key="i">-->
                                                    <?php if(!empty($ctpval[$ipval['partid']])):?>
                                                    <?php foreach($ctpval[$ipval['partid']]as $ctpipptkey=>$ctpipptval):?>
                                                            <tr>
                                                                <td></td>
                                                                <!--<if condition="$i eq 1">-->
                                                                <!--<td <if condition="!empty(count($competeparts[$ctpkey]['partid']))"> rowspan="{:count(count($competeparts[$ctpkey]['partid']))}"</if>>{$offerCompany['company_name']}{:count($offerCompany['parts'])}</td>-->
                                                                <!--</if>-->
                                                                <td><?php echo empty($companyinfo[$ctpkey]['realname']) ? '' :$companyinfo[$ctpkey]['realname']; ?></td>
                                                                <td><?php echo $ctpipptval['partname'] ;?></td>
                                                                <td><?php echo $ctpipptval['oecode'] ;?></td>
                                                                <td><?php echo $ctpipptval['partquality'] ;?></td>
                                                                <td><?php echo $ctpipptval['partbrand'] ;?></td>
                                                                <td><?php echo $ctpipptval['remark'] ;?></td>
                                                                <td></td>
                                                                <td><?php if($ctpipptval['stock_type']==1){echo '现货';}else{ echo '订货:'.$ctpipptval['order_day'].'天';}?></td>
                                                                <td style="color: #dd4b39;">¥<?php echo $ctpipptval['partprice'] ;?></td>
                                                                <td><?php echo showDiffTime($inquiryinfo['inquiryaddtime'], $ctpipptval['addtime']);?></td>
                                                            </tr>
                                                            <?php endforeach;?>
                                                            <?php else :?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?php echo empty($companyinfo[$ctpkey]['realname']) ? '' :$companyinfo[$ctpkey]['realname']; ?></td>
                                                                <!--<td <if condition="!empty(count($offerCompany['parts']))"> rowspan="{:count($offerCompany['parts'])}"</if>>{$offerCompany['company_name']}</td>-->
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>待报价</td>
                                                            </tr>
                                                        <?php endif;?>
                                                        <?php endforeach;?>
                                               <?php endforeach;?>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="text-align: center; margin:30px;">
                                        <a href="javascript:history.back();" class="btn btn-default btn-flat w5" >返回</a>
                                    </div>

                                </div>

                            </div>
		</section>
	</div>
	<!-- /.content-wrapper -->
	<?php $this ->load -> view('common/footer'); ?>
</body>
<script>
    $(function(){
        var clipboard = new Clipboard('.copy');

        clipboard.on('success', function(e) {
            alert('复制成功');
        });

        clipboard.on('error', function(e) {
            alert('该浏览器不支持此复制功能，请手动选择复制');
        });
    });

</script>
</html>