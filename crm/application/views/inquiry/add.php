<!DOCTYPE html>
<html>
<head>
	<title>票商中心管理系统 | 询价单详情</title>
	<?php $this ->load -> view('common/top'); ?>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>js/clipboard.min.js"></script>
        <script type="text/javascript" src="<?php echo CRM_STATIC_PATH; ?>jQuery/jquery-ui.min.js"></script>
        <link href="<?php echo CRM_STATIC_PATH; ?>css/inquiry.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CRM_STATIC_PATH; ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!--<link rel="stylesheet" href="<?php //echo CRM_STATIC_PATH; ?>jquery-chosen/css/chosen.css" />-->
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
			<h1>询价单开单</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
				<li><a href="<?php echo site_url('inquiry/index');?>">询价单管理</a></li>
				<li class="active">询价单开单</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
                    <!-- row -->
                    <div class="admin_list"  style="margin-top: -30px;">
                        <form id="theForm" >
                            <div class="main-form" style="margin-top:30px;">
                                <!--客户信息-->
                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry">
                                        <h4 class="list-group-item-heading"><strong>客户信息</strong></h4>
                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">客户：</span>
                                                <span>
                                                    <input type="text" class="form-control w4 search_repair" placeholder="请输入门店名、联系电话、联系人" />
                                                    <input type="hidden" name="userid" value="<?php echo !empty($userInfo['userid'])? $userInfo['userid']:'' ?>" />
                                                </span>
                                            </p>
                                        </div>

                                        <div class="repair_info" <?php echo empty($userInfo) ? 'style="display:none;"': '';?> >
                                            <p class="list-group-item-text w3">
                                                <span class="label_info">收货人：</span>
                                                <span class="shipping_name"><?php echo !empty($userInfo['recname']) ? $userInfo['recname'] : ''?></span>
                                            </p>
                                            <p class="list-group-item-text w3">
                                                <span class="label_info">门店名：</span>
                                                <span class="repair_name"><?php echo !empty($userInfo['realname']) ? $userInfo['realname'] : ''?></span>
                                            </p>

                                            <p class="list-group-item-text">
                                                <span class="label_info">联系方式：</span>
                                                <span class="shipping_mobile"><?php echo !empty($userInfo['recphone']) ? $userInfo['recphone'] : ''?></span>
                                            </p>
                                            <p class="list-group-item-text">
                                                <span class="label_info">收货地址：</span>
                                                <span class="shipping_address"><?php echo !empty($userInfo['address'])?$userInfo['address']:'' ?></span>
                                            </p>
                                            <input type="hidden"  name="shipping_name" value="<?php echo !empty($userInfo['recname']) ? $userInfo['recname']:'' ?>" />
                                            <input type="hidden"  name="shipping_areaid" value="<?php echo !empty($userInfo['areaid']) ? $userInfo['areaid']:'' ?>" />
                                            <input type="hidden"  name="shipping_mobile" value="<?php echo !empty($userInfo['recphone']) ? $userInfo['recphone']:'' ?>" />
                                            <input type="hidden"  name="shipping_province_id" value="<?php echo !empty($userInfo['provid']) ? $userInfo['provid']:'' ?>" />
                                            <input type="hidden"  name="shipping_city_id" value="<?php echo !empty($userInfo['cityid']) ? $userInfo['cityid']:'' ?>" />
                                            <input type="hidden"  name="shipping_area_id" value="<?php echo !empty($userInfo['counid']) ? $userInfo['counid']:'' ?>" />
                                            <input type="hidden"  name="shipping_address" value="<?php echo !empty($userInfo['shortaddress']) ? $userInfo['shortaddress']:'' ?>" />

                                            <p> <button  type="button"  class="btn btn-info btn-flat btn-ws modify_repair_info" >修改</button></p>
                                        </div>

                                    </div>

                                </div>
                                <!--车型信息-->
                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry">
                                        <h4 class="list-group-item-heading"><strong>车型信息</strong></h4>
                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">询价品牌：</span>
                                                <span>
                                                    <input type="text" class="form-control w4" name="brand_factory_text" placeholder="询价品牌"  value=""/>
                                                    <!--<input type="hidden" name="brand_and_factory"  value=""/>-->
                                                    <!--<button  type="button"  class="btn btn-info btn-flat btn-ws select_company" >选择供应商</button>-->
                                                </span>
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">车型：</span>
                                                <span>
                                                    <input type="text" class="form-control w4" name="modelstr" placeholder="车型信息" />
                                                    <!--<button  type="button"  class="btn btn-info btn-flat btn-ws select_car" >选择车型</button>-->
                                                </span>
                                            </p>
                <!--                            <input type="hidden" id="ibrand" name="ibrand" value="" autocomplete="off" />
                                            <input type="hidden" id="ifactory" name="ifactory"  value="" autocomplete="off" />
                                            <input type="hidden" id="icar" name="icar" value="" autocomplete="off" />
                                            <input type="hidden" id="iyear" name="iyear" value="" autocomplete="off" />
                                            <input type="hidden" id="imodel" name="imodel" value="" autocomplete="off" />-->
                                        </div>

                                        <div class="form-group">
                                            <p class="list-group-item-text">
                                                <span class="label_info">车架号：</span>
                                                <span>
                                                    <input type="text" class="form-control w4" name="vincode" placeholder="请输入VIN码" />
                                                </span>
                                            </p>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                                <!--配件列表-->
                                <div class="list-group col-md-12 clearfix o-p-r">
                                    <div class="list-group-item o-height add-inquiry">
                                        <h4 class="list-group-item-heading"><strong>配件列表</strong></h4>
                                        <p class="list-group-item-text"><button  type="button"  class="btn  btn-primary btn-flat btn-ws add-part" style="margin-left: 0;">新增</button></p>
                                        <table class="table table-hover table-bordered add-part-tab"  >
                                            <tr class="title">
                                                <th width="2%">序</th>
                                                <th width="20%">配件名称</th>
                                                <th width="10%">OE</th>
                                                <th width="10%">品质要求</th>
                                                <th width="10%">备注</th>
                                                <th width="5%">数量</th>
                                                <th width="10%">操作</th>
                                            </tr>
                                            <!--<tr class="part-list-tr ">
                                                <td width="2%" data-key="1" class="part-num">1</td>
                                                <td width="20%" class="has-error"><input class="form-control" name="pname[1]" value="" /></td>
                                                <td width="10%"><input class="form-control" name="oecode[1]" value="" /></td>
                                                <td width="10%">
                                                     <select class="form-control" name="prequirement[1]">
                                                         <option value="1">原厂件</option>
                                                         <option value="2">同质件</option>
                                                         <option value="3">品牌件</option>
                                                     </select>
                                                </td>
                                                <td width="15%"><input class="form-control" name="pcontent[1]" value="" /></td>
                                                <td width="5%"><input class="form-control" name="number[1]" value="" /></td>
                                                <td width="10%"><button  type="button"  class="btn btn-danger add-part" >删除</button></td>
                                            </tr>-->
                                        </table>

                                    </div>
                                </div>

                            </div>

                            <div style="text-align: center; "><button  type="button"  class="btn btn-primary btn-flat submit w5" >生成询价单</button> </div>

                        </form>
                    </div>
                </section>
