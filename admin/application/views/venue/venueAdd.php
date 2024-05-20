<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>泡米票仓管理系统 | 场馆管理</title>
<?php $this -> load -> view('common/top'); ?>
<script type="text/javascript" src="<?php echo STATIC_PATH;?>js/carsform.js"></script>
<link rel="stylesheet" href="<?php echo STATIC_PATH; ?>bootstrap-fileinput/css/fileinput.min.css" />
<script src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo STATIC_PATH; ?>bootstrap-fileinput/js/fileinput_locale_zh.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $this->config->item('cityJson_url') ;?>"></script>
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
		<h1>场馆添加</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('index/home');?>"><i class="fa fa-home" ></i>控制面板</a></li>
			<li><a href="<?php echo site_url('venue/manage');?>">场馆管理</a></li>
			<li class="active">场馆添加</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
					</div><!-- /.box-header -->
					<div class="box-body">
						<form id="carsForm" class="form-horizontal" >
							
							<div class="form-group">
								<label for="venue_name" class="col-sm-2 control-label">场馆名称：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="venue_name" id="venue_name" placeholder="场馆名称:梅赛德斯奔驰" value="" />
								</div>
                            </div>
                            <div class="form-group">
                                <label for="brand" class="col-sm-2 control-label">省市县：</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="Province" id="Province">
                                        <option>==请选择===</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="City" id="City">
                                        <option>==请选择===</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" name="Village" id="Village">
                                        <option>==请选择===</option>
                                    </select>
                                </div>
                            </div>
							<div class="form-group">
								<label for="address" class="col-sm-2 control-label">地址详情：</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="address" id="address" placeholder="请输入地址详情" value="" />
								</div>
							</div>
								<!--图片品牌-->
							<div class="form-group" id="ad_image_code" style="display:block;">
								<label for="venue_logo" class="col-sm-2 control-label">场馆海报：</label>
								<div class="col-sm-10">
									<input id="venue_logo" type="file" name="userfile" class="file-loading" accept="image/jpeg,image/jpg,image/png">
									<input id="venue_img_name" type="hidden" name="venue_img_name" value="<?php echo $venueinfo["picname"];?>" />
								</div>
							</div>
							<div class="col-sm-offset-2">
								<button type="btn" class="btn btn-success submitbtn">保存</button>
							</div>
						</form>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php $this -> load -> view('common/footer'); ?>
<script>
	$(function(){
		$(".submitbtn").click(function () {
            //$(".selector").find("option[text='pxx']").attr("selected",true);
			var venue_name = $("#venue_name").val();
			var Province = $("#Province").find("option:selected").attr("id");
			var City = $("#City").find("option:selected").attr("id");
			var Village = $("#Village").find("option:selected").attr("id");
			var address = $("#address").val();
            var picname = $("#venue_img_name").val();
			if(venue_name != '' && Province !='' && City!='' && Village!='' && address!=''){
				$.ajax({
					type: "post",
					url: "<?php echo site_url('venue/saveVenues');?>",
					dataType : 'json',
					data : {
						"venue_name":venue_name,
						"Province":Province,
						"City":City,
						"Village":Village,
						"address":address,
                        "picname":picname
					},
					success:function(data){
						if(data.info == 1){
							window.location.href = "<?php echo site_url('venue/manage');?>";
						}else{
							layer.alert(data.tip);
						}
					}
				});
			}
		});
         ProviceBind(0);
        $("#Province").change( function () {
            CityBind($(this).val());
        })
        $("#City").change( function () {
            VillageBind(province[$("#Province").val()]["city"][$(this).val()]);
        })
    
 //上传图片
		$("#venue_logo").fileinput({
			language: "zh",
			uploadUrl:"<?php echo site_url('upload/doUpload');?>?type=venue" ,//上传文件路径
			<?php if(isset($venueinfo["picname"]) && !empty($venueinfo["picname"])):?>
			initialPreview: [
				'<img src="<?php echo $this->config->item('venue_url') . $venueinfo["picname"];?>" class="file-preview-image">'
			],
			<?php endif;?>
			autoReplace: true,
			maxFileCount: 1,
			allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
		});
		$("#venue_logo").on("fileuploaded", function (event, data, previewId, index) {
			if(data.response.info == 1){
				var realpath = data.response.data.file_name;
                console.log(realpath);
				$("#venue_img_name").val(realpath);
			}
		});
        $("#venue_logo").on("fileclear", function (event, data, previewId, index) {
            $("#venue_img_name").val('');
		});   
    
    


	});
    function ProviceBind(pid){
        var str;
        $("#Province").html("");
        $.each(province, function (i, item) {
            str += "<option parent_id=" + item.parent_id + " id=" + item.id + " value=" + i + ">" + item.name + "</option>";
        })
        $("#Province").append(str);
        if (province[pid]["city"].length==1){
            CityBind(0);
        }
    }
    function CityBind(cid){
        var str;
        $("#City").html("");
        $("#Village").html("");
        $.each(province[cid]["city"], function (i, item) {
            str += "<option parent_id=" + item.parent_id + " id=" + item.id + "  value=" + i + ">" + item.name + "</option>";
        })
        $("#City").append(str);
        VillageBind(province[cid]["city"][0]);
    }
    function  VillageBind(citys){
        var str;
        $("#Village").html("");
        $.each(citys["city"], function (i, item) {
            str += "<option parent_id=" + item.parent_id + " id=" + item.id + "  value=" + item.id + ">" + item.name + "</option>";
        })
        $("#Village").append(str);
    }
</script>
</body>
</html>