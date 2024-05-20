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
	 * 订单列表
	 */
	public function index() {
		if($this->input->post('dosearch')){
			$type = $this->input->post('type');//搜索方式
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$order_sn = $this->input->post('order_sn');
		}else{
			$type = $this->input->get('type');//搜索方式
			$start_time = $this->input->get('start_time');
			$end_time = $this->input->get('end_time');
			$order_sn = $this->input->get('order_sn');
		}
		//按照时间查询
		if(isset($type) && !empty($type)){
			//开始查询时间
			if(isset($start_time) && !empty($start_time)){
				$parameter['start_time'] = $start_time;
				$this->load->vars('start_time',$start_time);
				if($type == 1){//按下订单时间
					$data['where']['add_time >='] = strtotime($start_time);
				}elseif($type == 2){//按咨询开始时间
					$data['whereZiXun']['start_time >='] = strtotime($start_time);
				}
			}
			//结束查询时间
			if(isset($end_time) && !empty($end_time)){
				$parameter['end_time'] = $end_time;
				$this->load->vars('end_time',$end_time);
				if($type == 1){//按下订单时间
					$data['where']['add_time <='] = strtotime($end_time);
				}elseif($type == 2){//按咨询开始时间
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
				//下订单会员信息
				$membersInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
				$result['rows'][$k]['user_name'] = $membersInfo['username'];
				$sellerInfo = $this->membersdb->getMemberInfoByUserid($v['seller_id']);//商铺账号信息
				$result['rows'][$k]['seller_name'] = $sellerInfo['username'];

				//根据order_id，得到order_goods表中的信息
				$orderGoodsInfo = $this->orderdb->getOrderGoodsByOrderId($v['order_id']);
				if(!empty($orderGoodsInfo)){
					$goods_attr = string2array($orderGoodsInfo['goods_attr']);
				}
				//付款方式
				$payment = '';
				if($v['order_status'] == 1 && $v['pay_status'] == 2){
					if($v['bonus_id'] != 0){
						$payment = '卡券';
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
	//根据订单id，得到订单详情
	public function ajaxGetOrderInfo(){
		if(IS_AJAX){
			$order_id = $this->input->post('order_id');
			$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
			if(!empty($orderInfo)){
				$returnResult = array('info'=>1,'data'=>$orderInfo);
			}else{
				$returnResult = array('info'=>0,'tip'=>'参数传递错误');
			}
			echo json_encode($returnResult);
		}
	}
	//同意取消订单
	public function ajaxRefundOrder(){
		if(IS_AJAX){
			$order_id = $this->input->post('order_id');
			$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
			if(!empty($orderInfo) && $orderInfo['order_status'] !=2 && $orderInfo['pay_status'] == 2 && $orderInfo['refund_status'] != 0){
				$orderGoods = $this->orderdb->getOrderGoodsByOrderId($order_id);
				//买家的信息
				$memberInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['user_id']);
				if($orderInfo['bonus_id'] && $orderInfo['bonus'] == 0){
					$changeMoney  = $memberInfo['money'] + $orderInfo['goods_amount'];
				}else{
					$changeMoney = $memberInfo['money'] + ($orderInfo['goods_amount'] - $orderInfo['bonus']);
					//将卡券还原
					$updateUserBonus['bonus_id'] = $orderInfo['bonus_id'];
					$updateUserBonus['order_id'] = 0;
					$updateUserBonus['used_time'] = 0;
					$this->userbonusdb->updateUserBonsu($updateUserBonus);
				}
				//将订单金额直接退回，会员钱包
				$updateMember['userid'] = $memberInfo['userid'];
				$updateMember['money'] = $changeMoney;
				//更新订单状态
				$updateOrder['order_id'] = $order_id;
				$updateOrder['order_status'] = 2;
				//更新库存状态

				//添加资金流水日志
				$insertAccount['log_sn'] = account_log_sn();
				$insertAccount['user_id'] = $orderInfo['user_id'];
				$insertAccount['user_money'] = $orderInfo['goods_amount'];
				$insertAccount['change_time'] = time();
				$insertAccount['change_desc'] = '申请订单号'.$orderInfo['order_sn'].'退款';
				$insertAccount['status_desc'] = '退款成功';
				if($this->membersdb->updateMemberInfo($updateMember) && $this->orderdb->updateOrderInfo($updateOrder) && $this->orderdb->setProductNumberOne($orderGoods['product_id']) && $this->accountdb->insertAccountLog($insertAccount)){
					$returnResult = array('info'=>1,'tip'=>'申请退款成功');
				}else{
					$returnResult = array('info'=>0,'tip'=>'申请退款失败');
				}
			}else{
				$returnResult = array('info'=>0,'tip'=>'申请退款失败');
			}
			echo json_encode($returnResult);
		}
	}
	//导出订单Excel
	public function exportOrderExcel(){
		$type = $this->input->get('type');//搜索方式
		$start_time = $this->input->get('start_time');
		$end_time = $this->input->get('end_time');
		$order_sn = $this->input->get('order_sn');
		//按照时间查询
		if(isset($type) && !empty($type)){
			//开始查询时间
			if(isset($start_time) && !empty($start_time)){
				if($type == 1){//按下订单时间
					$data['where']['add_time >='] = strtotime($start_time);
				}elseif($type == 2){//按咨询开始时间
					$data['whereZiXun']['start_time >='] = strtotime($start_time);
				}
			}
			//结束查询时间
			if(isset($end_time) && !empty($end_time)){
				if($type == 1){//按下订单时间
					$data['where']['add_time <='] = strtotime($end_time);
				}elseif($type == 2){//按咨询开始时间
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
			header("Content-Disposition:attachment; filename=订单.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			echo '<table style="border-spacing:0;border-collapse:collapse;border:1px solid #f4f4f4;">';
			echo '<thead style="display: table-header-group;vertical-align: middle;border-color: inherit;">';
			echo '<tr style="display: table-row;vertical-align: inherit;border-color: inherit;">';
			echo '<th style="border: 1px solid #f4f4f4;">ID</th>';
			echo '<th style="border: 1px solid #f4f4f4;">订单编号</th>';
			echo '<th style="border: 1px solid #f4f4f4;">商铺</th>';
			echo '<th style="border: 1px solid #f4f4f4;">普通用户</th>';
			echo '<th style="border: 1px solid #f4f4f4;">下单时间</th>';
			echo '<th style="border: 1px solid #f4f4f4;">支付方式</th>';
			echo '<th style="border: 1px solid #f4f4f4;">价格</th>';
			echo '<th style="border: 1px solid #f4f4f4;">订单状态</th>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$order_status = $this->config->item('order_status');
			$shipping_status = $this->config->item('shipping_status');
			$pay_status = $this->config->item('pay_status');
			foreach($result as $v){
				//商铺信息
				$sellerInfo = $this->membersdb->getMemberInfoByUserid($v['seller_id']);
				$sellerInfo['username'] = !empty($sellerInfo['realname']) ? $sellerInfo['realname'] : $sellerInfo['username'];
				//买家信息
				$memberInfo = $this->membersdb->getMemberInfoByUserid($v['user_id']);
				$memberInfo['username'] = !empty($memberInfo['realname']) ? $memberInfo['realname'] : $memberInfo['username'];

				//根据order_id，得到order_goods表中的信息
				$orderGoodsInfo = $this->orderdb->getOrderGoodsByOrderId($v['order_id']);
				if(!empty($orderGoodsInfo)){
					$goods_attr = string2array($orderGoodsInfo['goods_attr']);
					$v['start_time'] = !empty($goods_attr['start_time'])?$goods_attr['start_time']:'';
					$v['end_time'] = !empty($goods_attr['end_time'])?$goods_attr['end_time']:'';
				}
				//付款方式
				$payment = '';
				if($v['order_status'] == 1 && $v['pay_status'] == 2){
					if($v['bonus_id'] != 0){
						$payment = '卡券';
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
	 * 订单详情
	 */
	public function detailOrder(){
		$order_id = $this->input->get('order_id');
		$orderInfo = $this->orderdb->getOrderInfoByOrderId($order_id);
		if(!empty($orderInfo)){
			$orderGoodsInfo = $this->orderdb->getOrderGoodsInfoByOrderId($orderInfo['order_id']);
                        // 获取产品图片
                        $this -> load -> model('Goodsmodel');
                        $this->Goodsmodel->getOrderGoodsImagesByGoodsId($orderGoodsInfo,'goods_id',$orderInfo['seller_id']);
			//付款方式
			$payment = '';
			if($orderInfo['order_status'] == 1 && $orderInfo['pay_status'] == 2){
				if($orderInfo['bonus_id'] != 0){
					$payment = '卡券';
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
			//买家信息
			$memberInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['user_id']);
			$this->load->vars('memberInfo',$memberInfo);
			//商铺信息
			$sellerInfo = $this->membersdb->getMemberInfoByUserid($orderInfo['seller_id']);
                        //卖家性别
			switch($sellerInfo['sex']){
				case 0:
					$sellerInfo['sexname'] = '保密';
					break;
				case 1:
					$sellerInfo['sexname'] = '男';
					break;
				case 2:
					$sellerInfo['sexname'] = '女';
					break;
			}
                        $sellerInfo['age'] = '保密';
                        // 卖家地址
                        $this->load->model('Regionmodel');
                        $sellerInfo['address'] = $this->Regionmodel->getRegioById($sellerInfo['region_id']);
                        
			$this->load->vars('sellerInfo',$sellerInfo);
			//买家提交的订单信息
			$orderVisitorInfo = $this->orderdb->getOrderVisitorByOrderId($orderInfo['order_id']);
			//买家性别
			switch($orderVisitorInfo['sex']){
				case 0:
					$orderVisitorInfo['sexname'] = '保密';
					break;
				case 1:
					$orderVisitorInfo['sexname'] = '男';
					break;
				case 2:
					$orderVisitorInfo['sexname'] = '女';
					break;
			}
			//咨询领域
			$tagInfo = $this->tagdb->getTagById($orderVisitorInfo['speciality']);
			if(!empty($tagInfo)){
				$orderVisitorInfo['speciality'] = $tagInfo['tagname'];
			}
			$this->load->vars('orderVisitorInfo',$orderVisitorInfo);
			//订单跟踪
			$orderAction = $this->orderdb->getOrderActionByOrderId($orderInfo['order_id']);
			if(!empty($orderAction)){
				$this->load->vars('orderAction',$orderAction);
			}
			$this->load->view('TicketsOrder/orderDetail');
		}else{
			$data['msg'] = '传递参数错误';
			$data['url'] = $_SERVER['HTTP_REFERER'];
			$this -> load -> view('common/error', $data);
		}
	}

	/*
	 * 商铺时间安排列表
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
			//查看一下，这个库存产生的order_goods
			$orderGoods = $this->orderdb->getOrderGoodsByProductid($v['product_id']);
			if(!empty($orderGoods)){
				foreach($orderGoods as $vv){
					//查看一下，是否有对应的成功订单
					$orderInfo = $this->orderdb->getOrderInfoByOrderId($vv['order_id']);
					if($orderInfo['order_status'] == 1){//这个库存已经被成功预约了
						$result['rows'][$k]['order_status'] = 1;//不可以再次被预约
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
	 *后台添加商铺时间安排表
	 */
	public function addProducts(){
		$this->load->view('TicketsOrder/productsAdd');
	}

	/*
	 * 根据商铺会员id，自动生成库存
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
	 * 根据库存生成订单，随机生成订单
	 */
	public function createorder(){
		$userid = $this->input->get('userid');//购买者会员id
		$procuctid = $this->input->get('productid');
		$productInfo = $this->orderdb->getProductById($procuctid);
		if(!empty($productInfo)){
			if($productInfo['product_number'] == 1){
				//第一步：首先先锁定库存
				$productResult = $this->orderdb->lockProductById($procuctid,0);
				//第二步：创建order_info表订单记录
				if($productResult){
					$insertOrderInfoData['order_sn'] = get_order_sn();
					$insertOrderInfoData['user_id'] = $userid;
					$insertOrderInfoData['order_status'] = 0;//'0'=>'未确认','1'=>'已确认','2'=>'已取消','3'=>'无效','4'=>'退货'
					$insertOrderInfoData['shipping_status'] = 0;//'0'=>'未发货','1'=>'已发货','2'=>'已收货','3'=>'备货中'
					$insertOrderInfoData['pay_status'] = 0;//'0'=>'未付款','1'=>'付款中','2'=>'已付款'
					$insertOrderInfoData['pay_id'] = random(1,'12');
					$paymentInfo = $this->paymentdb->getPaymentById($insertOrderInfoData['pay_id']);
					$insertOrderInfoData['pay_name'] = $paymentInfo['pay_name'];
					$insertOrderInfoData['goods_amount'] = $productInfo['product_money'];//商品总金额
					$insertOrderInfoData['pay_fee'] = $productInfo['product_money']*$paymentInfo['pay_fee']/100;//支付费用
					$insertOrderInfoData['money_paid'] = 0;//已付款金额
					$insertOrderInfoData['order_amount'] = $insertOrderInfoData['goods_amount']+$insertOrderInfoData['pay_fee'];//应付款金额
					$insertOrderInfoData['add_time'] = time();//创建订单时间
					$insertOrderInfoData['confirm_time'] = 0;//订单确认时间
					$insertOrderInfoData['pay_time'] = 0;//订单支付时间
					$insertOrderInfoData['shipping_time'] = 0;//订单配送时间
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
					//库存锁定失败
				}
			}else{
				//库存正在被支付或应经被支付
			}
		}else{
			//库存不存在
		}
	}
}