</div>

<!-- 修改用户信息 -->
<div id="modify_repair" style="display:none;">
    <div class="form-horizontal userInfoForm">
        <div class="form-group">
            <label  class="col-sm-2 control-label" style="text-align:left">联系人：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="shipping_name_d" value="<?php echo !empty($userInfo['recname'])?$userInfo['recname']:'' ?>" />
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label" style="text-align:left">联系方式：</label>
            <div class="col-sm-10">
                <input  type="text" class="form-control"  name="shipping_mobile_d"  value="<?php echo !empty($userInfo['recphone'])?$userInfo['recphone']:'' ?>" />
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label" style="text-align:left">所在区域：</label>
            <div class="col-sm-10">

                <select class="person_select" name="shipping_province_id_d" id="province">
                    <option value="">--请选择省--</option>
                    <?php if(!empty($provinces)):?>
                    <?php foreach($provinces  as $pkey=>$pval) :?>
                    <?php echo '<option value="'.$pval["areaid"].'"'.(($userInfo['provid'] == $pval["areaid"])? 'selected="true"' : '' ).'>'.$pval["areaname"].'</option>' ?>
                    <?php endforeach;?>
                    <?php endif; ?>
                </select>
                <select class="person_select" name="shipping_city_id_d" id="city">
                    <option value="" class="default">--请选择市--</option>
                    <?php if(!empty($citys )):?>
                    <?php foreach($citys  as $ckey=>$cval) :?>
                    <?php echo '<option value="'.$cval["areaid"].'"'.(($userInfo['provid'] == $cval["areaid"])? 'selected="true"' : '' ).'>'.$cval["areaname"].'</option>' ?>
                    <?php endforeach;?>
                    <?php endif; ?>
                </select>
                <select class="person_select" name="shipping_area_id_d" id="district">
                    <option  value="" class="default ">--请选择区县--</option>
                    <?php if(!empty($districts)):?>
                    <?php foreach($districts  as $dkey=>$dval) :?>
                    <?php echo '<option value="'.$dval["areaid"].'"'.(($userInfo['provid'] == $dval["areaid"])? 'selected="true"' : '' ).'>'.$dval["areaname"].'</option>' ?>
                    <?php endforeach;?>
                    <?php endif; ?>
                </select>

            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label" style="text-align:left">收货地址：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="shipping_address_d" value="<?php echo !empty($userInfo['short_address']) ? $userInfo['short_address']:'' ?>" />
            </div>
        </div>

    </div>

