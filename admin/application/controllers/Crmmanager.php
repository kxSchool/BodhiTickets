<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CRM权限管理模块
 */
class Crmmanager extends MY_Controller {

	private $staffdb;
	private $staffprivdb;
	private $staffroledb;
	private $staffroleprivdb;
        private $membersmodel;

	public function __construct() {
		parent::__construct();
                // 职员管理库数据连接
                $this->crmmaster = $this -> load -> database('crm_master',true);
                $this->crmslave = $this -> load -> database('crm_slave',true);
                
		$this -> load -> model('Staffmodel');
		$this -> staffdb = $this->Staffmodel;
                
		$this->load->model('StaffPrivmodel');
		$this->staffprivdb = $this->StaffPrivmodel;
                
		$this->load->model('StaffRolemodel');
		$this->staffroledb = $this->StaffRolemodel;

		$this->load->model('StaffRolePrivmodel');
		$this->staffroleprivdb = $this->StaffRolePrivmodel;
                // 商铺信息表
                $this -> load -> model('Membersmodel');
		$this -> membersmodel = $this->Membersmodel;
	}
        
	/*
	 * 管理员管理
	 */
	public function admin(){
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> staffdb -> getAdminList($data);
                // 获取角色名称
                $roledata = $this->staffroledb->getRoleById(array_column($result['rows'], 'roleid'),true);
                // 获取所在商铺信息
                $shopres = $this->membersmodel->getMembersInfoBySearchFields(['userid'=>'IN('. implode(',', array_column($result['rows'], 'shopid')).')'],true);
                $shopdata = [];
                foreach($shopres as $srkey=>$srval){
                    if(!array_key_exists($srval['userid'], $shopdata)){
                        $shopdata[$srval['userid']] = $srval;
                        continue;
                    }
                }
		foreach($result['rows'] as $k=>$v){
//			$RoleInfo = $this->staffroledb->getRoleById($v['roleid']);
			$result['rows'][$k]['rolename'] = $roledata[$v['roleid']]['rolename'];
                        $result['rows'][$k]['shopname'] = $shopdata[$v['shopid']]['realname'];
//                        $result['rows'][$k]['description'] = $RoleInfo['description'];
		}
		$this -> load -> library('Page');
		$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this -> load -> view('crmmanager/admin', $dataShow);
	}
        
	/*
	 * 创建管理员
	 */
	public function addAdmin(){
            $this->load->view('crmmanager/adminAdd');
	}
        
	/*
	 * 管理员编辑
	 */
	public function editAdmin(){
            $id = $this->input->get('staffid');
            $AdminInfo = $this->staffdb->getStaffInfoByUserid($id);
            if(!empty($AdminInfo)){
                $this->load->view('crmmanager/adminEdit',$AdminInfo);
            }else{
                $dataTip['msg'] = '传递参数错误';
                $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                $this->load->view('common/error', $dataTip);
            }
	}
        
