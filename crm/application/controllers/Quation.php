<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Quation extends MY_Controller {
    
	private $membersdb;
	private $inquiryoffermodel;
	private $inquirylistmodel;
        private $addressmodel;
        private $inquriyquotationrelationmodel;
        
	public function __construct() {
            parent::__construct();

            $this->load->model('Membersmodel');
            $this->membersdb = $this->Membersmodel;
            // 初始化询价单相关数据模型
            $this->load->model('NewInquirymodel');
            $this->inquirylistmodel = $this->NewInquirymodel;

            $this->load->model('NewQuotationmodel');
            $this->inquiryoffermodel = $this->NewQuotationmodel;
            // 收货地址
            $this->load->model('Addressmodel');
            $this->addressmodel = $this->Addressmodel;
            // 询价单报价单对应关系
            $this->load->model('InquriyQuotationRelationmodel');
            $this->inquriyquotationrelationmodel = $this->InquriyQuotationRelationmodel;

	}

        /*
         * 询价单列表
         */
        public function index() {
            if($this->input->post('dosearch')){
                $type = $this->input->post('type');//搜索方式
                $starttime = $this->input->post('starttime');
                $endtime = $this->input->post('endtime');
                $inquirycode = $this->input->post('inquirycode');
                $inquirystatus = $this->input->post('inquirystatus');
            }else{
                $type = $this->input->get('type');//搜索方式
                $starttime = $this->input->get('starttime');
                $endtime = $this->input->get('endtime');
                $inquirycode = $this->input->get('inquirycode');
                $inquirystatus = $this->input->post('inquirystatus');
            }
            //开始查询时间
            if(isset($starttime) && !empty($starttime)){
                $parameter['starttime'] = $starttime;
                $this->load->vars('starttime',$starttime);
                $data['starttime'] = strtotime($starttime);
            }
            //结束查询时间
            if(isset($endtime) && !empty($endtime)){
                $parameter['endtime'] = $endtime;
                $this->load->vars('endtime',$endtime);
                $data['endtime'] = strtotime($endtime);
            }

            // 查询参数
            $data['inquirycode'] = empty($inquirycode) ? '': $inquirycode;
            $data['inquirystatus'] = empty($inquirystatus) ? '': $inquirystatus;

            // 页面传参
            $this->load->vars('inquirycode',$inquirycode);
            $this->load->vars('inquirystatus',$inquirystatus);
            $this->load->vars('type',$type);
            //分页参数组装
            $parameter['inquirycode'] = empty($inquirycode) ? '': $inquirycode;
            $parameter['inquirystatus'] = empty($inquirystatus) ? '': $inquirystatus;
            $parameter['type'] = $type;

            $data['order'] = " id DESC";
            $data['limit'] = PAGESIZE;
            $page = $this->input->get('page');
            $currentPage = $page = isset($page) ? intval($page) : 1;
            $offset = ($page - 1) * PAGESIZE;
            $data['offset'] = $offset;
            // 处理当前用户能够处理的品牌询价单
            $data['brandname'] = $this->getInquiryAndQuationBrand(2);
            // 查询列表
            $result =  $this->inquirylistmodel->getlist($data);
            $returndata = []; // 返回数据
            foreach($result['rows'] as $rrkey=>$rrval){
                if(!array_key_exists($rrval['inquirycode'], $returndata)){
                    $returndata[$rrval['inquirycode']] = [];
                    $returndata[$rrval['inquirycode']]['inquirycode'] = $rrval['inquirycode'];
                    $returndata[$rrval['inquirycode']]['batchcode'] = $rrval['batchcode'];
                    $returndata[$rrval['inquirycode']]['vincode'] = $rrval['vincode'];
                    $returndata[$rrval['inquirycode']]['carmodel'] = $rrval['carmodel'];
                    $returndata[$rrval['inquirycode']]['addtime'] = date('Y-m-d', $rrval['addtime']);
                    $returndata[$rrval['inquirycode']]['sourcefrom'] = ($rrval['sourcefrom']==1) ? "客户" : '客服';
                    $returndata[$rrval['inquirycode']]['status'] = $rrval['status'];
                    $returndata[$rrval['inquirycode']]['statusstring'] = inquiryflgToText($rrval['status'], $rrval['addtime']+2*24*3600);//$rrval['status'];
                    $returndata[$rrval['inquirycode']]['parts'] = [];
                }
                $parttemp = [];
                $parttemp['partname'] = $rrval['partname'];
                $parttemp['oecode'] = $rrval['oecode'];
                $parttemp['partquality'] = ($rrval['partquality']==1)? '原厂原装':(($rrval['partquality']==2)?'同质配件':($rrval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)'); //1:原厂原装,2:同质配件,3:品牌件,9:末指定则默认为原厂原装
                $parttemp['number'] = $rrval['number'];
                $parttemp['remark'] = isset($rrval['remark'])?$rrval['remark']:'';
                $returndata[$rrval['inquirycode']]['parts'][] = $parttemp;

            }
            $this -> load -> library('Page');
            if(isset($parameter)){
                    $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
            }else{
                    $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
            }
            $pageObject -> setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            $pages = $pageObject -> show();
            $dataShow = array('pages' => $pages, 'lists' => $returndata,'totalNumber'=>$result['total']);
            $this -> load -> view('quotation/index', $dataShow);
        }
        
        /*
	 * 询价单详情
	 */
	public function detail(){
            $inquirycode = $this->input->get('inquirycode');
            // 询价单主信息
            $inquiryinfo = $this->inquirylistmodel->getDetailByInquiryCode($inquirycode);
            if(!empty($inquiryinfo)){
                $returndata = [];
                // 处理询价单配件
                foreach($inquiryinfo as $rrkey=>$rrval){
                    if(!array_key_exists($rrval['inquirycode'], $returndata)){
                        $returndata[$rrval['inquirycode']] = [];
                        $returndata[$rrval['inquirycode']]['inquirycode'] = $rrval['inquirycode'];
                        $returndata[$rrval['inquirycode']]['batchcode'] = $rrval['batchcode'];
                        $returndata[$rrval['inquirycode']]['quotation_batchcode'] = empty($rrval['quotation_batchcode']) ? '' :$rrval['quotation_batchcode'];
                        $returndata[$rrval['inquirycode']]['vincode'] = $rrval['vincode'];
                        $returndata[$rrval['inquirycode']]['carmodel'] = $rrval['carmodel'];
                        $returndata[$rrval['inquirycode']]['addtime'] = date('Y-m-d', $rrval['addtime']);
                        $returndata[$rrval['inquirycode']]['inquiryaddtime'] =  $rrval['addtime'];
                        $returndata[$rrval['inquirycode']]['status'] = $rrval['status'];
                        $returndata[$rrval['inquirycode']]['userid'] = $rrval['memeberid'];
                        $returndata[$rrval['inquirycode']]['shoppingaddressid'] = $rrval['shoppingaddressid']; // 收货地址
                        $returndata[$rrval['inquirycode']]['staffid'] = $rrval['staff_id'];
                        $returndata[$rrval['inquirycode']]['statusstring'] = inquiryflgToText($rrval['status'],0);//$rrval['status']; , $rrval['addtime']+2*24*3600
                        $returndata[$rrval['inquirycode']]['parts'] = [];
                    }
                    $parttemp = [];
                    $parttemp['partname'] = $rrval['partname'];
                    $parttemp['partid'] = $rrval['id'];
                    $parttemp['oecode'] = $rrval['oecode'];
                    $parttemp['partquality'] = ($rrval['partquality']==1)? '原厂原装':(($rrval['partquality']==2)?'同质配件':($rrval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)'); //1:原厂原装,2:同质配件,3:品牌件,9:末指定则默认为原厂原装
                    $parttemp['number'] = $rrval['number'];
                    $parttemp['remark'] = isset($rrval['remark'])?$rrval['remark']:'';
                    $returndata[$rrval['inquirycode']]['parts'][] = $parttemp;      
                }
                $inquiryinfo = $returndata[$inquirycode];
                //买家信息
                $memberdetail = $this->membersdb->getMemberInfoByUserid($inquiryinfo['userid']);
                // 买家收货地址
                $address = $this->addressmodel->getAddressById($inquiryinfo['userid'],$inquiryinfo['shoppingaddressid']);
                $memberInfo = [];
                $memberInfo['username'] = empty($memberdetail['username']) ? "" : $memberdetail['username'];
                $memberInfo['realname'] = empty($memberdetail['realname']) ? "" : $memberdetail['realname'];
                $memberInfo['mobile'] = empty($memberdetail['mobile']) ? "" : $memberdetail['mobile'];
                $memberInfo['shippingname'] = empty($address['recname']) ? "" : $address['recname'];
                $memberInfo['shippingphone'] = empty($address['recphone']) ? "" : $address['recphone'];
                $memberInfo['shippingaddress'] = empty($address['address']) ? "" : $address['address'];
                // 获取厂商配件报价信息
                $competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryBatchcode($inquiryinfo['batchcode'],$inquiryinfo['quotation_batchcode']);
                $competeparts = []; // 报价单配件信息
                $inquiryshippingfee = []; // 报价单运费
                if(!empty($competeinfo)){
                    // 设置报价单配件信息
                    foreach($competeinfo as $ctkey=>$ctval){
                        if(!array_key_exists($ctval['shopid'], $competeparts)){
                            $competeparts[$ctval['shopid']] = [];
                        }
                        if(!array_key_exists($ctval['partid'], $competeparts)){
                            $competeparts[$ctval['shopid']][$ctval['partid']] = [];
                        }
                        $parttemp = [];
                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['shopid'] = $ctval['shopid'];
                        $parttemp['partquality'] = $ctval['partquality'];
                        $parttemp['number'] = $ctval['number'];
                        $parttemp['oecode'] = $ctval['oecode'];
                        $parttemp['partprice'] = $ctval['partprice'];
                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['remark'] = $ctval['remark'];
                        $parttemp['partbrand'] = $ctval['partbrand'];
                        $parttemp['stock_type'] = $ctval['stock_type'];
                        $parttemp['order_day'] = $ctval['order_day'];
                        $parttemp['addtime'] = $ctval['addtime'];
                        $competeparts[$ctval['shopid']][$ctval['partid']][] = $parttemp;
                        // 报价单运费处理
                        if(!array_key_exists($ctval['shopid'], $inquiryshippingfee)){
                            $inquiryshippingfee[$ctval['shopid']] = [];
                        }
                        $shippingfee = json_decode($ctval['shippingdetail'],true);
                        foreach($shippingfee as $sfkey=>$sfval){
                            if(!empty($sfval)){
                                $inquiryshippingfee[$sfkey] = sprintf('%.2f',$sfval);
                            }
                        }
                        //$inquiryshippingfee[$ctval['shopid']]['free_type'] = $ctval['free_type'];
                        //$inquiryshippingfee[$ctval['shopid']]['free_price'] = $ctval['free_price'];
                    }
                }
                $this->load->vars('memberInfo',$memberInfo);
                $this->load->vars('inquiryinfo',$inquiryinfo);
                $this->load->vars('competeparts',$competeparts);
                $this->load->vars('inquiryshippingfee',$inquiryshippingfee);
                $this->load->view('quotation/detail');
            }else{
                $data['msg'] = '传递参数错误';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
	}
        
        /**
         * 报价单
         */
        public function quoting(){
            $inquirycode = $this->input->get('inquirycode');
            if(empty($inquirycode)){
                $data['msg'] = '非法操作';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
                return;
            }
            // 询价单主信息
            $inquiryinfo = $this->inquirylistmodel->getDetailByInquiryCode($inquirycode);
            // 获取问询关系信息
            $iqrdata = $this->inquriyquotationrelationmodel->getSupplierPermissionInfo($inquirycode,$this->session->userdata('shopid'));
            if(empty($inquiryinfo) || empty($iqrdata['id']) || ($iqrdata['status'] !=1)){
                $data['msg'] = '询价单信息不存在,或者无权限操作该询价单!';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
                return;
            }
            $returndata = [];
            // 处理询价单配件
            foreach($inquiryinfo as $rrkey=>$rrval){
                if(!array_key_exists($rrval['inquirycode'], $returndata)){
                    $returndata[$rrval['inquirycode']] = [];
                    $returndata[$rrval['inquirycode']]['inquirycode'] = $rrval['inquirycode'];
                    $returndata[$rrval['inquirycode']]['iqrid'] = $iqrdata['id'];
                    $returndata[$rrval['inquirycode']]['batchcode'] = $rrval['batchcode'];
                    $returndata[$rrval['inquirycode']]['quotation_batchcode'] = empty($rrval['quotation_batchcode']) ? '' :$rrval['quotation_batchcode'];
                    $returndata[$rrval['inquirycode']]['vincode'] = $rrval['vincode'];
                    $returndata[$rrval['inquirycode']]['carmodel'] = $rrval['carmodel'];
                    $returndata[$rrval['inquirycode']]['addtime'] = date('Y-m-d', $rrval['addtime']);
                    $returndata[$rrval['inquirycode']]['inquiryaddtime'] =  $rrval['addtime'];
                    $returndata[$rrval['inquirycode']]['status'] = $rrval['status'];
                    $returndata[$rrval['inquirycode']]['userid'] = $rrval['memeberid'];
                    $returndata[$rrval['inquirycode']]['shoppingaddressid'] = $rrval['shoppingaddressid']; // 收货地址
                    $returndata[$rrval['inquirycode']]['staffid'] = $rrval['staff_id'];
                    $returndata[$rrval['inquirycode']]['statusstring'] = inquiryflgToText($rrval['status'],0);//$rrval['status']; , $rrval['addtime']+2*24*3600
                    $returndata[$rrval['inquirycode']]['parts'] = [];
                }
                $parttemp = [];
                $parttemp['partname'] = $rrval['partname'];
                $parttemp['partid'] = $rrval['id'];
                $parttemp['oecode'] = $rrval['oecode'];
                $parttemp['partquality'] = ($rrval['partquality']==1)? '原厂原装':(($rrval['partquality']==2)?'同质配件':($rrval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)'); //1:原厂原装,2:同质配件,3:品牌件,9:末指定则默认为原厂原装
                $parttemp['number'] = $rrval['number'];
                $parttemp['remark'] = isset($rrval['remark'])?$rrval['remark']:'';
                $returndata[$rrval['inquirycode']]['parts'][] = $parttemp;      
            }
            $inquiryinfo = $returndata[$inquirycode];
            //买家信息
            $memberdetail = $this->membersdb->getMemberInfoByUserid($inquiryinfo['userid']);
            // 买家收货地址
            $address = $this->addressmodel->getAddressById($inquiryinfo['userid'],$inquiryinfo['shoppingaddressid']);
            $memberInfo = [];
            $memberInfo['bayerid'] = $inquiryinfo['userid'];
            $memberInfo['username'] = empty($memberdetail['username']) ? "" : $memberdetail['username'];
            $memberInfo['realname'] = empty($memberdetail['realname']) ? "" : $memberdetail['realname'];
            $memberInfo['mobile'] = empty($memberdetail['mobile']) ? "" : $memberdetail['mobile'];
            $memberInfo['shippingname'] = empty($address['recname']) ? "" : $address['recname'];
            $memberInfo['shippingphone'] = empty($address['recphone']) ? "" : $address['recphone'];
            $memberInfo['shippingaddress'] = empty($address['address']) ? "" : $address['address'];
            $this->load->vars('memberInfo',$memberInfo);
            $this->load->vars('inquiryinfo',$inquiryinfo);
            $this->load->view('quotation/quoting');
        }
        
        /**
         * 报价异步处理
         */
        public function ajaxQuoting(){
            $returndata = ['success' => 0, 'message' => []];
            if(empty($this->input->post('inquirycode'))){
                $returndata['message']['inquiry'] = '非法询价单!';
            }
            if(empty($this->input->post('inquiry_batchcode'))){
                $returndata['message']['inquiry'] = '非法询价单!';
            }
            if(empty($this->input->post('carmodel'))){
                $returndata['message']['inquiry'] = '车型数据不能为空!';
            }
            if (!empty($this->input->post('vincode')) && !preg_match('/^([A-Za-z0-9]){17}$/u', $this->input->post('vincode'))) {
                $returndata['message']['vincode'] = '输入的车架号(V码)格式不对!';
            }
            if ($this->input->post('partscount') > count($this->input->post('pname'))) {
                $returndata['message']['partscount'] = '还有'.($this->input->post('partscount')-count($this->input->post('pname'))).'个配件没报价';
            }
            $flg = 0;
            foreach ($this->input->post('shipping_fee') as $sfkey => $sfval) {
                if (!empty($sfval)) {
                    $flg = 1;
                }
            }
            if ($flg==0) {
                $returndata['message']['shipping_fee'] = '至少选择1种运输方式及运费';
            }
            if(!empty($returndata['message'])){
                echo json_encode($returndata);
                return;
            }
            $i = 1;
            $flgpname = false;
            $returndata['message']['pname'] = [];
            foreach ($this->input->post('pname') as $pnkey => $pnval) {
                $returndata['message']['pname'][$pnkey] = [];
                foreach ($pnval as $pnvk => $pnvv) {
                    if (mb_strlen($pnvv) < 2 || mb_strlen($pnvv) > 30) {
                        $returndata['message']['pname'][$pnkey][$pnvk] = '第' . $i . '个配件名，请填写2到30位长度的字符';
                        $flgpname = true;
                    }
                    $i++;
                }
            }
            if($flgpname){
                echo json_encode($returndata);
                return;
            }
            $i=1;
            $orderday = $this->input->post('order_day');
            $flagorder = false;
            $returndata['message']['order_day']=[];
            foreach ($this->input->post('stock_type') as $pstkey => $pstval) {
                $returndata['message']['order_day'][$pstkey] = [];
                foreach ($pstval as $pstvk => $pstvv) {
                    if ($pstvv==2) {
                        if (!preg_match('/^\d{1,6}$/', trim($orderday[$pstkey][$pstvk]))) {
                            $returndata['message']['order_day'][$pstkey][$pstvk] = '第' . $i . '个配件，请填写有效的订货周期';
                            $flagorder = true;
                        }
                    }
                    $i++;
                }
            }
            if($flagorder){
                echo json_encode($returndata);
                return;
            }
            $i = 1;
            $returndata['message']['price']=[];
            $flagprice = false;
            foreach ($this->input->post('price') as $pkey => $pval) {
                $returndata['message']['price'][$pkey] =[];
                foreach ($pval as $pvk => $pvv) {
                    if (empty($pvv)) {
                        $returndata['message']['price'][$pkey][$pvk] = '第' . $i . '个配件价格没填写';
                        $flagprice = true;
                    } else {
                        if (!preg_match('/^[0-9]{1,6}(.[0-9]{1,2})?$/',$pvv)) {
                            $returndata['message']['price'][$pkey][$pvk] = '第' . $i . '个配件价格,请填写数值';
                            $flagprice = true;
                        }
                    }
                    $i++;
                }
            }
            if($flagprice){
                echo json_encode($returndata);
                return;
            }
            
            $resdata = $this->inquirylistmodel->getInquiryStatusByInquiryCodeAndBatchCode($this->input->post('inquirycode'));
            if(empty($resdata['bayerid'])){
                $returndata['message']['inquiry'] = '询价单不存在!';
                echo json_encode($returndata);
                return;
            }
            if(!empty($resdata['status']) && $resdata['status'] !=1){
               $returndata['message']['inquiry'] = '非报价状态询价单(已经报价或者超时了)！';
               echo json_encode($returndata);
               return;
            }
            if($resdata['bayerid']!=$this->input->post('bayerid')){
                $returndata['message']['inquiry'] = '询价单客户信息异常！';
                echo json_encode($returndata);
                return;
            }
            // 处理报价单信息
            $offerdata = [];
            $offerdata['batchcode'] = date('YmdHis').'_'.randCode(8,0).'_'. randCode(6,1);
            $offerdata['inquiry_batchcode'] = $this->input->post('inquiry_batchcode');
            $addtime = time();
            $offerdata['staff_id'] = $this->session->userdata('userid');
            $offerdata['splitpart'] = [];
            $partquality = $this->input->post('pg_flg'); // 配件质量
            $number = $this->input->post('number'); // 配件数量
            $remark = $this->input->post('pg_note'); // 配件留言
            $oecode = $this->input->post('oecode'); // 配件OE码
            $price = $this->input->post('price'); // 配件价格
            $stock_type = $this->input->post('stock_type'); // 库存类型
            $order_day = $this->input->post('order_day'); // 预定天数
            $brand = $this->input->post('pg_brand'); // 配件质量
            foreach($this->input->post('pname') as $ptnkey=>$ptnval){
                foreach($ptnval as $ptnvkey=>$ptnvval){
                    $offerparttemp = [];
                    $offerparttemp['batchcode'] = $offerdata['batchcode'];
                    $offerparttemp['iqrid'] = $this->input->post('iqrid');
                    $offerparttemp['inquiry_batchcode'] = $offerdata['inquiry_batchcode'];
                    $offerparttemp['shopid'] = $this->input->post('bayerid');
                    $offerparttemp['staff_id'] = $this->session->userdata('userid');
                    $offerparttemp['vincode'] = empty($this->input->post('vincode'))? '':$this->input->post('vincode');
                    $offerparttemp['carmodel'] = empty($this->input->post('carmodel'))? '':$this->input->post('carmodel');
                    $offerparttemp['partid'] = $ptnkey;
                    $offerparttemp['partname'] = $ptnvval;
                    $offerparttemp['partquality'] = empty($partquality[$ptnkey][$ptnvkey]) ? 9 : $partquality[$ptnkey][$ptnvkey];
                    $offerparttemp['number'] = empty($number[$ptnkey][$ptnvkey]) ? 1 : $number[$ptnkey][$ptnvkey];
                    $offerparttemp['remark'] = empty($remark[$ptnkey][$ptnvkey]) ? '' : $remark[$ptnkey][$ptnvkey];
                    $offerparttemp['oecode'] = empty($oecode[$ptnkey][$ptnvkey]) ? '' : $oecode[$ptnkey][$ptnvkey];
                    $offerparttemp['status'] = 2;
                    $offerparttemp['addtime'] = $addtime;
                    $offerparttemp['partprice'] = empty($price[$ptnkey][$ptnvkey]) ? 0.00 : $price[$ptnkey][$ptnvkey];
                    $offerparttemp['partbrand'] = empty($brand[$ptnkey][$ptnvkey]) ? '' : $brand[$ptnkey][$ptnvkey];
                    $offerparttemp['stock_type'] = empty($stock_type[$ptnkey][$ptnvkey]) ? '' : $stock_type[$ptnkey][$ptnvkey];
                    $offerparttemp['order_day'] = empty($order_day[$ptnkey][$ptnvkey]) ? 0 : $order_day[$ptnkey][$ptnvkey];
                    $offerparttemp['shippingdetail'] = json_encode($this->input->post('shipping_fee'));
                    $offerdata['splitpart'][] = $offerparttemp;
                }
            }
            // 报价配件信息
            $offerdata=$offerdata['splitpart'];
            $this->purchasemaster->trans_start(); // 开启采购库事务
            $flag1 = $this->inquiryoffermodel->batchAddQuotationList($offerdata);
            // 修改问询关联关系表
            $flag2 = $this->inquriyquotationrelationmodel->updateIQRStatus(['id'=>$this->input->post('iqrid'),'status'=>2,'offertime'=>$addtime]);
            // 修改询价单状态
            $flag3 = $this->inquirylistmodel->updateInquiryListStatusToTakeStatus($this->input->post('inquirycode'),4);
            // 提交事务
            if($flag1 && $flag2 && $flag3){
                $this->purchasemaster->trans_commit();
                $returndata['message'] = $this->input->post('inquirycode');
                $returndata['success'] = 1;
                echo json_encode($returndata);
                return;
            }
            $this->purchasemaster->trans_rollback(); // 事务回滚
            $returndata['message']['addError'] = '报价失败！';
            echo json_encode($returndata);
            return;
            
        }
        
}
