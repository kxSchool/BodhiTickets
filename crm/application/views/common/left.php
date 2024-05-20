<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo $staffAvatar;?>" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p><?php echo $this->session->userdata('account');?></p>
				<a href="<?php echo site_url('index/profile');?>"><i class="fa fa-circle-o text-aqua"></i>个人信息</a>
				<a href="<?php echo site_url('index/logout');?>"><i class="fa fa-circle-o text-yellow"></i>安全退出</a>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<?php if(isset($menu)):?>
		<ul class="sidebar-menu">
			<li class="header"> 导航菜单</li>
			<li class="treeview">
				<a href="<?php echo site_url('index/home');?>">
					<i class="fa fa-home"></i>
					<span>控制面板</span>
				</a>
			</li>
                        
<!--                        <li class="treeview">
                            <a href="javascript:void(0)">
                                <i class="fa fa-file"></i>
                                <span>询价单管理</span><i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" style="display: block;">
                                <li><a href="http://crm.chepeilong.com/inquiry/index.html?inquirystatus=0"><i class="fa fa-circle-o text-red"></i> 全部询价单</a></li>
                                <li><a href="http://crm.chepeilong.com/inquiry/index.html?inquirystatus=4"><i class="fa fa-circle-o text-red"></i> 待处理</a></li>
                                <li><a href="http://crm.chepeilong.com/inquiry/index.html?inquirystatus=1"><i class="fa fa-circle-o text-red"></i> 待报价</a></li>
                                <li><a href="http://crm.chepeilong.com/inquiry/index.html?inquirystatus=2"><i class="fa fa-circle-o text-red"></i> 已报价</a></li>
                                <li><a href="http://crm.chepeilong.com/inquiry/index.html?inquirystatus=3"><i class="fa fa-circle-o text-red"></i> 已作废</a></li>
                            </ul>
			</li>
                        
                        <li class="treeview active">
                            <a href="javascript:void(0)">
                                <i class="fa fa-table"></i>
                                <span>报价单管理</span><i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu menu-open" style="display: block;">
                                <li><a href="http://crm.chepeilong.com/Quation/index.html?inquirystatus=0"><i class="fa fa-circle-o text-red"></i> 全部询价单</a></li>
                                <li><a href="http://crm.chepeilong.com/quation/index.html?inquirystatus=1"><i class="fa fa-circle-o text-red"></i> 待报价</a></li>
                                <li><a href="http://crm.chepeilong.com/quation/index.html?inquirystatus=2"><i class="fa fa-circle-o text-red"></i> 已报价</a></li>
                                <li><a href="http://crm.chepeilong.com/quation/index.html?inquirystatus=3"><i class="fa fa-circle-o text-red"></i> 已作废</a></li>
                            </ul>
			</li>-->
                        
			<?php foreach($menu as $v):?>
			<li class="treeview">
				<?php if(isset($v['children'])):?>
					<a href="javascript:void(0)">
						<i <?php if(!empty($v['style'])):?>class="<?php echo $v['style'];?>"<?php endif;?>></i>
						<span><?php echo $v['name'];?></span><i class="fa fa-angle-left pull-right"></i>
					</a>
					<ul class="treeview-menu">
						<?php foreach($v['children'] as $vv):?>
						<li><a href="<?php echo $vv['url'];?>"><i class="fa fa-circle-o text-red"></i> <?php echo $vv['name'];?></a></li>
						<?php endforeach;?>
					</ul>
				<?php else:?>
					<a href="<?php echo $v['url'];?>">
						<i <?php if(!empty($v['style'])):?>class="<?php echo $v['style'];?>"<?php endif;?>></i>
						<span><?php echo $v['name'];?></span>
					</a>
				<?php endif;?>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</section>
	<!-- /.sidebar -->
</aside>