</div>
<!-- 修改用户信息 -->

<!-- 选择供应商 -->
<div id="select_company" class="select_car_box" style="display:none;" >
    <!--选择ING-->
<!--    <div class="modal-body J-choice ">
        <ul class="nav nav-tabs" role="tablist" id="companyTab">
            <li role="presentation" class="active tab-b"><a href="#company_brand" role="tab" data-toggle="tab">一、选择品牌</a></li>
            <li role="presentation" class="tab-f" id="company_factory_tab" ><a href="#company_factory" role="tab" data-toggle="tab">二、选择车系</a></li>

        </ul>-->
<!--        <div class="tab-content">
            选择品牌
            <div role="tabpanel" class="tab-pane active select_car_brand" id="company_brand">

                <ul class="tab-pp clearfix">
                    <volist name="data['brand']" id="vo" >
                        <li>
                            <a href="javascript:void(0);" onclick="getCarInfo(this);" data-id="{$vo['bid']}"  data-type="brand" data-suid="{$vo['suid']}"  data-name="{$vo['b_name']}">
                                <img src="{$vo['image']}">{$vo['b_name']}
                            </a>
                        </li>
                    </volist>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane select_car_factory" id="company_factory">

            </div>

        </div>-->
    </div>

<!--    <span class="ibrand" style="display:none;"></span>
    <span class="ifactory" style="display:none;"></span>-->


</div>
<!-- 选择供应商 -->

<!-- 选择车型 -->
<div id="select_car" class="select_car_box" style="display:none;" >
    <!--选择ING-->
    <div class="modal-body J-choice ">
<!--        <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active tab-b"><a href="#home" role="tab" data-toggle="tab">一、选择品牌</a></li>
            <li id="tab2" class="tab-f" role="presentation"><a href="#profile" role="tab" data-toggle="tab">二、选择车系</a></li>
            <li id="tab3" class="tab-s" role="presentation"><a href="#messages" role="tab" data-toggle="tab">三、选择车型</a></li>
            <li id="tab4" class="tab-o" role="presentation"><a href="#other" role="tab" data-toggle="tab">其它</a></li>
        </ul>-->
        <div class="tab-content">
            <!--选择品牌-->
