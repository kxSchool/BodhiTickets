<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends MY_Controller {

	private $staffdb;
	private $staffprivdb;
	private $staffroledb;
	private $staffroleprivdb;

	public function __construct() {
		parent::__construct();
		$this ->load->model('Staffmodel');
		$this ->staffdb = $this->Staffmodel;

		$this->load->model('StaffPrivmodel');
		$this->staffprivdb = $this->StaffPrivmodel;

		$this->load->model('StaffRolemodel');
		$this->staffroledb = $this->StaffRolemodel;

		$this->load->model('StaffRolePrivmodel');
		$this->staffroleprivdb = $this->StaffRolePrivmodel;
	}
        
    /*
     * 角色管理
     */
	public function role(){
	    $shopid = $this->session->userdata('shopid');
		$data['order'] = "roleid ASC";
        $data['shopid'] = $shopid;
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> staffroledb -> rolelist($data);
		$this -> load -> library('Page');
		$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this -> load -> view('manager/role', $dataShow);
	}
	/*
	 * 创建角色
	 */
	public function addRole(){
		$this->load->view('manager/roleAdd');
	}
	/*
	 * 管理员角色编辑
	 */
	public function editRole(){
		$roleid = $this->input->get('roleid');
		//根据角色id得到角色信息
		$AdminRoleInfo = $this->staffroledb->getRoleById($roleid);
		if(!empty($AdminRoleInfo)){
			$this->load->view('manager/roleEdit',$AdminRoleInfo);
		}else{
			$data['msg'] = '传递参数错误';
			$data['url'] = $_SERVER['HTTP_REFERER'];
			$this -> load -> view('common/error', $data);
		}
	}
	/*
	 * 保存管理员角色
	 */
	public function saveRole(){
		if(IS_POST){
			$savedata['roleid'] = $this->input->post('roleid');
			$savedata['rolename'] = $this->input->post('rolename');
			$savedata['description'] = $this->input->post('description');
			$result = $this->staffroledb->saveRole($savedata);
			if($result){
				redirect('manager/role');
			}else{
				$data['msg'] = '保存角色失败';
				$data['url'] = $_SERVER['HTTP_REFERER'];
				$this -> load -> view('common/error', $data);
			}
		}
	}
	/*
	 * 删除管理员角色
	 */
	public function delRole(){
		if(IS_AJAX){
			$roleid = $this->input->post('roleid');
			//首先判断一下该角色下面是否有会员
			$Admins = $this->staffdb->getAdminByRoleid($roleid);
			if(!empty($Admins)){
				//不可以删除
				$data = array(
					'info' => 0,
					'tip' => '有属于该角色的管理员，不可删除！'
				);
			}else{
				$result = $this->staffroledb->delRoleById($roleid);
				if($result) {
					//删除该角色对应的权限节点
					$this->staffroleprivdb->delRolePrivByRoleid($roleid);
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
			}
			echo json_encode($data);
		}
	}
	/*
	 * 管理员管理
	 */
	public function admin(){
		$data['order'] = "userid ASC";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> staffdb -> getAdminList($data);
		foreach($result['rows'] as $k=>$v){
			$RoleInfo = $this->staffroledb->getRoleById($v['roleid']);
			$result['rows'][$k]['rolename'] = $RoleInfo['rolename'];
		}
		$this -> load -> library('Page');
		$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this -> load -> view('manager/admin', $dataShow);
	}
	/*
	 * 创建管理员
	 */
	public function addAdmin(){
		//所有管理员角色
		$roleLists = $this->staffroledb->getAllRole();
		$this->load->vars('roles',$roleLists);
		$this->load->view('manager/adminAdd');
	}
	/*
	 * 管理员编辑
	 */
	public function editAdmin(){
		$id = $this->input->get('id');
		$AdminInfo = $this->staffdb->getStaffInfoByUserid($id);
		if(!empty($AdminInfo)){
			$roleLists = $this->staffroledb->getAllRole();
			$this->load->vars('roles',$roleLists);
			$this->load->view('manager/adminEdit',$AdminInfo);
		}else{
			$dataTip['msg'] = '传递参数错误';
			$dataTip['url'] = $_SERVER['HTTP_REFERER'];
			$this->load->view('common/error', $dataTip);
		}
	}
    /*
     * 保存管理员
     */
	public function saveAdmin()
	{
		if (IS_POST) {
			$data['userid'] = $this->input->post('id');
			$account = $this->input->post('account');
			if (isset($account) && !empty($account)) {
				$data['username'] = $account;
                                // 检查职员账号是否存在
                                $rst = $this->staffdb->getStaffInfoBySearchFields(['username'=>'=\''.$account.'\''],true);
                                if(!empty($rst[0]['userid']) &&  $rst[0]['userid'] != $data['userid'] ){
                                    $dataTip['msg'] = '该账号已经被占用';
                                    $dataTip['url'] = $_SERVER['HTTP_REFERER'];
                                    $this->load->view('common/error', $dataTip);
                                    return;
                                }
			} else {
				$dataTip['msg'] = '账号不能为空';
				$dataTip['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $dataTip);
				return;
			}
			$roleid = $this->input->post('roleid');
			if (isset($roleid) && !empty($roleid)) {
				$data['roleid'] = $roleid;
			} else {
				$dataTip['msg'] = '账号所属角色不能为空';
				$dataTip['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $dataTip);
				return;
			}
                        $data['realname'] = $this->input->post('realname');
			$data['mobile'] = $this->input->post('mobile');
			$data['email'] = $this->input->post('email');
			$password = $this->input->post('password');
                        $encrypt = empty($this->input->post('encrypt')) ? '':$this->input->post('encrypt');
			if (isset($password) && !empty($password)) {
				$data['password'] = md5(md5($password).$encrypt);
                                $data['encrypt'] = $encrypt;
				$confirmpassword = $this->input->post('confirmpassword');
				if ($confirmpassword !== $password) {
					$dataTip['msg'] = '两次账号不一致';
					$dataTip['url'] = $_SERVER['HTTP_REFERER'];
					$this->load->view('common/error', $dataTip);
					return;
				}
			}
			$data['register_ip'] = get_client_ip();
			$data['register_time'] = time();
			$result = $this->staffdb->saveSstaff($data);
			if ($result) {
				redirect('manager/admin');
			} else {
				$data['msg'] = '保存管理员失败';
				$data['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $data);
                                return;
			}
		}
	}
	/*
	 * 删除管理员
	 */
	public function delAdmin(){
		if(IS_AJAX){
			$id = $this->input->post('id');
			$result = $this->staffdb->delAdminById($id);
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
		$this->load->view('manager/priv');
	}
	/*
	 * 创建权限节点
	 */
	public function addPriv(){
		//权限节点列表
		$privs =$this->staffprivdb->getAllPriv();
		foreach($privs as $k=>$v){
			$privid = $v['privid'];
			$privs[$k]['id'] = $privid;
		}
		$showpriv = formatTreeLevel($privs,0);
		$showprivs = array_multi2single($showpriv);
		$this->load->vars('privs',$showprivs);
		$this->load->view('manager/privAdd');
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
				redirect('manager/priv');
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
			$this->load->view('manager/privEdit',$PrivInfo);
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
		}
	}
	/*
     * 角色分配权限
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
						exit;
					}
				}
				redirect("staff/index");
			}else{
				$dataTip['msg'] = '更新权限失败';
				$dataTip['url'] = $_SERVER['HTTP_REFERER'];
				$this->load->view('common/error', $dataTip);
				exit;
			}
		}else{
            // 获取当前店铺所有权限
            $privres = $this->staffroleprivdb->getShopPrivByShopid($this->session->userdata('shopid'));
			//系统权限节点
			$privs =$this->staffprivdb->getPrivByPrivids(array_column($privres, 'privid'));
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
			$this->load->view('manager/privAssign');
		}
	}
}
