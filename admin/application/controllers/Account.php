<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	private $accountdb;
	private $membersdb;
	public function __construct() {
		parent::__construct();
		$this -> load -> model('Accountmodel');
		$this -> accountdb = $this->Accountmodel;

		$this -> load -> model('Membersmodel');
		$this -> membersdb = $this->Membersmodel;
	}
	//资产明细
	public function accountLog(){
		if($this->input->post('dosearch')){
			$inOut = $this->input->post('inOut');
			$user_id = $this->input->post('user_id');
		}else{
			$inOut = $this->input->get('inOut');
			$user_id = $this->input->get('user_id');
		}
		if($inOut != 0){
			if($inOut == 1){//收入
				$data['where']['user_money >'] = 0;
			}
			if($inOut == 2){//支出
				$data['where']['user_money <='] = 0;
			}
			$parameter['inOut'] = $inOut;
			$this->load->vars('inOut',$inOut);
		}
		if(isset($user_id) && !empty($user_id)){
			$data['where']['user_id'] = $user_id;
			$parameter['user_id'] = $user_id;
			$this->load->vars('user_id',$user_id);
		}
		$data['order'] = "change_time desc";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this->accountdb->accountLogList($data);
		foreach($result['rows'] as $k=>$v){
			$memberInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
			if($memberInfo['type'] == 1){
				$result['rows'][$k]['username'] = $memberInfo['username'].'（买家）';
			}elseif($memberInfo['type'] == 2){
				$result['rows'][$k]['username'] = $memberInfo['username'].'（商铺）';
			}
		}
		$this->load->library('Page');
		if(isset($parameter)){
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
		}else{
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		}
		$pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject->show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this->load->view('account/accountLog',$dataShow);
	}
	//提现管理
	public function userAccount(){
		if($this->input->post('dosearch')){
			$payment = $this->input->post('payment');
			$is_paid = $this->input->post('is_paid');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
		}else{
			$payment = $this->input->get('payment');
			$is_paid = $this->input->get('is_paid');
			$start_time = $this->input->get('start_time');
			$end_time = $this->input->get('end_time');
		}
		if(isset($payment) && $payment != 0){
			if($payment == 1){//提现至支付宝
				$data['where']['payment'] = '支付宝';
			}elseif($payment == 2){//提现至银行卡
				$data['where']['payment !='] = '支付宝';
			}
			$parameter['payment'] = $payment;
			$this->load->vars('payment',$payment);
		}
		if(isset($start_time) && !empty($start_time)){
			$data['where']['add_time >='] = strtotime($start_time);
			$parameter['start_time'] = $start_time;
			$this->load->vars('start_time',$start_time);
		}
		if(isset($end_time) && !empty($end_time)){
			$data['where']['add_time <='] = strtotime($end_time);
			$parameter['end_time'] = $end_time;
			$this->load->vars('end_time',$end_time);
		}
		if(isset($is_paid) && ($is_paid == 0 || $is_paid == 1)){
			$data['where']['is_paid'] = $is_paid;
			$parameter['is_paid'] = $is_paid;
			$this->load->vars('is_paid',$is_paid);
		}
		$data['order'] = "add_time desc";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this->accountdb->userAccountList($data);
		foreach($result['rows'] as $k=>$v){
			$memberInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
			if($memberInfo['type'] == 1){
				$result['rows'][$k]['username'] = $memberInfo['username'].'（买家）';
			}elseif($memberInfo['type'] == 2){
				$result['rows'][$k]['username'] = $memberInfo['username'].'（商铺）';
			}
		}
		$this->load->library('Page');
		if(isset($parameter)){
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
		}else{
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		}
		$pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject->show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this->load->view('account/userAccount',$dataShow);
	}
	//批量进行提现申请处理
	public function batchUpdateUserAccount(){
		if(IS_AJAX){
			$ids = $this->input->post('ids');
			$ids_array = explode(',',$ids);
			if(is_array($ids_array)){
				foreach($ids_array as $k=>$v){
					$userAccountInfo = $this->accountdb->getUserAccountById($v);
					if(!empty($userAccountInfo)){
						$memberInfo = $this->membersdb->getMemberInfoByUserid($userAccountInfo['user_id']);
						//1、首先扣除账户中对应的金额
						$updateMember['userid'] = $memberInfo['userid'];
						$updateMember['money'] = $memberInfo['money'] - $userAccountInfo['amount'];
						$this->membersdb->updateMemberInfo($updateMember);
						//2、在资金流水表中添加记录
						$insertAccountLog['log_sn'] = account_log_sn();
						$insertAccountLog['user_id'] = $userAccountInfo['user_id'];
						$insertAccountLog['user_money'] = -$userAccountInfo['amount'];
						$insertAccountLog['change_time'] = time();
						$insertAccountLog['change_desc'] = $userAccountInfo['payment'].':<br>'.$userAccountInfo['account'].'提现成功';
						$insertAccountLog['status_desc'] = '提现成功';
						$this->accountdb->insertAccountLog($insertAccountLog);
						//3、更改提现申请表中对应的状态
						$updateUserAccount['id'] = $userAccountInfo['id'];
						$updateUserAccount['user_id'] = $userAccountInfo['user_id'];
						$updateUserAccount['admin_user'] = $this->session->userdata('account');
						$updateUserAccount['paid_time'] = time();
						$updateUserAccount['is_paid'] = 1;
						$this->accountdb->updateUserAccount($updateUserAccount);
					}
				}
				$data = array(
					'info' => 1,
					'tip' => '操作成功'
				);
			}else{
				$data = array(
					'info' => 0,
					'tip' => '传递参数错误'
				);
			}
			echo json_encode($data);
		}
	}
	//提现申请详情
	public function userAccountDetail(){
		if(IS_AJAX){
			$id = $this->input->post('id');
			$userAccountInfo = $this->accountdb->getUserAccountById($id);
			if(!empty($userAccountInfo)){
				$memberInfo = $this->membersdb->getMemberInfoByUserid($userAccountInfo['user_id']);
				$userAccountInfo['username'] = !empty($memberInfo['realname']) ? $memberInfo['realname'] : $memberInfo['username'];
				$userAccountInfo['add_time'] = date('Y-m-d',$userAccountInfo['add_time']);
				$data = array(
					'info' => 1,
					'data' => $userAccountInfo
				);
			}else{
				$data = array(
					'info' => 0,
					'tip' => '传递参数错误'
				);
			}
			echo json_encode($data);
		}
	}
	//导出提现申请excel表格
	public function exportAccountExcel(){
		$payment = $this->input->get('payment');
		$is_paid = $this->input->get('is_paid');
		$start_time = $this->input->get('start_time');
		$end_time = $this->input->get('end_time');
		if(isset($payment) && $payment != 0){
			if($payment == 1){//提现至支付宝
				$data['where']['payment'] = '支付宝';
			}elseif($payment == 2){//提现至银行卡
				$data['where']['payment !='] = '支付宝';
			}
		}
		if(isset($start_time) && !empty($start_time)){
			$data['where']['add_time >='] = strtotime($start_time);
		}
		if(isset($end_time) && !empty($end_time)){
			$data['where']['add_time <='] = strtotime($end_time);
		}
		if(isset($is_paid) && ($is_paid == 0 || $is_paid == 1)){
			$data['where']['is_paid'] = $is_paid;
		}
		$data['order'] = "add_time desc";
		$result = $this->accountdb->exportAccountExcel($data);
		if(!empty($result)){
			header("Content-Type: application/vnd.ms-excel");
			header("Accept-Ranges:bytes");
			header("Content-Disposition:attachment; filename=提现申请.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo '<table style="border-spacing:0;border-collapse:collapse;border:1px solid #f4f4f4;">';
			echo '<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
			echo '<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">';
			echo '<th style="border: 1px solid #f4f4f4;">ID</th>';
			echo '<th style="border: 1px solid #f4f4f4;">用户</th>';
			echo '<th style="border: 1px solid #f4f4f4;">提现金额</th>';
			echo '<th style="border: 1px solid #f4f4f4;">真实姓名</th>';
			echo '<th style="border: 1px solid #f4f4f4;">提现方式</th>';
			echo '<th style="border: 1px solid #f4f4f4;">提现账号</th>';
			echo '<th style="border: 1px solid #f4f4f4;">申请时间</th>';
			echo '<th style="border: 1px solid #f4f4f4;">处理状态</th>';
			echo '<th style="border: 1px solid #f4f4f4;">处理时间</th>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			foreach($result as $v){
				$memberInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
				$memberInfo['username'] = !empty($memberInfo['realname']) ? $memberInfo['realname'] : $memberInfo['username'];
				echo '<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['id'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$memberInfo['username'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['amount'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['realname'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['payment'].'</td>';
				echo '<td style="border:1px solid #f4f4f4;vnd.ms-excel.numberformat:@">'.$v['account'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.date('Y-m-d',$v['add_time']).'</td>';
				if($v['is_paid'] == 0){
					echo '<td style="border: 1px solid #f4f4f4;">未处理</td>';
					echo '<td style="border: 1px solid #f4f4f4;"></td>';
				}elseif($v['is_paid'] == 1){
					echo '<td style="border: 1px solid #f4f4f4;">已处理</td>';
					echo '<td style="border: 1px solid #f4f4f4;">'.date('Y-m-d',$v['paid_time']).'</td>';
				}
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		}
	}
}
