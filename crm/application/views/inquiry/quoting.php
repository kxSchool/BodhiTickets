<!DOCTYPE html>
<html>
<head>
	<title>票商中心管理系统 | 处理询价单</title>
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
			<h1>处理询价单</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li><a href="<?php echo site_url('inquiry/index');?>">询价单管理</a></li>
				<li class="active">处理询价单</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			    <div class="admin_list w-m"  >
                                <div  style="margin-top:30px;">
                                    <!--客户信息-->
                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry clearfix">
                                            <h4 class="list-group-item-heading"><strong>客户信息</strong></h4>
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
                                                    <span>共<span style="color:red; margin:auto 5px; font-size:16px;"><?php echo count($inquiryinfo['parts']); ?></span>个配件 </span>
                                                </p>
                                                <p class="list-group-item-text">
                                                    <span style="color:#00b7ee; font-size:24px;"><?php echo $inquiryinfo['statusstring'];?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry">
                                            <h4 class="list-group-item-heading"><strong>车型信息</strong></h4>

                                            <p class="list-group-item-text">
                                                <span>
                                                    <?php echo $inquiryinfo['carmodel']; ?>
                                                    <?php if(!empty($inquiryinfo['vincode'])) :?>
                                                        (车架号: <?php echo $inquiryinfo['vincode']; ?>
                                                        <button class="btn btn-default copy" data-clipboard-text="<?php echo $inquiryinfo['vincode'];?>">复制</button>)
                                                    <?php endif; ?>
                                                </span>
                                            </p>

                                        </div>
                                    </div>

                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry">
                                            <h4 class="list-group-item-heading"><strong>配件列表</strong></h4>
                                            <table class="table table-hover table-bordered w13">
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
                                                    <tr style="background-color: #f6fcfe;">
                                                        <td><?php echo ($ipkey+1); ?></td>
                                                        <td></td>
                                                        <td><?php echo $ipval['partname']; ?></td>
                                                        <td><?php echo $ipval['oecode']; ?></td>
                                                        <td><?php echo $ipval['partquality']; ?></td>
                                                        <td></td>
                                                        <td><?php echo $ipval['remark']; ?></td>
                                                        <td><?php echo $ipval['number']; ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php foreach($competeparts as $ctpkey=>$ctpval) :?>
                                                        <?php if(!empty($ctpval[$ipval['partid']])):?>
                                                    <?php foreach($ctpval[$ipval['partid']]as $ctpipptkey=>$ctpipptval):?>
                                                                <tr>
                                                                    <td></td>
<!--                                                                    <if condition="$i eq 1">
                                                                        <td rowspan="{:count($offerCompany['parts'])}">{$offerCompany['company_name']}</td>
                                                                    </if>-->
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
                                                                <!--<td <if condition="!empty(count($offerCompany['parts']))">rowspan="{:count($offerCompany['parts'])}"</if>>{$offerCompany['company_name']}</td>-->
                                                                <td><?php echo empty($companyinfo[$ctpkey]['realname']) ? '' :$companyinfo[$ctpkey]['realname']; ?></td>
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
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="list-group col-md-12 clearfix o-p-r">
                                        <div class="list-group-item o-height add-inquiry">
                                            <h4 class="list-group-item-heading"><strong>供应商信息</strong></h4>
                                            <table class="table table-hover table-bordered">
                                                <input type="hidden" name="inquirycode" value="<?php echo $inquiryinfo['inquirycode']; ?>" />
                                                <?php if(!empty($companyinfo)):?>
                                                <?php foreach($companyinfo as $cinkey=>$cinval):?>
                                                    <tr>
                                                        <td width="250">
                                                            <input type="hidden" name="iqrid" value="<?php echo empty($cinval['info']['iqrid'])? 0 : $cinval['info']['iqrid']; ?>" />
                                                            <input type="radio" name="batchcode" style="margin-right:4px;" value="<?php echo !empty($cinval['info']['batchcode']) ? $cinval['info']['batchcode'] : '' ?>" <?php echo empty($cinval['info']['batchcode']) ? 'disabled="true"' : '';?> /><?php echo $cinval['realname'];?>
                                                        </td>

                                                        <td width="200">
                                                            <?php if(empty($cinval['info'])) :?>
                                                                待报价
                                                            <?php else:?>
                                                                <?php echo $cinval['info']['offerspeed'];?>
                                                            <?php endif;?>
                                                        </td>

                                                        <td>
                                                            <?php if(!empty($cinval['info']['carmodel'])) :?>
                                                                <p class="list-group-item-text w16"><?php echo $cinval['info']['carmodel'];?></p>
                                                            <?php endif;?>
                                                            <?php if(!empty($cinval['info'])) :?>
                                                                <p class="list-group-item-text w15">
                                                                    <span>现货：<?php echo $cinval['info']['xianhuo'];?> |  预定：<?php echo $cinval['info']['xianhuo'];?>|</span>
                                                                    <span>
                                                                        (
                                                                        <!--<volist name="data['shipping_fee'][$key]" id="shipping">-->
                                                                             <!--{:shippingTypeToText($shipping['type'])} : {$shipping['shipping_fee']}-->
                                                                             <?php echo !empty($cinval['info']['shippinginfo']) ? $cinval['info']['shippinginfo'] : '运费情况请联系供货商!' ;?>
                                                                        <!--</volist>-->
                                                                        )
                                                                    </span>

                                                                </p>
                                                            <?php endif;?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                                <?php endif;?>
                                            </table>
                                        </div>
                                    </div>

                                    <div style="text-align: center; margin:30px;">
                                        <button class="btn btn-primary btn-flat quoting w5" >报价</button>
                                    </div>

                                </div>
                            </div>
		</section><!-- /.content -->
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
        
        
        $("button.quoting").click(function(){
           if ($("input[name='batchcode']:checked").size()<1 ) {
               $("#dialog>p").html("请选择供应商报价");
               $("#dialog").dialog({
                   autoOpen: true,
                   title:'提示',
                   resizable: true,
                   modal: true,
                   zIndex: 999,
                   buttons: {
                       '确定': function () {
                           $(this).dialog("close");
                       }
                   }
               });
           } else {
               $.ajax({
                   type: "POST",
                   url: "<?php echo site_url('inquiry/ajaxQuoting');?>",
                   dataType: "json",
                   data: {
                        'inquirycode':$("input[name='inquirycode']").val(),
                        'iqrid':$("input[name='iqrid']").val(),
                        'batchcode':$("input[name='batchcode']:checked").val()
                    },
                   success: function(json){
                       if (json.success==1) {
                           window.location.href = "<?php echo site_url('inquiry/offerdetail');?>?inquirycode="+$("input[name='inquirycode']").val();
                       } else {
                           $("#dialog>p").html(json.data);
                           $("#dialog").dialog({
                               autoOpen: true,
                               title:'提示',
                               resizable: true,
                               modal: true,
                               zIndex: 999,
                               buttons: {
                                   '确定': function () {
                                       $(this).dialog("close");
                                   }
                               }
                           });
                       }

                   }
               })
           }
        });
        
    });

</script>
</html>