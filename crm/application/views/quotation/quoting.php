<!DOCTYPE html>
<html>
<head>
	<title>票商中心管理系统 | 处理询价单</title>
	<?php $this ->load -> view('common/top'); ?>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/clipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>jQuery/jquery-ui.min.js"></script>
        <link href="<?php echo CRM_STATIC_PATH; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CRM_STATIC_PATH; ?>css/common.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CRM_STATIC_PATH; ?>css/inquiry_1.css" rel="stylesheet" type="text/css" />
        
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
                    <div class="admin_list" style="margin-top: -30px;" >
                        <form id="theForm" >
                            <div class="main-form">
                                <input type="hidden" class="form-control" name="inquiry_batchcode" value="<?php echo $inquiryinfo['batchcode'];?>" />
                                <input type="hidden" class="form-control" name="inquirycode" value="<?php echo $inquiryinfo['inquirycode'];?>" />
                                <input type="hidden" class="form-control" name="iqrid" value="<?php echo $inquiryinfo['iqrid'];?>" />
                                <input type="hidden" class="form-control" name="bayerid" value="<?php echo $memberInfo['bayerid'];?>" />
                                <input type="hidden" class="form-control" name="partscount" value="<?php echo count($inquiryinfo['parts']);?>" />
                                <!--<input type="hidden" class="form-control" name="source" value="{$data['inquiryInfo']['source']}" />-->
                                <!--询价单信息-->
                                <div class="list-group col-md-12 clearfix o-p-r">

                                    <div class="list-group-item o-height add-inquiry clearfix">
                                        <!-- <h4 class="list-group-item-heading"><strong>询价单信息</strong></h4> -->
                                        <div class="fl">
                                            <p class="list-group-item-text">
                                                <span class="label_info">询价单号：</span>
                                                <span><?php echo $inquiryinfo['inquirycode'];?> <a class="btn btn-default copy" data-clipboard-text="<?php echo $inquiryinfo['inquirycode'];?>">复制</a></span>
                                                <span class="label_info" style="margin-left:20px;">询价日期：</span>
                                                <span><?php echo $inquiryinfo['addtime'];?></span>
                                            </p>
                                            <p class="list-group-item-text w1">
                                                <strong><?php echo $memberInfo['realname'];?> (<?php echo $memberInfo['shippingaddress'];?>)</strong>
                                            </p>
                                        </div>
                                        <div class="fr">
                                            <p class="list-group-item-text">
                                                <span>共<span style="color:red; margin:auto 5px; font-size:16px;"><?php echo count($inquiryinfo['parts']);?></span>个配件 </span>
                                            </p>
                                            <p class="list-group-item-text w5">
                                                <span><?php echo $inquiryinfo['statusstring'];?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry">
                                        <h4 class="list-group-item-heading"><strong>车型信息</strong></h4>
                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">车型：</span>
                                                <span class="w6">
                                                    <input type="text" class="form-control" name="carmodel" placeholder="车型信息" value="<?php echo empty($inquiryinfo['carmodel'])?'':$inquiryinfo['carmodel'];?>" />
                                                    <!--<button  type="button"  class="btn  btn-info select_car" >选择车型</button>-->
                                                </span>
                                            </p>
