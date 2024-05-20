<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    
        protected $qirelationmodel;

	public function __construct() {
		parent::__construct();
                // 初始化基本库数据库连接
                $this->master = $this -> load -> database('master',true);
                $this->slave = $this -> load -> database('slave',true);
                // 职员管理库数据连接
                $this->crmmaster = $this -> load -> database('crm_master',true);
                $this->crmslave = $this -> load -> database('crm_slave',true);
                // 初始化采购库数据连接
                $this->purchasemaster = $this->load->database('purchase_master',true);
                $this->purchaseslave = $this->load->database('purchase_slave',true);
            
		date_default_timezone_set('Asia/Shanghai');
		$this->load->helper('url');//加载URL 辅助函数
		$this->load->helper('function');//加载自定义辅助函数
		$this->load->config('system');//加载系统配置文件

		define('CRM_STATIC_PATH', $this->config->item('crm_static_path'));
		define('PAGESIZE',$this->config->item('pagesize'));
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		define("IS_POST", strtolower($_SERVER['REQUEST_METHOD']) == 'post');

		$this->load->library('session');//初始化session类

		self::check_login();//验证是否登陆
        // 供货商品牌对应关系
        $this->load->model('QIRelationmodel');
        $this->qirelationmodel = $this->QIRelationmodel;
                
		self::check_auth();//验证权限
		self::menu();//左侧菜单
	}

	//判断用户是否登陆函数
	final public function check_login(){
            if(file_exists($this->config->item('staff_avatar_path').$this->session->userdata('id').'/avatar.png')){
                $staffAvatar = $this->config->item('staff_avatar_url').$this->session->userdata('id').'/avatar.png';
            }else{
                $staffAvatar = CRM_STATIC_PATH.'dist/img/nophoto.gif';
            }
            $this->load->vars('staffAvatar', $staffAvatar);

            $route_url = $this->uri->uri_string();
            if (($route_url == 'index/login') || ($route_url == 'index/getVerify')) {
                return true;
            } else {
                if (!$this->session->has_userdata('id') && !$this->session->has_userdata('account') && !$this->session->has_userdata('roleid')) {
                    redirect('index/login');
                }
            }
	}
        
        /**
         * 根据需求返回当前用户可以处理的寻报价品牌信息
         * @param int $flag 0:返回寻报价品牌信息,1:返回询价品牌信息,2:返回报价品牌信息
         * @return array 返回品牌信息
         */
        public function getInquiryAndQuationBrand($flag=0){
            $returndata = ['inquirybrand'=>[],'quotationbrand'=>[]];
            // 获取寻报价品牌信息
            $data = $this->qirelationmodel->getBrandNameByShopId($this->session->userdata('shopid'));
            foreach ($data as $datakey => $datavalue) {
                if($datavalue['q_shop_id'] == $this->session->userdata('shopid') 
                        && !in_array($datavalue['brandname'], $returndata['inquirybrand'])){
                    $returndata['inquirybrand'][] = $datavalue['brandname'];
                }
                if($datavalue['s_shop_id'] == $this->session->userdata('shopid') 
                        && !in_array($datavalue['brandname'], $returndata['quotationbrand'])){
                    $returndata['quotationbrand'][] = $datavalue['brandname'];
                }
            }
            if($flag==1){
                return $returndata['inquirybrand'];
            }
            if($flag==2){
                return $returndata['quotationbrand'];
            }
            return $returndata;
        }
        
	//验证权限
	final public function check_auth()
	{
		//控制器
		$c_route = $this->uri->segment(1);
		//方法
		$a_route = $this->uri->segment(2);

		//查看一下访问的url是否在权限节点表中
		$this->load->model('StaffPrivmodel');
		$StaffPriv = new StaffPrivmodel();
		$selectData['c'] =  $c_route;
		$selectData['a'] = $a_route;
		$PrivInfo = $StaffPriv->getPrivByca($selectData);
		if (!empty($PrivInfo)) {
			//这个路由节点别限制了，查看该用户是否有权限
			$this->load->model('StaffRolePrivmodel');
			$StaffRolePriv = new StaffRolePrivmodel();
			$RolePrivs = $StaffRolePriv->getRolePrivByPrivid($PrivInfo['privid']);
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
		if(file_exists($this->config->item('staff_avatar_path').$this->session->userdata('userid').'/avatar.png')){
			$staffAvatar = $this->config->item('staff_avatar_url').$this->session->userdata('userid').'/avatar.png';
		}else{
			$staffAvatar = CRM_STATIC_PATH.'dist/img/nophoto.gif';
		}
		$this->load->vars('staffAvatar', $staffAvatar);
		//当前管理员的权限节点
		$this->load->model('StaffRolePrivmodel');
		$AdminRolePriv = new StaffRolePrivmodel();
		$RolePrivs = $AdminRolePriv->getRolePrivByRoleid($this->session->userdata('roleid'));
		if (!empty($RolePrivs)) {
			$privids = array();
			foreach ($RolePrivs as $v) {
				$privids[] = $v['privid'];
			}
			$this->load->model('StaffPrivmodel');
			$AdminPriv = new StaffPrivmodel();
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