<!--            <div role="tabpanel" class="tab-pane active select_car_brand" id="home">

                <ul class="tab-pp clearfix">
                    <volist name="data['brand']" id="vo" >
                        <li>
                            <a href="javascript:void(0);" onclick="getCarInfo(this);" data-id="{$vo['bid']}"  data-type="brand" data-suid="{$vo['suid']}"  data-name="{$vo['b_name']}">
                                <img src="{$vo['image']}">{$vo['b_name']}
                            </a>
                        </li>
                    </volist>
                </ul>
            </div>-->
<!--            <div role="tabpanel" class="tab-pane select_car_factory" id="profile">
                 车系数据 
            </div>-->
<!--            <div role="tabpanel" class="tab-pane select_car_series" id="messages">
                车型数据 
            </div>-->
<!--            <div role="tabpanel" class="tab-pane" id="other">

                <div style="padding:10px; margin-bottom: 20px;">
                    <label  class="col-sm-3 control-label" style="text-align:center">其它车型：</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control"  id="other_car" placeholder="请详细填写车型:品牌 厂商 车系 年款 车型 " value="" />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="sure_car(this);">确定车型</button>
                </div>
            </div>-->
        </div>
    </div>

<!--    <span class="brandname" style="display:none;"></span>
    <span class="factoryname" style="display:none;"></span>
    <span class="yearname" style="display:none;"></span>
    <span class="carname" style="display:none;"></span>
    <span class="modelname" style="display:none;"></span>

    <span class="ibrand" style="display:none;"></span>
    <span class="ifactory" style="display:none;"></span>
    <span class="icar" style="display:none;"></span>
    <span class="iyear" style="display:none;"></span>
    <span class="imodel" style="display:none;"></span>-->


</div>
<!-- 选择车型 -->


<div class="mask">
    <div id="dialog" title="" style="display:none;">
        <p></p>
    </div>
</div>
		</section><!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php $this ->load -> view('common/footer'); ?>
