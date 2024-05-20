<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketsOrder extends MY_Controller {
	private $orderdb;
	private $membersdb;
	private $paymentdb;
	private $tagdb;
	private $userbonusdb;
	private $accountdb;
	public function __construct() {
		parent::__construct();
		$this->load->model('Ordermodel');
		$this->orderdb = $this->Ordermodel;

		$this->load->model('Membersmodel');
		$this->membersdb = $this->Membersmodel;

		$this->load->model('Paymentmodel');
		$this->paymentdb = $this->Paymentmodel;

		$this->load->model('Tagmodel');
		$this->tagdb = $this->Tagmodel;

		$this->load->model('UserBonusemodel');
		$this->userbonusdb = $this->UserBonusemodel;

		$this->load->model('Accountmodel');
		$this->accountdb = $this->Accountmodel;

	}

	/*
	 * �����б�
	 */
	public function index() {
		if($this->input->post('dosearch')){
			$type = $this->input->post('type');//������ʽ
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$order_sn = $this->input->post('order_sn');
		}else{
			$type = $this->input->get('type');//������ʽ
			$start_time = $this->input->get('start_time');
			$end_time = $this->input->get('end_time');
			$order_sn = $this->input->get('order_sn');
		}
		//����ʱ���ѯ
		if(isset($type) && !empty($type)){
			//��ʼ��ѯʱ��
			if(isset($start_time) && !empty($start_time)){
				$parameter['start_time'] = $start_time;
				$this->load->vars('start_time',$start_time);
				if($type == 1){//���¶���ʱ��
					$data['where']['add_time >='] = strtotime($start_time);
				}elseif($type == 2){//����ѯ��ʼʱ��
					$data['whereZiXun']['start_time >='] = strtotime($start_time);
				}
			}
			//������ѯʱ��
			if(isset($end_time) && !empty($end_time)){
				$parameter['end_time'] = $end_time;
				$this->load->vars('end_time',$end_time);
				if($type == 1){//���¶���ʱ��
					$data['where']['add_time <='] = strtotime($end_time);
				}elseif($type == 2){//����ѯ��ʼʱ��
					$data['whereZiXun']['start_time <='] = strtotime($end_time);
				}
			}
			$this->load->vars('type',$type);
			$parameter['type'] = $type;
		}
		if(isset($order_sn) && !empty($order_sn)){
			$data['where']['order_sn'] = $order_sn;
			$this->load->vars('order_sn',$order_sn);
			$parameter['order_sn'] = $order_sn;
		}

		$data['order'] = "order_id DESC";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> orderdb -> orderlist($data);
		$this->load->vars('order_status',$this->config->item('order_status'));
		$this->load->vars('shipping_status',$this->config->item('shipping_status'));
		$this->load->vars('pay_status',$this->config->item('pay_status'));
		$this->load->vars('refund_status',$this->config->item('refund_status'));
		if(!empty($result['rows'])){
			foreach($result['rows'] as $k=>$v){
				//�¶�����Ա��Ϣ
				$membersInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
				$result['rows'][$k]['user_name'] = $membersInfo['username'];
				$sellerInfo = $this->membersdb->getMemberInfoByUserid($v['seller_id']);//�����˺���Ϣ
				$result['rows'][$k]['seller_name'] = $sellerInfo['username'];

				//����order_id���õ�order_goods���е���Ϣ
				$orderGoodsInfo = $this->orderdb->getOrderGoodsByOrderId($v['order_id']);
				if(!empty($orderGoodsInfo)){
					$goods_attr = string2array($orderGoodsInfo['goods_attr']);
				}
				//���ʽ
				$payment = '';
				if($v['order_status'] == 1 && $v['pay_status'] == 2){
					if($v['bonus_id'] != 0){
						$payment = '��ȯ';
						if( $v['pay_id'] != 0){
							$payment .= $payment.'+'.$v['pay_name'];
						}
					}else{
						$payment = $v['pay_name'];
					}
				}
				$result['rows'][$k]['payment'] = $payment;
			}
		}
		$this -> load -> library('Page');
		if(isset($parameter)){
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
		}else{
			$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		}
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows'],'totalNumber'=>$result['total']);
		$this -> load -> view('TicketsOrder/order', $dataShow);
	}
	//���ݶ���id���õ���������
	public function ajaxGetOrderInfo(){
		if(IS_AJAX){
			$order_id = $this->input->post('order_id');
			$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
			if(!empty($orderInfo)){
				$returnResult = array('info'=>1,'data'=>$orderInfo);
			}else{
				$returnResult = array('info'=>0,'tip'=>'�������ݴ���');
			}
			echo json_encode($returnResult);
		}
	}
	//ͬ��ȡ������
	public function ajaxRefundOrder(){
		if(IS_AJAX){
			$order_id = $this->input->post('order_id');
			$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
			if(!empty($orderInfo) && $orderInfo['order_status'] !=2 && $orderInfo['pay_status'] == 2 && $orderInfo['refund_status'] != 0){
				$orderGoods = $this->orderdb->getOrderGoodsByOrderId($order_id);
				//��ҵ���Ϣ
				$memberInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['user_id']);
				if($orderInfo['bonus_id'] && $orderInfo['bonus'] == 0){
					$changeMoney  = $memberInfo['money'] + $orderInfo['goods_amount'];
				}else{
					$changeMoney = $memberInfo['money'] + ($orderInfo['goods_amount'] - $orderInfo['bonus']);
					//����ȯ��ԭ
					$updateUserBonus['bonus_id'] = $orderInfo['bonus_id'];
					$updateUserBonus['order_id'] = 0;
					$updateUserBonus['used_time'] = 0;
					$this->userbonusdb->updateUserBonsu($updateUserBonus);
				}
				//���������ֱ���˻أ���ԱǮ��
				$updateMember['userid'] = $memberInfo['userid'];
				$updateMember['money'] = $changeMoney;
				//���¶���״̬
				$updateOrder['order_id'] = $order_id;
				$updateOrder['order_status'] = 2;
				//���¿��״̬

				//����ʽ���ˮ��־
				$insertAccount['log_sn'] = account_log_sn();
				$insertAccount['user_id'] = $orderInfo['user_id'];
				$insertAccount['user_money'] = $orderInfo['goods_amount'];
				$insertAccount['change_time'] = time();
				$insertAccount['change_desc'] = '���붩����'.$orderInfo['order_sn'].'�˿�';
				$insertAccount['status_desc'] = '�˿�ɹ�';
				if($this->membersdb->updateMemberInfo($updateMember) && $this->orderdb->updateOrderInfo($updateOrder) && $this->orderdb->setProductNumberOne($orderGoods['product_id']) && $this->accountdb->insertAccountLog($insertAccount)){
					$returnResult = array('info'=>1,'tip'=>'�����˿�ɹ�');
				}else{
					$returnResult = array('info'=>0,'tip'=>'�����˿�ʧ��');
				}
			}else{
				$returnResult = array('info'=>0,'tip'=>'�����˿�ʧ��');
			}
			echo json_encode($returnResult);
		}
	}
	//��������Excel
	public function exportOrderExcel(){
		$type = $this->input->get('type');//������ʽ
		$start_time = $this->input->get('start_time');
		$end_time = $this->input->get('end_time');
		$order_sn = $this->input->get('order_sn');
		//����ʱ���ѯ
		if(isset($type) && !empty($type)){
			//��ʼ��ѯʱ��
			if(isset($start_time) && !empty($start_time)){
				if($type == 1){//���¶���ʱ��
					$data['where']['add_time >='] = strtotime($start_time);
				}elseif($type == 2){//����ѯ��ʼʱ��
					$data['whereZiXun']['start_time >='] = strtotime($start_time);
				}
			}
			//������ѯʱ��
			if(isset($end_time) && !empty($end_time)){
				if($type == 1){//���¶���ʱ��
					$data['where']['add_time <='] = strtotime($end_time);
				}elseif($type == 2){//����ѯ��ʼʱ��
					$data['whereZiXun']['start_time <='] = strtotime($end_time);
				}
			}
		}
		if(isset($order_sn) && !empty($order_sn)){
			$data['where']['order_sn'] = $order_sn;
		}
		$data['order'] = "add_time desc";
		$result = $this -> orderdb -> exportOrderExcel($data);
		if(!empty($result)){
			header("Content-Type: application/vnd.ms-excel");
			header("Accept-Ranges:bytes");
			header("Content-Disposition:attachment; filename=����.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo '<table style="border-spacing:0;border-collapse:collapse;border:1px solid #f4f4f4;">';
			echo '<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
			echo '<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">';
			echo '<th style="border: 1px solid #f4f4f4;">ID</th>';
			echo '<th style="border: 1px solid #f4f4f4;">�������</th>';
			echo '<th style="border: 1px solid #f4f4f4;">����</th>';
			echo '<th style="border: 1px solid #f4f4f4;">��ͨ�û�</th>';
			echo '<th style="border: 1px solid #f4f4f4;">�µ�ʱ��</th>';
			echo '<th style="border: 1px solid #f4f4f4;">֧����ʽ</th>';
			echo '<th style="border: 1px solid #f4f4f4;">�۸�</th>';
			echo '<th style="border: 1px solid #f4f4f4;">����״̬</th>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$order_status = $this->config->item('order_status');
			$shipping_status = $this->config->item('shipping_status');
			$pay_status = $this->config->item('pay_status');
			foreach($result as $v){
				//������Ϣ
				$sellerInfo = $this->membersdb->getMemberInfoByUserid($v['seller_id']);
				$sellerInfo['username'] = !empty($sellerInfo['realname']) ? $sellerInfo['realname'] : $sellerInfo['username'];
				//�����Ϣ
				$memberInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
				$memberInfo['username'] = !empty($memberInfo['realname']) ? $memberInfo['realname'] : $memberInfo['username'];

				//����order_id���õ�order_goods���е���Ϣ
				$orderGoodsInfo = $this->orderdb->getOrderGoodsByOrderId($v['order_id']);
				if(!empty($orderGoodsInfo)){
					$goods_attr = string2array($orderGoodsInfo['goods_attr']);
					$v['start_time'] = !empty($goods_attr['start_time'])?$goods_attr['start_time']:'';
					$v['end_time'] = !empty($goods_attr['end_time'])?$goods_attr['end_time']:'';
				}
				//���ʽ
				$payment = '';
				if($v['order_status'] == 1 && $v['pay_status'] == 2){
					if($v['bonus_id'] != 0){
						$payment = '��ȯ';
						if( $v['pay_id'] != 0){
							$payment .= $payment.'+'.$v['pay_name'];
						}
					}else{
						$payment = $v['pay_name'];
					}
				}
				echo '<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['order_id'].'</td>';
				echo '<td style="border:1px solid #f4f4f4;vnd.ms-excel.numberformat:@">'.$v['order_sn'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$sellerInfo['username'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$memberInfo['username'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.date('Y-m-d',$v['add_time']).'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$payment.'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$v['goods_amount'].'</td>';
				echo '<td style="border: 1px solid #f4f4f4;">'.$pay_status[$v['pay_status']].$order_status[$v['order_status']].$shipping_status[$v['shipping_status']].'</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
		}
	}
	/*
	 * ��������
	 */
	public function detailOrder(){
		$order_id = $this->input->get('order_id');
		$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
		if(!empty($orderInfo)){
			$orderGoodsInfo = $this->orderdb->getOrderGoodsInfoByOrderId($orderInfo['order_id']);
                        // ��ȡ��ƷͼƬ
                        $this -> load -> model('Goodsmodel');
                        $this->Goodsmodel->getOrderGoodsImagesByGoodsId($orderGoodsInfo,'goods_id',$orderInfo['seller_id']);
			//���ʽ
			$payment = '';
			if($orderInfo['order_status'] == 1 && $orderInfo['pay_status'] == 2){
				if($orderInfo['bonus_id'] != 0){
					$payment = '��ȯ';
					if( $orderInfo['pay_id'] != 0){
						$payment .= $payment.'+'.$orderInfo['pay_name'];
					}
				}else{
					$payment = $orderInfo['pay_name'];
				}
			}
			$orderInfo['payment'] = $payment;
			$this->load->vars('orderInfo',$orderInfo);
                        $this->load->vars('orderGoodsInfo',$orderGoodsInfo);
			$this->load->vars('pay_status',$this->config->item('pay_status'));
			//�����Ϣ
			$memberInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['user_id']);
			$this->load->vars('memberInfo',$memberInfo);
			//������Ϣ
			$sellerInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['seller_id']);
                        //�����Ա�
			switch($sellerInfo['sex']){
				case 0:
					$sellerInfo['sexname'] = '����';
					break;
				case 1:
					$sellerInfo['sexname'] = '��';
					break;
				case 2:
					$sellerInfo['sexname'] = 'Ů';
					break;
			}
                        $sellerInfo['age'] = '����';
                        // ���ҵ�ַ
                        $this->load->model('Regionmodel');
                        $sellerInfo['address'] = $this->Regionmodel->getRegioById($sellerInfo['region_id']);
                        
			$this->load->vars('sellerInfo',$sellerInfo);
			//����ύ�Ķ�����Ϣ
			$orderVisitorInfo = $this->orderdb->getOrderVisitorByOrderId($orderInfo['order_id']);
			//����Ա�
			switch($orderVisitorInfo['sex']){
				case 0:
					$orderVisitorInfo['sexname'] = '����';
					break;
				case 1:
					$orderVisitorInfo['sexname'] = '��';
					break;
				case 2:
					$orderVisitorInfo['sexname'] = 'Ů';
					break;
			}
			//��ѯ����
			$tagInfo = $this->tagdb->getTagById($orderVisitorInfo['speciality']);
			if(!empty($tagInfo)){
				$orderVisitorInfo['speciality'] = $tagInfo['tagname'];
			}
			$this->load->vars('orderVisitorInfo',$orderVisitorInfo);
			//��������
			$orderAction = $this->orderdb->getOrderActionByOrderId($orderInfo['order_id']);
			if(!empty($orderAction)){
				$this->load->vars('orderAction',$orderAction);
			}
			$this->load->view('TicketsOrder/orderDetail');
		}else{
			$data['msg'] = '���ݲ�������';
			$data['url'] = $_SERVER['HTTP_REFERER'];
			$this -> load -> view('common/error', $data);
		}
	}

	/*
	 * ����ʱ�䰲���б�
	 */
	public function products(){
		$data['order'] = "product_id ASC";
		$data['limit'] = PAGESIZE;
		$page = $this->input->get('page');
		$currentPage = $page = isset($page) ? intval($page) : 1;
		$offset = ($page - 1) * PAGESIZE;
		$data['offset'] = $offset;
		$result = $this -> orderdb -> productslist($data);
		foreach($result['rows'] as $k=>$v){
			$sellerInfo = $this->membersdb->getMemberInfoByUserid($v['seller_id']);
			$result['rows'][$k]['seller_name'] = $sellerInfo['username'];
			//�鿴һ�£������������order_goods
			$orderGoods = $this->orderdb->getOrderGoodsByProductid($v['product_id']);
			if(!empty($orderGoods)){
				foreach($orderGoods as $vv){
					//�鿴һ�£��Ƿ��ж�Ӧ�ĳɹ�����
					$orderInfo = $this->orderdb->getOrderInfoByOrderId($vv['order_id']);
					if($orderInfo['order_status'] == 1){//�������Ѿ����ɹ�ԤԼ��
						$result['rows'][$k]['order_status'] = 1;//�������ٴα�ԤԼ
					}
				}
			}
		}
		$this -> load -> library('Page');
		$pageObject = new Page($result['total'], PAGESIZE, $currentPage);
		$pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		$pages = $pageObject -> show();
		$dataShow = array('pages' => $pages, 'datas' => $result['rows']);
		$this -> load -> view('TicketsOrder/products', $dataShow);
	}

	/*
	 *��̨�������ʱ�䰲�ű�
	 */
	public function addProducts(){
		$this->load->view('TicketsOrder/productsAdd');
	}

	/*
	 * �������̻�Աid���Զ����ɿ��
	 */
	public function createproducts(){
		set_time_limit(0);
		$data['where'] = array('type'=>2);
		$data['order'] = "userid DESC";
		$data['limit'] = 10;
		$offset = 0;
		$data['offset'] = $offset;
		$result = $this -> membersdb -> membersList('members1',$data);
		foreach($result['rows'] as $v){
			$this->orderdb->createproducts($v['userid']);
		}
	}
	/*
	 * ���ݿ�����ɶ�����������ɶ���
	 */
	public function createorder(){
		$userid = $this->input->get('userid');//�����߻�Աid
		$procuctid = $this->input->get('productid');
		$productInfo = $this->orderdb->getProductById($procuctid);
		if(!empty($productInfo)){
			if($productInfo['product_number'] == 1){
				//��һ�����������������
				$productResult = $this->orderdb->lockProductById($procuctid,0);
				//�ڶ���������order_info������¼
				if($productResult){
					$insertOrderInfoData['order_sn'] = get_order_sn();
					$insertOrderInfoData['user_id'] = $userid;
					$insertOrderInfoData['order_status'] = 0;//'0'=>'δȷ��','1'=>'��ȷ��','2'=>'��ȡ��','3'=>'��Ч','4'=>'�˻�'
					$insertOrderInfoData['shipping_status'] = 0;//'0'=>'δ����','1'=>'�ѷ���','2'=>'���ջ�','3'=>'������'
					$insertOrderInfoData['pay_status'] = 0;//'0'=>'δ����','1'=>'������','2'=>'�Ѹ���'
					$insertOrderInfoData['pay_id'] = random(1,'12');
					$paymentInfo = $this->paymentdb->getPaymentById($insertOrderInfoData['pay_id']);
					$insertOrderInfoData['pay_name'] = $paymentInfo['pay_name'];
					$insertOrderInfoData['goods_amount'] = $productInfo['product_money'];//��Ʒ�ܽ��
					$insertOrderInfoData['pay_fee'] = $productInfo['product_money']*$paymentInfo['pay_fee']/100;//֧������
					$insertOrderInfoData['money_paid'] = 0;//�Ѹ�����
					$insertOrderInfoData['order_amount'] = $insertOrderInfoData['goods_amount']+$insertOrderInfoData['pay_fee'];//Ӧ������
					$insertOrderInfoData['add_time'] = time();//��������ʱ��
					$insertOrderInfoData['confirm_time'] = 0;//����ȷ��ʱ��
					$insertOrderInfoData['pay_time'] = 0;//����֧��ʱ��
					$insertOrderInfoData['shipping_time'] = 0;//��������ʱ��
					$orderinfo_id = $this->orderdb->insertOrderInfo($insertOrderInfoData);
					if($orderinfo_id){
						$insertOrderGoodData['order_id'] = $orderinfo_id;
						$insertOrderGoodData['goods_name'] = '';
						$insertOrderGoodData['product_id'] = $procuctid;
						$insertOrderGoodData['goods_number'] = 1;
						$insertOrderGoodData['market_price'] = $productInfo['product_money'];
						$insertOrderGoodData['goods_price'] = $productInfo['product_money'];
						$goods_attr = array2string(array('start_time'=>$productInfo['start_time'],'end_time'=>$productInfo['end_time']));
						$insertOrderGoodData['goods_attr'] = $goods_attr;
						$this->orderdb->insertOrderGood($insertOrderGoodData);
					}
				}else{
					//�������ʧ��
				}
			}else{
				//������ڱ�֧����Ӧ����֧��
			}
		}else{
			//��治����
		}
	}
}
