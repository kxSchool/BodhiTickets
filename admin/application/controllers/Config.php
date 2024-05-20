<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Controller {

	private $configdb;
	private $paymentdb;
	private $tagdb;
	private $tagcategorydb;

	public function __construct() {
		parent::__construct();
		$this -> load -> model('Configmodel');
		$this -> configdb = $this->Configmodel;
		$this->load->model('Paymentmodel');
		$this->paymentdb = $this->Paymentmodel;
		$this->load->model('Tagmodel');
		$this->tagdb = $this->Tagmodel;
		$this->load->model('TagCategorymodel');
		$this->tagcategorydb = $this->TagCategorymodel;
	}
	/*
	 * 网站配置
	 */
	public function system() {
		if(IS_POST){
			$data['title'] = $this->input->post('title');
			$data['keywords'] = $this->input->post('keywords');
			$data['description'] = $this->input->post('description');
			$data['log'] = $this->input->post('log');
			$saveData = array2string($data);
			$this->configdb->saveConfigByName('system',$saveData);
			redirect('config/system');
		}else{
			$systemValue = $this->configdb->getConfigByName('system');
			if(!empty($systemValue)){
				$websiteInfo = string2array($systemValue['value']);
				$assignVars = array();
				foreach($websiteInfo as $k=>$v){
					$assignVars[$k] = $v;
				}
				//将站点logo处理一下
				if(isset($assignVars['log']) && !empty($assignVars['log'])){
					if(file_exists($this->config->item('logo_path').$assignVars['log'])){
						$assignVars['log_show'] = $this->config->item('logo_url').$assignVars['log'];
					}
				}
				$this->load->vars('websiteInfo',$assignVars);
			}
			$this -> load -> view('config/system');
		}
	}
	/*
	 * 邮件配置
	 */
	public function mail() {
		if(IS_POST){
			$data['protocol'] = $this->input->post('protocol');
			$data['smtp_host'] = $this->input->post('smtp_host');
			$data['smtp_user'] = $this->input->post('smtp_user');
			$data['smtp_pass'] = $this->input->post('smtp_pass');
			$data['smtp_port'] = $this->input->post('smtp_port');
			$data['smtp_timeout'] = $this->input->post('smtp_timeout');
			$data['smtp_keepalive'] = $this->input->post('smtp_keepalive');
			$data['smtp_crypto'] = $this->input->post('smtp_crypto');
			$data['validate'] = $this->input->post('validate');
			$saveData = array2string($data);
			$this->configdb->saveConfigByName('mail',$saveData);
			redirect('config/mail');
		}else{
			$systemValue = $this->configdb->getConfigByName('mail');
			if(!empty($systemValue)){
				$websiteInfo = string2array($systemValue['value']);
				$assignVars = array();
				foreach($websiteInfo as $k=>$v){
					$assignVars[$k] = $v;
				}
				//将站点logo处理一下
				if(isset($assignVars['log']) && !empty($assignVars['log'])){
					if(file_exists($this->config->item('logo_path').$assignVars['log'])){
						$assignVars['log_show'] = $this->config->item('logo_url').$assignVars['log'];
					}
				}
				$this->load->vars('mailInfo',$assignVars);
			}
			$this -> load -> view('config/mail');
		}
	}
	/*
	 * 短信平台配置
	 */
	public function sms() {
		if(IS_POST){
			$data['userid'] = $this->input->post('userid');
			$data['account'] = $this->input->post('account');
			$data['password'] = $this->input->post('password');
			$data['sign'] = $this->input->post('sign');
			$saveData = array2string($data);
			$this->configdb->saveConfigByName('sms',$saveData);
			redirect('config/sms');
		}else{
			$systemValue = $this->configdb->getConfigByName('sms');
			if(!empty($systemValue)){
				$websiteInfo = string2array($systemValue['value']);
				$assignVars = array();
				foreach($websiteInfo as $k=>$v){
					$assignVars[$k] = $v;
				}
				//将站点logo处理一下
				if(isset($assignVars['log']) && !empty($assignVars['log'])){
					if(file_exists($this->config->item('logo_path').$assignVars['log'])){
						$assignVars['log_show'] = $this->config->item('logo_url').$assignVars['log'];
					}
				}
				$this->load->vars('smsInfo',$assignVars);
			}
			$this -> load -> view('config/sms');
		}
	}
	/*
	 * 支付方式配置
	 */
	public function payment(){
		$data['order'] = "pay_id ASC";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> paymentdb -> paymentlist($data);
		$this -> load -> library('Page');
		$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this -> load -> view('config/payment', $dataShow);
	}
	/*
	 * 添加支付方式
	 */
	public function addPayment(){
		$this->load->view('config/paymentAdd');
	}
	/*
	 * 编辑支付方式
	 */
	public function editPayment(){
		$pay_id = $this->input->get('pay_id');
		$paymentInfo = $this->paymentdb->getPaymentById($pay_id);
		if(!empty($paymentInfo)){
			//将支付方式配置项处理一下
			if(!empty($paymentInfo['config'])){
				$paymentInfo['config'] = string2array($paymentInfo['config']);
				$new_config = '';
				foreach($paymentInfo['config'] as $k=>$v){
					$new_config[] = $k.'='.$v;
				}
				$paymentInfo['show_config'] = implode("\n",$new_config);
			}
			$this->load->view('config/paymentEdit',$paymentInfo);
		}else{
			$data['msg'] = '传递参数错误';
			$data['url'] = $_SERVER['HTTP_REFERER'];
			$this -> load -> view('common/error', $data);
		}
	}
	/*
     * 保存支付方式
     */
	public function savePayment(){
		if(IS_POST){
			$saveData['pay_id'] = $this->input->post('pay_id');
			$saveData['pay_name'] = $this->input->post('pay_name');
			$config = trim($this->input->post('config'));
			//将配置项组合一下
			if(!empty($config)){
				$explode_config = explode("\n",$config);
				$new_config = array();
				foreach($explode_config as $v){
					$temp = explode("=",$v);
					$new_config[trim($temp[0])] = trim($temp[1]);
				}
				$saveData['config'] = array2string($new_config);
			}else{
				$saveData['config'] = '';
			}
			$saveData['pay_fee'] = $this->input->post('pay_fee');
			$saveData['pay_desc'] = $this->input->post('pay_desc');
			$saveData['author'] = $this->input->post('author');
			$saveData['sort'] = $this->input->post('sort');
			$saveData['client_type'] = $this->input->post('client_type');
			$result = $this->paymentdb->savePayment($saveData);
			if($result){
				redirect('config/payment');
			}else{
				$data['msg'] = '保存支付方式失败';
				$data['url'] = $_SERVER['HTTP_REFERER'];
				$this -> load -> view('common/error', $data);
			}
		}
	}
	/*
     * 改变支付方式状态
     */
	public function disabledPayment(){
		if(IS_AJAX){
			$pay_id = $this->input->post('pay_id');
			$disabled = $this->input->post('disabled');
			//首先判断一下支付方式是否存在
			$paymentInfo = $this->paymentdb->getPaymentById($pay_id);
			if(!empty($paymentInfo)){
				//改变支付方式状态
				$updateData['pay_id'] = $pay_id;
				$updateData['disabled'] = $disabled;
				$result = $this->paymentdb->savePayment($updateData);
				if($result){
					$data = array(
						'info' => 1,
						'tip' => '更新成功'
					);
				}else{
					$data = array(
						'info' => 0,
						'tip' => '更新失败'
					);
				}
			}else{
				$data = array(
					'info' => 0,
					'tip' => '传递参数错误'
				);
			}
			echo json_encode($data);
		}
	}
	/*
	 * 删除支付方式
	 */
	public function delPayment(){
		if(IS_AJAX){
			$pay_id = $this->input->post('pay_id');
			$result = $this->paymentdb->delPaymentById($pay_id);
			if($result){
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
	 * 系统标签管理
	 */
	public function tag(){
		//首先得到标签分类列表
		$tagCategorys = $this->tagcategorydb->getTagCategoryList();
		if(!empty($tagCategorys)){
			//标签分类下的所有标签
			foreach($tagCategorys as $k=>$v){
				$tags = $this->tagdb->getTagByCatid($v['catid']);
				if(!empty($tags)){
					$tagCategorys[$k]['tags'] = $tags;
				}
			}
			$this->load->vars('tagCategorys',$tagCategorys);
		}
		$this->load->view('config/tag');
	}
	/*
	 * 添加分类标签
	 */
	public function addTagCategory(){
		if(IS_POST){
			//第一步：先保存标签分类
			$catname = $this->input->post('catname');
			if(!empty($catname)){
				$saveCategory['catname'] = $catname;
				$result = $this->tagcategorydb->saveTagCategory($saveCategory);
				if($result){
					//第二步：插入标签
					$tags = $this->input->post('tags');
					if(!empty($tags)){
						//将传递过来的标签内容分析组合一下
						$search = array(' ','\n','\r');
						$tag_arr = explode("；",str_replace($search,'',$tags));//使用中文的分号分割的
						if(is_array($tag_arr)){
							$saveTag = array();
							foreach($tag_arr as $k=>$v){
								$saveTag[$k]['catid'] = $result;
								$saveTag[$k]['tagname'] = $v;
							}
							//批量保存
							$re = $this->tagdb->batchSaveTag($saveTag);
							if($re){
								redirect('config/tag');
							}
						}
					}
				}
			}
			$data['msg'] = '添加标签分类失败';
			$data['url'] = $_SERVER['HTTP_REFERER'];
			$this -> load -> view('common/error', $data);
		}else{
			$this->load->view('config/tagCategoryAdd');
		}
	}
	/*
	 * 删除标签
	 */
	public function delTag(){
		if(IS_AJAX){
			$tagid = $this->input->post('tagid');
			$tagInfo = $this->tagdb->getTagById($tagid);
			if(!empty($tagInfo)){
				$result = $this->tagdb->delTagById($tagid);
				if($result){
					$data = array(
						'info'=>1,
						'tip'=>'删除标签成功'
					);
				}else{
					$data = array(
						'info'=>0,
						'tip'=>'删除标签失败'
					);
				}
			}else{
				$data = array(
					'info'=>0,
					'tip'=>'参数传递错误'
				);
			}
			echo json_encode($data);
		}
	}
	/*
	 * 删除标签分类
	 */
	public function delTagCategory(){
		if(IS_AJAX){
			$catid = $this->input->post('catid');
			//判断一下分类下是否有标签
			$tags = $this->tagdb->getTagByCatid($catid);
			if(!empty($tags)){
				//不可以删除
				$data = array(
					'info' => 0,
					'tip' => '分类下有标签，不可删除'
				);
			}else{
				$result = $this->tagcategorydb->delTagCategoryByCatid($catid);
				if($result){
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
	 * 单个保存标签
	 */
	public function saveTag(){
		$saveData['tagid'] = $this->input->post('tagid');
		$saveData['tagname'] = $this->input->post('tagname');
		if(!empty($saveData['tagname'])){
			if(empty($saveData['tagid'])){//这是要添加标签的节奏啊
				$saveData['catid'] = $this->input->post('catid');
			}
			$result = $this->tagdb->saveTag($saveData);
			if($result){
				if($saveData['tagid']){
					$data = array(
						'info'=>1,
						'tip'=>'更新成功'
					);
				}else{
					$data = array(
						'info'=>1,
						'tip'=>'插入新标签成功',
						'tagid'=>$result
					);
				}
			}else{
				$data = array(
					'info'=>0,
					'tip'=>'更新失败'
				);
			}
		}else{
			$data = array(
				'info'=>0,
				'tip'=>'标签内容不能为空'
			);
		}
		echo json_encode($data);
	}
}