</body>
<!--<script src="<?php //echo CRM_STATIC_PATH; ?>jquery-chosen/js/chosen.jquery.js"></script>-->
<script>
    $(function(){
        $(".search_repair").autocomplete({
            source: function(request,response) { // ajax请求数据
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('members/ajaxSearch'); ?>",
                    dataType: "json",
                    data: {
                        data:request.term,
                        maxRows: 10       // 最多获取5条数据用来显示
                    },
                    success: function( data ) {
                        if(data.length > 0){
                            response( $.map( data, function( item ) {
                                return { // 设置要显示的字段值
                                    value: item.realname!='' ? item.realname : (item.username!=''?item.username:item.mobile),
                                    userid: item.userid
                                }
                            }));
                        }
                    }
                });
            },
            minLength:1,
            autoFocus:true,
            delay: 500,
            select: function( event, ui ) { //下拉显示层绘制
                $(this).val(ui.item.value);
                $("input[name='userid']").val(ui.item.userid);
                if ($("input[name='userid']").val()!='') {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('members/ajaxGetmember'); ?>",
                        dataType: "json",
                        data: {'userid':ui.item.userid},
                        success: function( data ) {
                            if(data.length<1) {
                                $("#dailog>p").html('用户信息不存在');
                                $("#dialog").dialog({
                                    autoOpen: true,
                                    title:'提示',
                                    minWidth:400,
                                    modal:true,
                                    buttons: {
                                        '确定': function () {
                                            $(this).dialog("close");
                                        }
                                    }
                                });
                            } else {
                                $(".repair_info .shipping_name").html(data.recname);
                                $(".repair_info .repair_name").html(data.realname);
                                $(".repair_info .shipping_address").html(data.address);
                                $(".repair_info .shipping_mobile").html(data.recphone);

                                $("input[name='shipping_name']").val(data.recname);
                                $("input[name='shipping_areaid']").val(data.areaid);
                                $("input[name='shipping_mobile']").val(data.recphone);
                                $("input[name='shipping_address']").val(data.short_address);
                                $("input[name='shipping_province_id']").val(data.provid);
                                $("input[name='shipping_city_id']").val(data.cityid);
                                $("input[name='shipping_area_id']").val(data.counid);

                                //修改框
                                $("input[name='shipping_name_d']").val(data.recname);
                                $("input[name='shipping_mobile_d']").val(data.recphone);
                                $("input[name='shipping_address_d']").val(data.short_address);

                                if (data.provid!='') {
                                    $("select#province").val(data.provid);
                                    $("select#province").trigger('change');
                                }
                                if (data.cityid!='') {
                                    $("select#city").val(data.cityid);
                                    $("select#city").trigger('change');
                                }
                                if (data.counid!='') {
                                    $("select#district").val(data.counid);
                                    $("select#district").trigger('change');
                                }
                                $(".repair_info").show();
                            }
                        }
                    });
                }
            },
            open: function() { //打开显示层
                //$("input[name='rid']").val('');
            },
            close: function() { // 关闭显示层
                /*if ($("input[name='rid']").val()=='' && $(".search_repair").val()!='') {
                    $(".search_repair").val("");
                }*/
            },
        });

        $(".modify_repair_info").click(function(){
            $(".mask").show();
            $("#modify_repair").dialog({
                autoOpen: true,
                title:'修改收货信息',
                resizable: true,
                modal: true,
                zIndex: 99999,
                minWidth:725,
                buttons: {
                    '确定': function () {
                        $(".repair_info .shipping_name").html($("input[name='shipping_name_d']").val());
                        var address = $("select#province option:selected").text()+$("select#city option:selected").text()+$("select#district option:selected").text();
                        address += $("input[name='shipping_address_d']").val();
                        $(".repair_info .shipping_address").html(address);
                        $(".repair_info .shipping_mobile").html($("input[name='shipping_mobile_d']").val());

                        $("input[name='shipping_name']").val($("input[name='shipping_name_d']").val());
                        $("input[name='shipping_mobile']").val($("input[name='shipping_mobile_d']").val());
                        $("input[name='shipping_address']").val($("input[name='shipping_address_d']").val());
                        $("input[name='shipping_province_id']").val($("select[name='shipping_province_id_d']").val());
                        $("input[name='shipping_city_id']").val($("select[name='shipping_city_id_d']").val());
                        $("input[name='shipping_area_id']").val($("select[name='shipping_area_id_d']").val());

                        $(this).dialog("close");
                        $(".mask").hide();
                        
                    }
                }
            });
            $(".ui-dialog-titlebar-close .ui-button-text").text("关闭");
        });
        $(document).on("click",".ui-dialog-titlebar-close",function(){
            $(".mask").hide();
        });
        $("#province").change(function(){
            var provinceid = $('#province').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('address/getArea');?>",
                dataType: "json",
                data: {'areaid' : provinceid},
                success: function( result ) {
                    if(result.flag){
                       $('#city').empty();
                       var htmlstring = '<option value="0">选择区市</option>';
                       $.each(result.message,function(k,i){
                           htmlstring += '<option value="'+i.areaid+'"'+'>'+i.areaname+'</option>';
                       });
                       $('#city').html(htmlstring);
                    }else{
                       alert(result.message);
                    }
                }
            });
        });
        $("#city").change(function(){
            var cityid = $('#city').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('address/getArea');?>",
                dataType: "json",
                data: {'areaid' : cityid},
                success: function( result ) {
                    if(result.flag){
                       $('#district').empty();
                       var htmlstring = '<option value="0">选择区县</option>';
                       $.each(result.message,function(k,i){
                           htmlstring += '<option value="'+i.areaid+'"'+'>'+i.areaname+'</option>';
                       });
                       $('#district').html(htmlstring);
                    }else{
                       alert(result.message);
                    }
                }
            });
        });
        