<!--                                            <input type="hidden" id="ibrand" name="ibrand" value="{$data['inquiryInfo']['parts'][0]['ibrand']}" autocomplete="off" />
                                            <input type="hidden" id="ifactory" name="ifactory"  value="{$data['inquiryInfo']['parts'][0]['ifactory']}" autocomplete="off" />
                                            <input type="hidden" id="icar" name="icar" value="{$data['inquiryInfo']['parts'][0]['icar']}" autocomplete="off" />
                                            <input type="hidden" id="iyear" name="iyear" value="{$data['inquiryInfo']['parts'][0]['iyear']}" autocomplete="off" />
                                            <input type="hidden" id="imodel" name="imodel" value="{$data['inquiryInfo']['parts'][0]['imodel']}" autocomplete="off" />-->
                                        </div>
                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">车架号：</span>
                                                <span>
                                                   <input type="text" class="form-control" name="vincode" value="<?php echo empty($inquiryinfo['vincode'])?'':$inquiryinfo['vincode'];?>"/>
                                                   <?php if(!empty($inquiryinfo['vincode'])):?>
                                                   <a class="btn btn-default copy" data-clipboard-text="<?php echo $inquiryinfo['vincode'];?>">复制</a>
                                                   <?php endif;?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry table-responsive">
                                        <h4 class="list-group-item-heading"><strong>配件列表</strong></h4>
                                        <table class="table table-hover table-bordered add-part-tab" >
                                            <tr class="title">
                                                <th width="40">序</th>
                                                <th width="150">配件名称</th>
                                                <th width="130">OE</th>
                                                <th width="90" >品质</th>
                                                <th width="90">品牌名</th>
                                                <th width="90">备注</th>
                                                <th width="40">数量</th>
                                                <th width="140">库存</th>
                                                <th width="80">单价</th>
                                                <th width="10%">操作</th>
                                            </tr>
                                            <?php if(!empty($inquiryinfo['parts'])):?>
                                            <?php foreach ($inquiryinfo['parts'] as $ipkey=>$ipval) :?>
                                                <tr class="<?php echo $ipval['partid'];?>" data-key="0" style="background-color: #F2F2F2;">
                                                <td><?php echo ($ipkey+1); ?></td>
                                                <td><?php echo $ipval['partname']; ?></td>
                                                <td><?php echo $ipval['oecode']; ?></td>
                                                <td><?php echo $ipval['partquality']; ?></td>
                                                <td></td>
                                                <td><?php echo $ipval['remark']; ?></td>
                                                <td><?php echo $ipval['number']; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td><button  type="button"  class="btn  btn-info add-part w7" data-prequirement="<?php echo $ipval['partquality'];?>" data-pname="<?php echo $ipval['partname'];?>" data-oecode="<?php echo $ipval['oecode'];?>" data-number="<?php echo $ipval['number']; ?>" data-pid="<?php echo $ipval['partid'];?>" data-ic_id="<?php echo $inquiryinfo['batchcode'];?>" >新增报价</button></td>
                                                </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </table>
                                    </div>
                                </div>

                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry">
                                        <h4 class="list-group-item-heading"><strong>运费设定</strong><span class="w2">(至少选择1种运输方式及运费，多种运输方式将由客户选择)</span></h4>
                                        <table class="table table-hover table-bordered shipping-fee-tab w3" style="table-layout:fixed; max-width:600px; ">
                                            <tr class="title">
                                                <th width="100">A专线物流</th>
                                                <th width="100">B普通物流</th>
                                                <th width="100">C摩的</th>
                                                <th width="100">D快递</th>
                                                <th width="100">X其它</th>
                                            </tr>

                                            <tr>
                                                <td><input class="form-control" type="number" min="1" name="shipping_fee[1]"></td>
                                                <td><input class="form-control" type="number" min="1" name="shipping_fee[2]"></td>
                                                <td><input class="form-control" type="number" min="1" name="shipping_fee[3]"></td>
                                                <td><input class="form-control" type="number" min="1" name="shipping_fee[4]"></td>
                                                <td><input class="form-control" type="number" min="1" name="shipping_fee[5]"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center; margin:30px;"><button  type="button"  class="btn  btn-info btn-lg submit w8" >报价</button> </div>
                        </form>
                    </div>
		</section><!-- /.content -->
	</div>
        <div id="dialog" title="" style="display:none;">
            <p></p>
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
        
        //新增报价
        $(".add-part").click(function(){
            if ($(this).attr('data-source')==1) {
                $(this).attr('disabled',true);
                $(this).hide();
            }
            var pid = $(this).attr('data-pid');
            var dataKey = parseInt($("tr."+pid).last().attr("data-key"))+1;
            var partTr = '<tr class="'+pid+'" data-key="'+dataKey+'">' +
                         '<td></td> ' +
                         '<td><input name="pname['+pid+']['+dataKey+']" class="form-control" value="'+$(this).attr('data-pname')+'" /></td>' +
                         '<td><input name="oecode['+pid+']['+dataKey+']" class="form-control" value="'+$(this).attr('data-oecode')+'" /></td> ' +
                         '<td>' +
                             '<select class="form-control" name="pg_flg['+pid+']['+dataKey+']">' +
                                 '<option value="1">原厂件</option>' +
                                 '<option value="2">同质件</option>' +
                                '<option value="3">品牌件</option>' +
                             '</select>' +
                         '</td>' +
                        '<td><input name="pg_brand['+pid+']['+dataKey+']" class="form-control" value="" /></td> ' +
                        '<td><input name="pg_note['+pid+']['+dataKey+']" class="form-control" value="" /></td> ' +
                        '<td><input name="number['+pid+']['+dataKey+']" type="hidden" value="'+$(this).attr('data-number')+'" />'+$(this).attr('data-number')+'</td> ' +
                        '<td> ' +
                              '<select class="form-control stock_type" style="width:80px;" name="stock_type['+pid+']['+dataKey+']"> ' +
                              '<option value="1">现货</option> ' +
                              '<option value="2">订货</option> ' +
                              '</select> ' +
                              '<span class="order_day"><input name="order_day['+pid+']['+dataKey+']" style="width:40px;" class="form-control" value="" /> 天</span>' +
                        '</td> ' +
                        '<td><input type="number" min="1" name="price['+pid+']['+dataKey+']" class="form-control" value="" /></td> ' +
                        '<td><button  type="button"  class="btn btn-danger remove-part" >删除</button></td>' +
                        '</tr>';
            $("tr."+pid).last().after(partTr);
            $("tr."+pid).last().find("td:eq(3) select option[value='"+ $(this).attr('data-prequirement') +"']").attr("selected", true);
        });

        //删除报价
        $("body").on("click", ".add-part-tab .remove-part", function(){
            if ( $("input[name='source']").val() ==1 ) {
                $("tr."+$(this).parents("tr").attr("class")).find("button.add-part").show();
                $("tr."+$(this).parents("tr").attr("class")).find("button.add-part").removeAttr('disabled');
            }
            $(this).parents("tr").remove();
        });

        $("body").on("blur", "input[type='number']", function(){
            var _this = $(this);
            if (parseInt(_this.val())<0) {
                $("#dialog>p").html("请输入大于零的数值");
                $("#dialog").dialog({
                    autoOpen: true,
                    title:'提示',
                    resizable: true,
                    modal: true,
                    zIndex: 99999,
                    buttons: {
                        '确定': function () {
                            $(this).dialog("close");
                            _this.focus();
                        }
                    }
                });
            }
        });

        $("body").on("change", "select.stock_type", function(){
            if ($(this).val()==1) {
                $(this).next("span.order_day").hide();
            } else {
                $(this).next("span.order_day").show();
            }
        });

        $("button.submit").click(function(){
            $(".error-info").remove();
            $(".has-error").removeClass("has-error");
            $(this).attr("disabled","true");
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('quation/ajaxQuoting');?>",
                dataType: "json",
                data: $("#theForm").serialize(),
                success: function( result ) {
                    if (result.success==1) {
                        window.location.href = "<?php echo site_url('quation/detail');?>?inquirycode=" + result.message
                    } else {
                        if (result.message.carmodel) {
                            $("input[name='carmodel']").parents(".form-group").append('<span class="help-block error-info">'+result.message.carmodel+'</span>');
                        }

                        if (result.message.vincode) {
                            $("input[name='vincode']").parents(".form-group").append('<span class="help-block error-info">'+result.message.vincode+'</span>');
                        }

                        if (result.message.order_day) {
                            $.each(result.message.order_day, function(pid, obj){
                                $.each(obj, function(key, msg){
                                    $("tr."+pid).find("input[name='order_day["+pid+"]["+key+"]']").parent().addClass("has-error");
                                    $("tr."+pid).parents(".add-inquiry").append('<span class="help-block error-info">'+msg+'</span>');
                                });
                            });
                        }

                        if (result.message.partscount) {
                            $(".add-part-tab").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.partscount+'</span>');
                        }

                        if (result.message.price) {
                            $.each(result.message.price, function(pid, obj){
                                $.each(obj, function(key, msg){
                                    $("tr."+pid).find("input[name='price["+pid+"]["+key+"]']").parent().addClass("has-error");
                                    $("tr."+pid).parents(".add-inquiry").append('<span class="help-block error-info">'+msg+'</span>');
                                });

                            });
                        }

                        if (result.message.shipping_fee) {
                            $(".shipping-fee-tab").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.shipping_fee+'</span>');
                        }


                        if (result.message.addError) {
                            $(".main-form").append('<span class="help-block error-info">'+result.message.addError+'</span>');
                        }

                        if (result.message.inquiry) {
                            $("#dialog>p").html(result.message.inquiry);
                            $("#dialog").dialog({
                                autoOpen: true,
                                title:'提示',
                                resizable: true,
                                modal: true,
                                zIndex: 99999,
                                buttons: {
                                    '确定': function () {
                                        window.location.reload();
                                        $(this).dialog("close");
                                    }
                                }
                            });
                        }
                        $("button.submit").removeAttr("disabled");
                    }
                }
            });
        });
        