        /*
         * 添加或者编辑管理员信息
         */
	public function saveAdmin()
	{
            if (IS_POST) {
                $data = []; // 保存数据
                $data['userid'] = !empty($this->input->post('userid')) ? $this->input->post('userid') : 0;
                // 检查商户id号
                $data['shopid'] = !empty($this->input->post('shopid')) ? $this->input->post('shopid') : 0;
                if(!$data['shopid'] || !is_numeric($data['shopid'])){
                    $dataTip['msg'] = '商户号无效!';
                    $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                    $this->load->view('common/error', $dataTip);
                    return;
                }
                $data['username'] = !empty($this->input->post('account')) ? $this->input->post('account') : false;
                if(!$data['username']){
                    $dataTip['msg'] = '商户管理员账号不能为空!';
                    $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                    $this->load->view('common/error', $dataTip);
                    return;
                }
                // 检查管理员账号是否存在
                $rst = $this->staffdb->getStaffInfoBySearchFields(['username'=>'=\''.$data['username'].'\'','shopid'=>'='.$data['shopid']]);
                if($rst && !$data['userid']){
                    $dataTip['msg'] = '账号已在本商户注册!';
                    $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                    $this->load->view('common/error', $dataTip);
                    return;
                }
                // 角色处理
                $data['roleid'] = !empty($this->input->post('roleid')) ? $this->input->post('roleid') : 0;
                if(!$data['roleid']){ // 如果角色权限不存在的话新建
                    $data['roleid'] = $this->staffroledb->saveRole(['rolename'=>'CRM商铺管理员','shopid'=>$data['shopid'],'isshow'=>0,'isadmin'=>1]);
                    if(!$data['roleid']){
                        $dataTip['msg'] = '操作失败,稍后重试!';
                        $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                        $this->load->view('common/error', $dataTip);
                        return;
                    }
                }
                $data['realname'] = $this->input->post('realname');
                $data['mobile'] = $this->input->post('mobile');
                $data['email'] = $this->input->post('email');
                $data['isadmin'] = 1; // 是否是管理员
                $password = $this->input->post('password');
                $encrypt = empty($this->input->post('encrypt')) ? '':$this->input->post('encrypt');
                if (isset($password) && !empty($password)) {
                    $data['password'] = md5(md5($password).$encrypt);
                    $data['encrypt'] = $encrypt;
                    $confirmpassword = $this->input->post('confirmpassword');
                    if ($confirmpassword !== $password) {
                        $dataTip['msg'] = '密码和确认密码不一致';
                        $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                        $this->load->view('common/error', $dataTip);
                        return;
                    }
                }
                $data['register_ip'] = get_client_ip();
                $data['register_time'] = time();
                $data['addtime'] = date('Y-m-d H:i:s',time());
                $result = $this->staffdb->saveSstaff($data);
                if ($result) {
                    redirect('crmmanager/admin');
                } else {
                    $data['msg'] = !$data['userid'] ? '添加管理员失败!': '保存管理员失败!';
                    $data['url'] = $_SERVER['HTTP_REFERER'];
                    $this->load->view('common/error', $data);
                    return;
                }
            }else{
                $data['msg'] = '非法访问';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this->load->view('common/error', $data);
                return;
            }
	}
        
	/*
	 * 锁定或者结算管理员
	 */
	public function delAdmin(){
		if(IS_AJAX){
			$userid = $this->input->post('userid');
                        if(!$userid){
                            echo json_encode(['info'=>0,'tip'=>'用户id无效!']);
                            return;
                        }
                        $status = $this->input->post('status');
                        if($status){
                            $status = 0;
                        }else{
                            $status = 1;
                        }
			$result = $this->staffdb->saveStaffInfo(['userid'=>$userid,'disabled'=>$status]);
			if($result) {
				$data = array(
					'info' => 1,
					'tip' => '操作成功'
				);
			}else{
				$data = array(
					'info' => 0,
					'tip' => '操作失败'
				);
			}
			echo json_encode($data);
                        return;
		}
	}
        
	/*
	 * 管理员权限管理
	 */
	public function priv(){
		$adminPriv = $this->staffprivdb->getAllPriv();
		foreach($adminPriv as $k=>$v){
			$privid = $v['privid'];
			$adminPriv[$k]['id'] = $privid;
		}
		$priv = formatTreeLevel($adminPriv,0);
		$showpriv = array_multi2single($priv);
		$this->load->vars('showpriv',$showpriv);
		$this->load->view('crmmanager/priv');
	}
        
	/*
	 * CRM节点创建
	 */
	public function Addpriv(){
		//权限节点列表
		$privs =$this->staffprivdb->getAllPriv();
		foreach($privs as $k=>$v){
			$privid = $v['privid'];
			$privs[$k]['id'] = $privid;
		}
		$showpriv = formatTreeLevel($privs,0);
		$showprivs = array_multi2single($showpriv);
		$this->load->vars('privs',$showprivs);
		$this->load->view('crmmanager/privAdd');
	}
        