//        $(".select_company").click(function(){
//            $("#select_company").dialog({
//                autoOpen: true,
//                title:'选择供应商',
//                resizable: true,
//                modal: true,
//                zIndex: 99999,
//                minWidth:840
//            });
//        });

//        $(".select_car").click(function(){
//            $("#select_car").dialog({
//                autoOpen: true,
//                title:'选择车型',
//                resizable: true,
//                modal: true,
//                zIndex: 99999,
//                minWidth:840
//            });
//        });

//        //年款点击
//        $("body").on('click', '.J-h6', function(){
//            if ($(this).find("span.glyphicon-chevron-up").size()>0) {
//                $("ul.tab-cxx").hide();
//                $(this).next().show();
//                $(".J-h6").children("span").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
//                $(this).children("span").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
//            } else {
//                $(this).next().hide();
//                $(this).children("span").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
//            }
//        });

        //新增配件
        $(".add-part").click(function(){
            var dataKey = $(".add-part-tab .part-num").size()>0 ? parseInt($(".add-part-tab .part-num").last().attr("data-key"))+1: 1;
            var number = $(".add-part-tab .part-num").size()+1;
            var partTr = '<tr class="part-list-tr"> '+
                         '<td width="2%" data-key="'+dataKey+'" class="part-num">'+number+'</td> ' +
                         '<td width="20%"><input class="form-control" name="pname['+dataKey+']" value="" placeholder="请输入配件名称"/></td> ' +
                         '<td width="10%"><input class="form-control" name="oecode['+dataKey+']" value="" placeholder="请输入OE码"/></td> ' +
                         '<td width="10%"> ' +
                         '<select class="form-control" name="prequirement['+dataKey+']"> ' +
                         '<option value="9">请选择</option> ' +
                         '<option value="1">原厂件</option> ' +
                         '<option value="2">同质件</option> ' +
                         '<option value="3">品牌件</option> ' +
                         '</select> ' +
                         '</td> ' +
                         '<td width="15%"><input class="form-control" name="pcontent['+dataKey+']" value="" placeholder="请填写备注信息或留空"/></td> ' +
                         '<td width="5%"><input class="form-control" name="number['+dataKey+']" value="1" /></td> ' +
                         '<td width="10%" style="text-align:center;"><button  type="button"  class="btn btn-danger btn-flat btn-ws remove-part" >删除</button></td> ' +
                         '</tr>';
            $(".add-part-tab").append(partTr);

        });

        //删除配件
        $("body").on("click", ".add-part-tab .remove-part", function(){
            $(this).parents(".part-list-tr").remove();
            $(".add-part-tab .part-num").each(function(i, n){
                $(this).text(i+1);
            });
        });

        $("button.submit").click(function(){
            $(".error-info").remove();
            $(".has-error").removeClass("has-error");
            $(this).attr("disabled","true");
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Inquiry/ajaxAdd');?>",
                dataType: "json",
                data: $("#theForm").serialize(),
                success: function( result ) {
                    if (result.flag==1) {
                        window.location.href = "<?php echo site_url('Inquiry/detail').'?inquirycode=';?>" + result.message
                    } else {
                        if (result.message.userid) {
                            $("input[name='userid']").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.userid+'</span>');
                        }
                        if (result.message.shipping_mobile) {
                            $("input[name='userid']").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.shipping_mobile+'</span>');
                        }
                        if (result.message.shipping_address) {
                            $("input[name='userid']").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.shipping_address+'</span>');
                        }
                        if (result.message.brand_and_factory) {
                            $("input[name='brand_and_factory']").parents(".form-group").append('<span class="help-block error-info">'+result.message.brand_and_factory+'</span>');
                        }
                        if (result.message.vincode) {
                            $("input[name='vincode']").parents(".form-group").append('<span class="help-block error-info">'+result.message.vincode+'</span>');
                        }
                        if (result.message.parts) {
                            $(".add-part-tab").parents(".add-inquiry").append('<span class="help-block error-info">'+result.message.parts+'</span>');
                        }
                        if (result.message.pname) {
                            $.each(result.message.pname, function(i, n){
                                $(".part-num[data-key="+ i +"]").parents(".part-list-tr").find("input[name='pname["+i+"]']").parent().addClass("has-error");
                                $(".add-part-tab").parents(".add-inquiry").append('<span class="help-block error-info">'+n+'</span>');

                            });
                        }
                        if (result.message.addError) {
                            $(".main-form").append('<span class="help-block error-info">'+result.message.addError+'</span>');
                        }
                        $("button.submit").removeAttr("disabled");
                    }

                }
            });
        });

    });


    //选择车型
