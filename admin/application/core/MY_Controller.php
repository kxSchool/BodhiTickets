<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->master=$this -> load -> database('master',true);
        $this->slave=$this -> load -> database('slave',true);
		date_default_timezone_set('Asia/Shanghai');
		$this->load->helper('url');//加载URL 辅助函数
		$this->load->helper('function');//加载自定义辅助函数
		$this->load->config('system');//加载系统配置文件

		define('STATIC_PATH', $this->config->item('static_path'));
		define('PAGESIZE',$this->config->item('pagesize'));
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		define("IS_POST", strtolower($_SERVER['REQUEST_METHOD']) == 'post');

		$this->load->library('session');//初始化session类

		self::check_login();//验证是否登陆
		self::check_auth();//验证权限
		self::menu();//左侧菜单
	}

	//判断用户是否登陆函数
	final public function check_login()
	{
		$route_url = $this->uri->uri_string();
		if (($route_url == 'index/login') || ($route_url == 'index/getVerify')) {
			return true;
		} else {
			if (!$this->session->has_userdata('id') && !$this->session->has_userdata('account') && !$this->session->has_userdata('roleid')) {
				redirect('index/login');
			}
		}
	}

	//验证权限
	final public function check_auth()
	{
		//控制器
		$c_route = $this->uri->segment(1);
		//方法
		$a_route = $this->uri->segment(2);

		//查看一下访问的url是否在权限节点表中
		$this->load->model('AdminPrivmodel');
		$AdminPriv = new AdminPrivmodel();
		$selectData['c'] = $c_route;
		$selectData['a'] = $a_route;
		$PrivInfo = $AdminPriv->getPrivByca($selectData);
		if (!empty($PrivInfo)) {
			//这个路由节点别限制了，查看该用户是否有权限
			$this->load->model('AdminRolePrivmodel');
			$AdminRolePriv = new AdminRolePrivmodel();
			$RolePrivs = $AdminRolePriv->getRolePrivByPrivid($PrivInfo['privid']);
			if (!empty($RolePrivs)) {
				$roleids = array();
				foreach ($RolePrivs as $v) {
					$roleids[] = $v['roleid'];
				}
				if (!in_array($this->session->userdata['roleid'], $roleids)) {
					$data['msg'] = '没有权限,请联系系统管理员!';
					$data['forward'] = 'index/home';
					$data['ststic_path'] = base_url() . 'static';
					$data['url'] = site_url($data['forward']);
					$this->load->view('common/error', $data);
					exit;
				}
			}
		}
		return true;
	}

	//权限菜单menu
	final public function menu(){
		//当前管理员头像
		if(file_exists($this->config->item('admin_avatar_path').$this->session->userdata('id').'/avatar.png')){
			$adminAvatar = $this->config->item('admin_avatar_url').$this->session->userdata('id').'/avatar.png';
		}else{
			$adminAvatar = STATIC_PATH.'dist/img/nophoto.gif';
		}
		$this->load->vars('adminAvatar', $adminAvatar);
		//当前管理员的权限节点
		$this->load->model('AdminRolePrivmodel');
		$AdminRolePriv = new AdminRolePrivmodel();
		$RolePrivs = $AdminRolePriv->getRolePrivByRoleid($this->session->userdata('roleid'));
		if (!empty($RolePrivs)) {
			$privids = array();
			foreach ($RolePrivs as $v) {
				$privids[] = $v['privid'];
			}
			$this->load->model('AdminPrivmodel');
			$AdminPriv = new AdminPrivmodel();
			$AdminPrivList = $AdminPriv->getPrivByPrivids($privids);
			foreach ($AdminPrivList as $k => $v) {
				$AdminPrivList[$k]['id'] = $v['privid'];
				if(!empty($v['data'])){
					$AdminPrivList[$k]['url'] = site_url($v['c'] . '/' . $v['a']).'?'.$v['data'];
				}else{
					$AdminPrivList[$k]['url'] = site_url($v['c'] . '/' . $v['a']);
				}
			}
			$menu = formatTree($AdminPrivList, 0);
			$this->load->vars('menu', $menu);
		}
	}
}