//        $("button.quoting").click(function(){
//           if ($("input[name='batchcode']:checked").size()<1 ) {
//               $("#dialog>p").html("请选择供应商报价");
//               $("#dialog").dialog({
//                   autoOpen: true,
//                   title:'提示',
//                   resizable: true,
//                   modal: true,
//                   zIndex: 999,
//                   buttons: {
//                       '确定': function () {
//                           $(this).dialog("close");
//                       }
//                   }
//               });
//           } else {
//               $.ajax({
//                   type: "POST",
//                   url: "<?php //echo site_url('inquiry/ajaxQuoting');?>",
//                   dataType: "json",
//                   data: {
//                        'inquirycode':$("input[name='inquirycode']").val(),
//                        'iqrid':$("input[name='iqrid']").val(),
//                        'batchcode':$("input[name='batchcode']:checked").val()
//                    },
//                   success: function(json){
//                       if (json.success==1) {
//                           window.location.href = "<?php //echo site_url('inquiry/offerdetail');?>?inquirycode="+$("input[name='inquirycode']").val();
//                       } else {
//                           $("#dialog>p").html(json.data);
//                           $("#dialog").dialog({
//                               autoOpen: true,
//                               title:'提示',
//                               resizable: true,
//                               modal: true,
//                               zIndex: 999,
//                               buttons: {
//                                   '确定': function () {
//                                       $(this).dialog("close");
//                                   }
//                               }
//                           });
//                       }
//
//                   }
//               })
//           }
//        });
        
    });

</script>
</html>