<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller {

	private $admindb;
	private $adminroledb;
	private $adminroleprivdb;
	private $adminprivdb;

	public function __construct() {
		parent::__construct();
		$this -> load -> model('Adminmodel');
		$this -> admindb = new Adminmodel();

		$this->load->model('AdminRolemodel');
		$this->adminroledb = new AdminRolemodel();

		$this->load->model('AdminRolePrivmodel');
		$this->adminroleprivdb = new AdminRolePrivmodel();

		$this->load->model('AdminPrivmodel');
		$this->adminprivdb = new AdminPrivmodel();
	}

	//后台欢迎页面
	public function home() {
		$this -> load -> view('index/home');
	}
	/*
	 * 管理员修改编辑个人资料
	 */
	public function profile(){
		if($this->session->has_userdata('id')){
			//管理员信息
			$adminInfo = $this->admindb->getAdminById($this->session->userdata('id'));
			//管理员属于哪个角色
			$roleInfo = $this->adminroledb->getRoleById($adminInfo['roleid']);
			if(!empty($roleInfo)){
				$adminInfo['rolename'] = $roleInfo['rolename'];
			}
			//首先判断一下用户头像是否存在
			if(file_exists($this->config->item('admin_avatar_path').$this->session->userdata('id').'/avatar.png')){
				$adminInfo['avatar'] = $this->config->item('admin_avatar_url').$this->session->userdata('id').'/avatar.png?'.random(6,'0123456789');
			}else{
				$adminInfo['avatar'] = STATIC_PATH.'dist/img/nophoto.gif';
			}
			$this->load->vars('adminInfo',$adminInfo);
			//管理员权限
			$rolePrivs = $this->adminroleprivdb->getRolePrivByRoleid($adminInfo['roleid']);
			if(!empty($rolePrivs)){
				$privs = array();
				foreach($rolePrivs as $v){
					$privs[] = $this->adminprivdb->getPrivById($v['privid']);
				}
				foreach($privs as $k=>$v){
					$privid = $v['privid'];
					$privs[$k]['id'] = $privid;
				}
				$showpriv = formatTreeLevel($privs,0);
				$showprivs = array_multi2single($showpriv);
				$this->load->vars('privs',$showprivs);
			}
			$this->load->view('index/profile');
		}
	}
	/*
	 * 保存个人资料
	 */
	public function saveProfile(){
		if (IS_POST) {
			$data['id'] = $this->input->post('id');
			$account = $this->input->post('account');
			if (isset($account) && !empty($account)) {
				$data['account'] = $account;
			} else {
				$dataTip['msg'] = '账号不能为空';
				$dataTip['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $dataTip);
				exit;
			}
            $data['realname'] = $this->input->post('realname');
			$data['mobile'] = $this->input->post('mobile');
			$data['email'] = $this->input->post('email');
			$password = $this->input->post('password');
			if (isset($password) && !empty($password)) {
				$data['password'] = md5($password);
				$confirmpassword = $this->input->post('confirmpassword');
				if ($confirmpassword !== $password) {
					$dataTip['msg'] = '两次账号不一致';
					$dataTip['url'] = $_SERVER['HTTP_REFERER'];
					$this->load->view('common/error', $dataTip);
					exit;
				}
			}
			$result = $this->admindb->saveAdmin($data);
			if ($result) {
				redirect('index/profile');
			} else {
				$data['msg'] = '保存管理员失败';
				$data['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $data);
			}
		}
	}
	//登陆页面
	public function login() {
		//处理登陆
		if ($this -> input -> post('dosubmit')) {
			$account = $this -> input -> post('account');
			$password = $this -> input -> post('password');
			$verify_code = $this -> input -> post('verify_code');
			if ($this->session->has_userdata('verifyCode') && strtolower($verify_code) == strtolower($this->session->userdata('verifyCode'))) {
				$this->session->unset_userdata('verifyCode');//销毁验证码
				//验证码正确
				$AdminInfo = $this -> admindb -> getAdminByAccount($account);
				if (!empty($AdminInfo)) {
					//账号信息正确，检查一下密码
					if($AdminInfo['password'] == md5($password)){
						//更新一下登陆信息
						$updateData['id'] = $AdminInfo['id'];
						$updateData['login_ip'] = get_client_ip();
						$updateData['login_time'] = time();
						$this->admindb->saveAdmin($updateData);
						$saveSession = array(
							'id'=>$AdminInfo['id'],
							'account'=>$AdminInfo['account'],
							'roleid'=>$AdminInfo['roleid']
						);
						$this->session->set_userdata($saveSession);
						$data['msg'] = '成功登陆！';
						$data['forward'] = 'index/home';
						$data['url'] = site_url($data['forward']);
						$this -> load -> view('common/success', $data);
					}else{
						$data['msg'] = '请核对你的密码是否输入正确！';
						$data['forward'] = 'index/login';
						$data['url'] = site_url($data['forward']);
						$this -> load -> view('common/error', $data);
					}
				} else {
					//登陆失败
					$data['msg'] = '请核对你的账号信息是否正确！';
					$data['forward'] = 'index/login';
					$data['url'] = site_url($data['forward']);
					$this -> load -> view('common/error', $data);
				}

			} else {
				//验证码不正确
				$data['msg'] = '验证码输入错误';
				$data['forward'] = 'index/login';
				$data['url'] = site_url($data['forward']);
				$this -> load -> view('common/error', $data);
			}
		} else {
			if (!$this->session->has_userdata('id') && !$this->session->has_userdata('account') && !$this->session->has_userdata('roleid')) {
				$this -> load -> view('index/login');
			} else {
				//已经登陆过了
				$data['msg'] = '你已经成功登陆!';
				$data['forward'] = 'index/home';
				$data['url'] = site_url($data['forward']);
				$this -> load -> view('common/success', $data);
			}
		}
	}

	//生成验证码
	public function getVerify() {
		$this->load->library('Verify');
		$checkcode = new Verify();
		$code_len = $this->input->get('code_len');
		if (isset($code_len) && intval($code_len)) $checkcode->code_len = intval($code_len);
		if ($checkcode->code_len > 8 || $checkcode->code_len < 2) {
			$checkcode->code_len = 4;
		}
		$font_size = $this->input->get('font_size');
		if (isset($font_size) && intval($font_size)) $checkcode->font_size = intval($font_size);
		$width = $this->input->get('width');
		if (isset($width) && intval($width)) $checkcode->width = intval($width);
		if ($checkcode->width <= 0) {
			$checkcode->width = 130;
		}
		$height = $this->input->get('height');
		if (isset($height) && intval($height)) $checkcode->height = intval($height);
		if ($checkcode->height <= 0) {
			$checkcode->height = 50;
		}
		$max_width = $checkcode->code_len * 28;
		$max_height = $checkcode->font_size * 2;
		if($checkcode->width > $max_width) $checkcode->width = $max_width;
		if($checkcode->height > $max_height) $checkcode->height = $max_height;
		$font_color = $this->input->get('font_color');
		if (isset($font_color) && trim(urldecode($font_color)) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($font_color)))) $checkcode->font_color = trim(urldecode($font_color));
		$background = $this->input->get('background');
		if (isset($background) && trim(urldecode($background)) && preg_match('/(^#[a-z0-9]{6}$)/im', trim(urldecode($background)))) $checkcode->background = trim(urldecode($background));
		$checkcode->doimage();
		$this->session->set_userdata('verifyCode', $checkcode->get_code());
	}

	//退出处理
	public function logout() {
		$array_items = array('id', 'account','roleid');
		$this->session->unset_userdata($array_items);

		$data['msg'] = '退出成功';
		$data['forward'] = 'index/login';
		$data['url'] = site_url($data['forward']);
		$this -> load -> view('common/success', $data);
	}
}