//    function getCarInfo(o) {
//        var type = $(o).attr('data-type');
//        var name = $(o).attr('data-name');
//        var id = $(o).attr('data-id');  //品牌ID
//        var suid = $(o).attr('data-suid'); //客服ID
//
//        if (type == 'brand') {
//            $(o).parents('.select_car_box').find("span.brandname").text(name);
//            $(o).parents('.select_car_box').find("span.ibrand").text(id);
//            var imgurl = $(o).find("img").attr('src');
//        } else if(type == 'series') {
//            $(o).parents('.select_car_box').find("span.factoryname").text($(o).parents("ul.tab-cx").prev().text());
//            $(o).parents('.select_car_box').find("span.ifactory").text($(o).parents("ul.tab-cx").attr("data-fid"));
//            $(o).parents('.select_car_box').find("span.carname").text($(o).text());
//            $(o).parents('.select_car_box').find("span.icar").text(id);
//        }
//
//        $.ajax({
//            type: "POST",
//            url: "{:U('inquiry/get_car_info')}",
//            dataType: "json",
//            data: {
//                id: id,
//                suid: suid,
//                type:type
//            },
//            success: function( json ) {
//                if(json.data.length > 0){
//                    if(type == 'brand'){ //车系数据处理过程
//                        var str = '';
//                        $.each(json.data,function(i,val){
//                            if ($(o).parents('.select_car_box').attr("id")=='select_car') {
//                                str += '<h3><img src="'+imgurl+'" />'+val.f_name+'</h3><ul class="tab-cx clearfix" data-fid="'+val.fid +'">';
//                                $.each(val.s_data,function(ii,sval){
//                                    str += '<li><a href="javascript:void(0)" style="cursor: pointer;" '+
//                                        'onclick="getCarInfo(this);"  data-id="'+sval.id+
//                                        '" data-type="series" data-suid="'+suid+
//                                        '" data-name="'+sval.name +'">'+sval.name+'</a></li>';
//
//                                });
//                                str += '</ul>';
//                            } else {
//                                str += '<h3 style="cursor: pointer;" onclick="selectCompany(this);" data-f_name="'+val.f_name+'" data-fid="'+val.fid +'">' +
//                                        '<img src="'+imgurl+'" />'+val.f_name+'</h3>' +
//                                        '<ul onclick="selectCompany(this);" class="tab-cx clearfix" data-f_name="'+val.f_name+'" data-fid="'+val.fid +'">';
//                                $.each(val.s_data,function(ii,sval){
//                                    str += '<li><a href="javascript:void(0)">'+sval.name+'</a></li>';
//                                });
//                                str += '</ul>';
//                            }
//                        });
//                        $(o).parents('.select_car_box').find(".select_car_factory").children().remove();
//                        $(o).parents('.select_car_box').find(".select_car_factory").append(str);
//                    } else if (type == 'series') {
//                        var str = '';
//                        $.each(json.data,function(i,val){
//                            str += '<div>'+
//                                    '<h6 class="J-h6">'+val.y_name + '<span class="glyphicon glyphicon-chevron-up"></span></h6>'+
//                                    '<ul class="tab-cxx clearfix" style="display:none;">';
//                            $.each(val.m_data,function(ii,mval){
//                                str += '<li><a href="javascript:void(0)" '+
//                                        'data-iyear="'+val.yid+'" data-id="'+mval.mid+ '"' +
//                                        'onclick="carclick(this);" >'+ mval.m_name+'</a></li>';
//                            });
//                            str += '</ul></div>';
//                        });
//
//                        $(o).parents('.select_car_box').find(".select_car_series").children().remove();
//                        $(o).parents('.select_car_box').find(".select_car_series").append(str);
//
//                    }
//
//                } else {
//                    alert('无数据,请核实!');
//                    return;
//                }
//
//                if(type == 'brand'){
//                    $(o).parents('.select_car_box').find(".tab-f a").trigger("click");
//                } else if(type == 'series') {
//                    $(o).parents('.select_car_box').find(".tab-s a").trigger("click");
//                }
//            }
//        });
//    }