        /*
        * 保存权限节点
        */
	public function savePriv(){
		if(IS_POST){
			$savedata['privid'] = $this->input->post('privid');
			$savedata['parentid'] = $this->input->post('parentid');
			$savedata['name'] = $this->input->post('name');
			$savedata['c'] = $this->input->post('c');
			$savedata['a'] = $this->input->post('a');
			$savedata['style'] = $this->input->post('style');
                        $savedata['data'] = $this->input->post('data');
			$result = $this->staffprivdb->savePriv($savedata);
			if($result){
				redirect('crmmanager/priv');
			}else{
				$data['msg'] = '保存节点失败';
				$data['url'] = $_SERVER['HTTP_REFERER'];
				$this -> load -> view('common/error', $data);
			}
		}
	}
        
	/*
	 * 编辑权限节点
	 */
	public function editPriv(){
		$privid = $this->input->get('privid');
		$PrivInfo =$this->staffprivdb->getPrivById($privid);
		if(!empty($PrivInfo)){
			$privs =$this->staffprivdb->getAllPriv();
			foreach($privs as $k=>$v){
				$privid = $v['privid'];
				$privs[$k]['id'] = $privid;
			}
			$showpriv = formatTreeLevel($privs,0);
			$showprivs = array_multi2single($showpriv);
			$this->load->vars('privs',$showprivs);
			$this->load->view('crmmanager/privEdit',$PrivInfo);
		}else{
			$dataTip['msg'] = '传递参数错误';
			$dataTip['url'] = $_SERVER['HTTP_REFERER'];
			$this->load->view('common/error', $dataTip);
		}
	}
        
        /*
         * 删除权限节点
         */
        public function delPriv(){
            if(IS_AJAX){
                $privid = $this->input->post('privid');
                //首先判断一下，该节点是否有下级节点
                $childPriv = $this->staffprivdb->getChildPrivById($privid);
                if(!empty($childPriv)){
                    $data = array(
                        'info' => 0,
                        'tip' => '该节点下有子节点不可删除'
                    );
                }else{
                    $result = $this->staffprivdb->delPrivById($privid);
                    if($result){
                        $data = array(
                            'info' => 1,
                            'tip' => '操作成功'
                        );
                        $this->staffroleprivdb->delRolePrivByPrivid($privid);
                    }else{
                        $data = array(
                            'info' => 0,
                            'tip' => '操作失败'
                        );
                    }
                }
                echo json_encode($data);
            }else{
                $data = array(
                    'info' => 0,
                    'tip' => '操作失败'
                );
                echo json_encode($data);
            }
            return;
        }
        
        /*
         * CRM商户管理员权限分配
         */
	public function assignPriv(){
            $roleid = $this->input->get('roleid');
            if(IS_POST){
                //首先删除当前角色的所有权限节点
                $result = $this->staffroleprivdb->delRolePrivByRoleid($roleid);
                if($result){
                    //插入所有选择的权限节点
                    $privids = $this->input->post();
                    if(isset($privids['privid']) && !empty($privids['privid'])){
                        foreach($privids['privid'] as $k=>$v){
                            $savedata[$k]['roleid'] = $roleid;
                            $savedata[$k]['privid'] = $v;
                        }
                        //批量添加角色的权限节点
                        $result = $this->staffroleprivdb->batchInsertRolePriv($savedata);
                        if(!$result){
                            $dataTip['msg'] = '更新权限失败';
                            $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                            $this->load->view('common/error', $dataTip);
                            return;
                        }
                    }
                    redirect("crmmanager/admin");
                }else{
                    $dataTip['msg'] = '更新权限失败';
                    $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                    $this->load->view('common/error', $dataTip);
                    return;
                }
            }else{
                //系统权限节点
                $privs =$this->staffprivdb->getAllPriv();
                foreach($privs as $k=>$v){
                    $privid = $v['privid'];
                    $privs[$k]['id'] = $privid;
                }
                $showpriv = formatTreeLevel($privs,0);
                $showprivs = array_multi2single($showpriv);
                $this->load->vars('privs',$showprivs);
                //当前角色的权限
                $nowPriv = $this->staffroleprivdb->getRolePrivByRoleid($roleid);
                if(!empty($nowPriv)){
                    foreach($nowPriv as $k=>$v){
                        $showNowPriv[] = $v['privid'];
                    }
                    $this->load->vars('nowPriv',$showNowPriv);
                }
                $this->load->view('crmmanager/privAssign');
            }
	}
}