//    function carclick(o){ // 车型数据点击选择处理
//        $(o).parents('.select_car_box').find("span.yearname").text($(o).parents("ul.tab-cxx").prev().text());
//        $(o).parents('.select_car_box').find("span.iyear").text($(o).attr('data-iyear'));
//        $(o).parents('.select_car_box').find("span.modelname").text($(o).text());
//        $(o).parents('.select_car_box').find("span.imodel").text($(o).attr('data-id'));
//
//        var modelstr = '';
//        modelstr += $.trim($(o).parents('.select_car_box').find("span.brandname").text());
//        modelstr += ' '+$.trim($(o).parents('.select_car_box').find("span.factoryname").text());
//        modelstr += ' '+$.trim($(o).parents('.select_car_box').find("span.carname").text());
//        modelstr += ' '+$.trim($(o).parents('.select_car_box').find("span.yearname").text());
//        modelstr += ' '+$.trim($(o).parents('.select_car_box').find("span.modelname").text());
//
//        $("input[name='modelstr']").val(modelstr);
//        $("#ibrand").val($(o).parents('.select_car_box').find("span.ibrand").text());
//        $("#ifactory").val($(o).parents('.select_car_box').find("span.ifactory").text());
//        $("#icar").val($(o).parents('.select_car_box').find("span.icar").text());
//        $("#iyear").val($(o).parents('.select_car_box').find("span.iyear").text());
//        $("#imodel").val($(o).parents('.select_car_box').find("span.imodel").text());
//
//        $("#select_car").dialog("close");
//    }

//    function selectCompany (o) {
//        var brand_factory_text = '';
//        brand_factory_text += $.trim($(o).parents('.select_car_box').find("span.brandname").text());
//        brand_factory_text += $.trim($.trim($(o).attr("data-f_name")));
//        $("input[name='brand_factory_text']").val(brand_factory_text);
//
//        var brand_and_factory = '';
//        brand_and_factory += $.trim($(o).parents('.select_car_box').find("span.ibrand").text());
//        brand_and_factory += '_'+$.trim($(o).attr("data-fid"));
//        $("input[name='brand_and_factory']").val(brand_and_factory);
//        $.ajax({
//            type: "POST",
//            url: "{:U('inquiry/ajax_get_company')}",
//            dataType: "json",
//            data: {'brand_and_factory' : brand_and_factory},
//            success: function( result ) {
//                $("input[name='brand_and_factory']").parents(".form-group").find('.help-block').remove();
//                if (result.success==1) {
//                    $.each(result.data, function(i,n){
//                        $("input[name='brand_and_factory']").parents(".form-group").append('<span class="help-block">'+n.name+'</span>');
//                    });
//                } else {
//                    $("input[name='brand_and_factory']").parents(".form-group").append('<span class="help-block error-info">'+result.msg+'</span>');
//                }
//
//            }
//        });
//        $("#select_company").dialog("close");
//    }

//    function sure_car(o) {
//        $("input[name='modelstr']").val($(o).parents('.select_car_box').find("#other_car").val());
//        $("#ibrand").val('');
//        $("#ifactory").val('');
//        $("#icar").val('');
//        $("#iyear").val('');
//        $("#imodel").val('');
//
//        $("#select_car").dialog("close");
//    }

</script>
</html>