<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends MY_Controller {
    
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
                $inquirystatus = $this->input->get('inquirystatus');
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
            $data['brandname'] = $this->getInquiryAndQuationBrand(1);
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
                    $returndata[$rrval['inquirycode']]['addtime'] = $rrval['addtime'];
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
            $this -> load -> view('inquiry/index', $dataShow);
	}
        
        /**
         * 处理报价单
         */
        public function quoting(){
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
                $this->load->vars('memberInfo',$memberInfo);
                // 获取厂商配件报价信息
                //$competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryBatchcode($inquiryinfo['batchcode'],$inquiryinfo['quotation_batchcode']);
                $competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryCode($inquirycode);
                $companyinfo = []; // 报价单供货商信息
                $competeparts = []; // 报价单配件信息
                $inquiryshippingfee = []; // 报价单运费
                if(!empty($competeinfo)){
                    // 获取供货商信息
                    $companytemp = array_column($competeinfo, 'shoperid');
                    foreach($companytemp as $ctkey=>$ctval){
                        if(empty($ctval)){
                            continue;
                        }
                        $ctemp = $this->membersdb->getMemberInfoByUserid($ctval);
                        if(empty($ctemp)){
                            continue;
                        }
                        if(!array_key_exists($ctemp['userid'], $companyinfo)){
                            $companyinfo[$ctemp['userid']] = [];
                        }
                        $companyinfo[$ctemp['userid']]['userid'] = $ctemp['userid'];
                        $companyinfo[$ctemp['userid']]['realname'] = $ctemp['realname'];
                        $companyinfo[$ctemp['userid']]['username'] = $ctemp['username'];
                        $companyinfo[$ctemp['userid']]['rtype'] = $ctemp['rtype'];
                        $companyinfo[$ctemp['userid']]['mobile'] = $ctemp['mobile'];
                    }
                    // 设置报价单配件信息
                    foreach($competeinfo as $ctkey=>$ctval){
                        if(!array_key_exists($ctval['shoperid'], $competeparts)){
                            $competeparts[$ctval['shoperid']] = [];
                        }
                        if(!array_key_exists($ctval['partid'], $competeparts[$ctval['shoperid']])){
                            $competeparts[$ctval['shoperid']][$ctval['partid']] = [];
                        }
                        // 获取竞价成功的供货商
                        if(empty($inquiryinfo['supplierid']) && $ctval['batchcode'] == $inquiryinfo['quotation_batchcode']){
                            $inquiryinfo['supplierid'] = $ctval['shoperid'];
                        }
                        $parttemp = [];
                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['shoperid'] = $ctval['shoperid'];
                        $parttemp['partquality'] = ($ctval['partquality']==1)? '原厂原装':(($ctval['partquality']==2)?'同质配件':($ctval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)');
                        $parttemp['number'] = $ctval['number'];
                        $parttemp['oecode'] = $ctval['oecode'];
                        $parttemp['partprice'] = $ctval['partprice'];
                        $parttemp['carmodel'] = $ctval['carmodel'];
                        $parttemp['remark'] = $ctval['remark'];
                        $parttemp['partbrand'] = $ctval['partbrand'];
                        $parttemp['stock_type'] = $ctval['stock_type'];
                        $parttemp['order_day'] = $ctval['order_day'];
                        $parttemp['addtime'] = $ctval['addtime'];
                        $competeparts[$ctval['shoperid']][$ctval['partid']][] = $parttemp;
                        // 报价单运费处理
                        if(!array_key_exists($ctval['shoperid'], $inquiryshippingfee)){
                            $inquiryshippingfee[$ctval['shoperid']] = [];
                        }
                        $inquiryshippingfee[$ctval['shoperid']][$ctval['free_type']] = $ctval['free_price'];// $ctval['free_type'];
                        //$inquiryshippingfee[$ctval['shoperid']]['free_price'] = $ctval['free_price'];
                        // 添加部分信息到供货商信息数组中
                        if(!array_key_exists('info', $companyinfo[$parttemp['shoperid']])){
                            $companyinfo[$parttemp['shoperid']]['info'] = [];
                            $companyinfo[$parttemp['shoperid']]['info']['offerspeed'] = showDiffTime($inquiryinfo['inquiryaddtime'],$parttemp['addtime']);
                            $companyinfo[$parttemp['shoperid']]['info']['carmodel'] = $parttemp['carmodel'];
                            $companyinfo[$parttemp['shoperid']]['info']['iqrid'] = $ctval['iqrid'];
                            $companyinfo[$parttemp['shoperid']]['info']['xianhuo'] = 1;
                            $companyinfo[$parttemp['shoperid']]['info']['dinghuo'] = 1;
                            $companyinfo[$parttemp['shoperid']]['info']['batchcode'] = $ctval['batchcode'];
                            $companyinfo[$parttemp['shoperid']]['info']['shippinginfo'] = shippingTypeToText($ctval['free_type']).':'.$ctval['free_price'].'元';
                        }else{
                            if($ctval['stock_type']==1){
                                $companyinfo[$parttemp['shoperid']]['info']['xianhuo']++;
                            }else{
                                $companyinfo[$parttemp['shoperid']]['info']['dinghuo']++;
                            }
                        }
                    }
                    
                }
                //商铺信息
                $sellerInfo = [];
                if(!empty($inquiryinfo['supplierid'])){
                    $sellerInfo = $this->membersdb->getMemberInfoByUserid($inquiryinfo['supplierid']);
                }
                $this->load->vars('sellerInfo',$sellerInfo);
                $this->load->vars('inquiryinfo',$inquiryinfo);
                $this->load->vars('competeparts',$competeparts);
                $this->load->vars('inquiryshippingfee',$inquiryshippingfee);
                $this->load->vars('companyinfo',$companyinfo);
                $this->load->view('inquiry/quoting');
            }else{
                $data['msg'] = '传递参数错误';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
        
        /**
         * 报价异步处理
         */
        public function ajaxQuoting(){
            if(IS_AJAX){
                if(empty($this->input->post('batchcode'))){
                    echo json_encode(['success'=>0,'data'=>'请选择供货商!']);
                    return;
                }
                if(empty($this->input->post('iqrid'))){
                    echo json_encode(['success'=>0,'data'=>'请选择供货商!!']);
                    return;
                }
                if(empty($this->input->post('inquirycode'))){
                    echo json_encode(['success'=>0,'data'=>'询价单信息无效!']);
                    return;
                }
                // 修改询价单及关联关系表信息
                $flag = $this->inquirylistmodel->updateInquiryQuoting($this->input->post('inquirycode'),$this->input->post('batchcode'));
                if($flag){
                    echo json_encode(['success'=>1,'data'=>'报价成功!']);
                    return;
                }else{
                    echo json_encode(['success'=>0,'data'=>'报价失败!']);
                    return;
                }
            }else{
                echo json_encode(['success'=>0,'data'=>'非法访问!']);
                return;
            }
        }
        
        /**
         * 作废询价单
         */
        public function ajaxCancel(){
            if(IS_AJAX){
                if(empty($this->input->post('inquirycode'))){
                    echo json_encode(['success'=>0,'data'=>'询价单信息无效!']);
                    return;
                }
                //$cancelreason = $this->input->post('cancelreason'); // 取消原因
                // 取消询价单
                $flag = $this->inquirylistmodel->updateInquiryToBeCancelStatus($this->input->post('inquirycode'));
                if($flag){
                    echo json_encode(['success'=>1,'data'=>'取消成功!']);
                    return;
                }else{
                    echo json_encode(['success'=>0,'data'=>'取消失败!']);
                    return;
                }
            }else{
                echo json_encode(['success'=>0,'data'=>'非法访问!']);
                return;
            }
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
                $this->load->vars('memberInfo',$memberInfo);
                // 获取厂商配件报价信息
                //$competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryBatchcode($inquiryinfo['batchcode'],$inquiryinfo['quotation_batchcode']);
                $competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryCode($inquirycode);
                $companyinfo = []; // 报价单供货商信息
                $competeparts = []; // 报价单配件信息
                $inquiryshippingfee = []; // 报价单运费
                if(!empty($competeinfo)){
                    // 设置报价单配件信息
                    foreach($competeinfo as $ctkey=>$ctval){
                        if(!array_key_exists($ctval['shoperid'], $competeparts)){
                            $competeparts[$ctval['shoperid']] = [];
                        }
                        if(!array_key_exists($ctval['partid'], $competeparts[$ctval['shoperid']])){
                            $competeparts[$ctval['shoperid']][$ctval['partid']] = [];
                        }
                        // 获取竞价成功的供货商
                        if(empty($inquiryinfo['supplierid']) && $ctval['batchcode'] == $inquiryinfo['quotation_batchcode']){
                            $inquiryinfo['supplierid'] = $ctval['shoperid'];
                        }
                        $parttemp = [];
                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['shoperid'] = $ctval['shoperid'];
                        $parttemp['partquality'] = ($ctval['partquality']==1)? '原厂原装':(($ctval['partquality']==2)?'同质配件':($ctval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)');
                        $parttemp['number'] = $ctval['number'];
                        $parttemp['oecode'] = $ctval['oecode'];
                        $parttemp['partprice'] = $ctval['partprice'];
//                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['remark'] = $ctval['remark'];
                        $parttemp['partbrand'] = $ctval['partbrand'];
                        $parttemp['stock_type'] = $ctval['stock_type'];
                        $parttemp['order_day'] = $ctval['order_day'];
                        $parttemp['addtime'] = $ctval['addtime'];
                        $competeparts[$ctval['shoperid']][$ctval['partid']][] = $parttemp;
                        // 报价单运费处理
                        if(!array_key_exists($ctval['shoperid'], $inquiryshippingfee)){
                            $inquiryshippingfee[$ctval['shoperid']] = [];
                        }
                        $shippingfee = json_decode($ctval['shippingdetail'],true);
                        foreach($shippingfee as $sfkey=>$sfval){
                            if(!empty($sfval)){
                                $inquiryshippingfee[$ctval['shoperid']][$sfkey] = sprintf('%.2f',$sfval);
                            }
                        }
                        // $inquiryshippingfee[$ctval['shoperid']][$ctval['free_type']] = $ctval['free_price'];//$ctval['free_type'];
                        //$inquiryshippingfee[$ctval['shoperid']]['free_price'] = $ctval['free_price'];
                    }
                    // 获取供货商信息
                    $companytemp = array_column($competeinfo, 'shoperid');
                    foreach($companytemp as $ctkey=>$ctval){
                        if(empty($ctval)){
                            continue;
                        }
                        $ctemp = $this->membersdb->getMemberInfoByUserid($ctval);
                        if(empty($ctemp)){
                            continue;
                        }
                        if(!array_key_exists($ctemp['userid'], $companyinfo)){
                            $companyinfo[$ctemp['userid']] = [];
                        }
                        $companyinfo[$ctemp['userid']]['userid'] = $ctemp['userid'];
                        $companyinfo[$ctemp['userid']]['realname'] = $ctemp['realname'];
                        $companyinfo[$ctemp['userid']]['username'] = $ctemp['username'];
                        $companyinfo[$ctemp['userid']]['rtype'] = $ctemp['rtype'];
                        $companyinfo[$ctemp['userid']]['mobile'] = $ctemp['mobile'];
                    }
                }
                //商铺信息
                $sellerInfo = [];
                if(!empty($inquiryinfo['supplierid'])){
                    $sellerInfo = $this->membersdb->getMemberInfoByUserid($inquiryinfo['supplierid']);
                }
                $this->load->vars('sellerInfo',$sellerInfo);
                $this->load->vars('inquiryinfo',$inquiryinfo);
                $this->load->vars('competeparts',$competeparts);
                $this->load->vars('inquiryshippingfee',$inquiryshippingfee);
                $this->load->vars('companyinfo',$companyinfo);
                $this->load->view('inquiry/detail');
            }else{
                $data['msg'] = '传递参数错误';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
	}
        
        /*
	 * 报价单详情
	 */
	public function offerdetail(){
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
                $this->load->vars('memberInfo',$memberInfo);
                // 获取厂商配件报价信息
                //$competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryBatchcode($inquiryinfo['batchcode'],$inquiryinfo['quotation_batchcode']);
                $competeinfo = $this->inquiryoffermodel->getInquiryOfferInfoByInquiryCode($inquirycode,$inquiryinfo['quotation_batchcode']);
                $companyinfo = []; // 报价单供货商信息
                $competeparts = []; // 报价单配件信息
                $inquiryshippingfee = []; // 报价单运费
                if(!empty($competeinfo)){
                    // 设置报价单配件信息
                    foreach($competeinfo as $ctkey=>$ctval){
                        if(!array_key_exists($ctval['shoperid'], $competeparts)){
                            $competeparts[$ctval['shoperid']] = [];
                        }
                        if(!array_key_exists($ctval['partid'], $competeparts[$ctval['shoperid']])){
                            $competeparts[$ctval['shoperid']][$ctval['partid']] = [];
                        }
                        // 获取竞价成功的供货商
                        if(empty($inquiryinfo['supplierid']) && $ctval['batchcode'] == $inquiryinfo['quotation_batchcode']){
                            $inquiryinfo['supplierid'] = $ctval['shoperid'];
                        }
                        $parttemp = [];
                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['shoperid'] = $ctval['shoperid'];
                        $parttemp['partquality'] = ($ctval['partquality']==1)? '原厂原装':(($ctval['partquality']==2)?'同质配件':($ctval['partquality']==3)?'品牌件':'末指定(则默:原厂原装)');
                        $parttemp['number'] = $ctval['number'];
                        $parttemp['oecode'] = $ctval['oecode'];
                        $parttemp['partprice'] = $ctval['partprice'];
//                        $parttemp['partname'] = $ctval['partname'];
                        $parttemp['remark'] = $ctval['remark'];
                        $parttemp['partbrand'] = $ctval['partbrand'];
                        $parttemp['stock_type'] = $ctval['stock_type'];
                        $parttemp['order_day'] = $ctval['order_day'];
                        $parttemp['addtime'] = $ctval['addtime'];
                        $competeparts[$ctval['shoperid']][$ctval['partid']][] = $parttemp;
                        // 报价单运费处理
                        if(!array_key_exists($ctval['shoperid'], $inquiryshippingfee)){
                            $inquiryshippingfee[$ctval['shoperid']] = [];
                        }
                        $shippingfee = json_decode($ctval['shippingdetail'],true);
                        foreach($shippingfee as $sfkey=>$sfval){
                            if(!empty($sfval)){
                                $inquiryshippingfee[$ctval['shoperid']][$sfkey] = sprintf('%.2f',$sfval);
                            }
                        }
                        // $inquiryshippingfee[$ctval['shoperid']][$ctval['free_type']] = $ctval['free_price'];//$ctval['free_type'];
                        //$inquiryshippingfee[$ctval['shoperid']]['free_price'] = $ctval['free_price'];
                    }
                    // 获取供货商信息
                    $companytemp = array_column($competeinfo, 'shoperid');
                    foreach($companytemp as $ctkey=>$ctval){
                        if(empty($ctval)){
                            continue;
                        }
                        $ctemp = $this->membersdb->getMemberInfoByUserid($ctval);
                        if(empty($ctemp)){
                            continue;
                        }
                        if(!array_key_exists($ctemp['userid'], $companyinfo)){
                            $companyinfo[$ctemp['userid']] = [];
                        }
                        $companyinfo[$ctemp['userid']]['userid'] = $ctemp['userid'];
                        $companyinfo[$ctemp['userid']]['realname'] = $ctemp['realname'];
                        $companyinfo[$ctemp['userid']]['username'] = $ctemp['username'];
                        $companyinfo[$ctemp['userid']]['rtype'] = $ctemp['rtype'];
                        $companyinfo[$ctemp['userid']]['mobile'] = $ctemp['mobile'];
                    }
                }
                //商铺信息
                $sellerInfo = [];
                if(!empty($inquiryinfo['supplierid'])){
                    $sellerInfo = $this->membersdb->getMemberInfoByUserid($inquiryinfo['supplierid']);
                }
                $this->load->vars('sellerInfo',$sellerInfo);
                $this->load->vars('inquiryinfo',$inquiryinfo);
                $this->load->vars('competeparts',$competeparts);
                $this->load->vars('inquiryshippingfee',$inquiryshippingfee);
                $this->load->vars('companyinfo',$companyinfo);
                $this->load->view('inquiry/offerdetail');
            }else{
                $data['msg'] = '传递参数错误';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
	}
        
        public function ajaxAdd(){
            $returndata = ['flag'=>0,'message'=>[]];
            if(empty($this->input->post('userid')) || !is_numeric($this->input->post('userid'))){
                $returndata['message']['userid'] = '客户信息无效!';
            }
            if(!checkTel($this->input->post('shipping_mobile'))){
                $returndata['message']['shipping_mobile'] = '客户收货联系电话无效!';
            }
            if(empty($this->input->post('shipping_address'))){
                $returndata['message']['shipping_address'] = '客户收货地址无效!';
            }
            if(empty($this->input->post('brand_factory_text'))){
                $returndata['message']['brand_and_factory'] = '请填写供货商供货品牌或者厂商(比如:宝马)!';
            }
            if (empty($this->input->post('modelstr')) && empty($this->input->post('vincode'))) {
                $returndata['message']['vincode'] = '车型信息与车架号(V码)至少需要输入一项!';
            }
            if (!empty($this->input->post('vincode')) && !preg_match('/^([A-Za-z0-9]){17}$/u', $this->input->post('vincode'))) {
                $returndata['message']['vincode'] = '请输入17位车架号!';
            }
            $partname = $this->input->post('pname');
            if (empty($partname)) {
                $returndata['message']['parts'] = '请添加配件!';
            }
            if(!empty($returndata['message'])){ // 如果有检验错误信息则返回信息
                echo json_encode($returndata);
                return;
            }
            $i = 1;
            $returndata['message']['pname'] = [];
            foreach ($partname as $key => $val) {
                if (mb_strlen($val) < 2 || mb_strlen($val) > 30) {
                    $returndata['message']['pname'][$key] = '第' . $i . '个配件名，请填写2到30位长度的字符';
                }
                $i++;
            }
            if(!empty($returndata['message']['pname'])){ // 如果有检验错误信息则返回信息
                echo json_encode($returndata);
                return;
            }
            // 处理收货地址
            $address = [];
            $address['id']=$this->input->post('shipping_areaid');
            $address['userid']=$this->input->post('userid');
            $address['province_id']=$this->input->post('shipping_province_id');
            $address['city_id']=$this->input->post('shipping_city_id');
            $address['county_id']=$this->input->post('shipping_area_id');
            $address['area']=$this->addressmodel->getArea($address['province_id'],true).$this->addressmodel->getArea($address['city_id'],true).$this->addressmodel->getArea($address['county_id'],true);
            $address['address']= $address['area'].$this->input->post('shipping_address');
            $address['full_name']=$this->input->post('shipping_name');
            $address['telphone']=$this->input->post('shipping_mobile');
            $addressflag = false; //添加地址是否存在
            // 获取当前用户地址条数
            $result = $this->addressmodel->getMd5Address($address['userid']);
            if(count($result)){
                foreach($result as $val){ // 判断是否存在相同地址
                    if(md5($address['full_name'].$address['telphone'].$address['address']) == $val['mresult']){
                        $addressflag = true;
                        $address['id'] = $val['addressid'];
                        break;
                    }
                }
            }
            $this->master->trans_start(); // 开启主数据事务;
            if(!$addressflag){
                unset($address['id']); // 去掉地址id
                $address['id'] = $this->addressmodel->addNewAddress($address);
            }
            // 处理询价单信息
            $inquirydata = [];
            $inquirydata['inquirycode'] = makeListCode('10');
            $inquirydata['batchcode'] = date('YmdHis').'_'.randCode(8,0).'_'. randCode(6,1);
            $inquirydata['vincode'] = makeListCode('10');
            $inquirydata['addtime'] = time();
            $inquirydata['splitpart'] = [];
            $partoecode = $this->input->post('oecode');
            $prequirement = $this->input->post('prequirement');
            $remark = $this->input->post('pcontent');
            $partnumber = $this->input->post('number');
            $partscount = count($partname);
            for($ip=0;$ip<=$partscount;$ip++){
                if(!empty($partname[$ip])){
                    $parsttemp = [];
                    $parsttemp['inquirycode'] = $inquirydata['inquirycode'];
                    $parsttemp['batchcode'] = $inquirydata['batchcode'];
                    $parsttemp['quotation_batchcode'] = '';
                    $parsttemp['vincode'] = $this->input->post('vincode');
                    $parsttemp['carmodel'] = $this->input->post('modelstr');
                    $parsttemp['partname'] = $partname[$ip]; // 配件名称
                    $parsttemp['oecode'] = empty($partoecode[$ip]) ? '': $partoecode[$ip]; // 配件oe码
                    $parsttemp['number'] = empty($partnumber[$ip]) ? 1 : $partnumber[$ip]; // 配件数量
                    $parsttemp['partquality'] = empty($prequirement[$ip]) ? 9 :$prequirement[$ip]; // 配件质量
                    $parsttemp['remark'] = empty($remark[$ip]) ? '' : $remark[$ip]; // 配件留言
                    $parsttemp['addtime'] = $inquirydata['addtime'];
                    $parsttemp['shoppingaddressid'] = $address['id'];
                    $parsttemp['memeberid'] = $this->input->post('userid'); // 客户id
                    $parsttemp['staff_id'] = $this->session->userdata('userid'); //操作员id
                    $parsttemp['status'] = 1;
                    $parsttemp['brandname'] = $this->input->post('brand_factory_text');
                    $parsttemp['sourcefrom'] = 2; //询价单来源:1:自主询单,2:待客询单
                    $inquirydata['splitpart'][] = $parsttemp;
                }
            }
            $this->purchasemaster->trans_start(); // 开启采购库事务
            // 添加询价单
            $flag = $this->inquirylistmodel->batchAddInquiryList($inquirydata['splitpart']);
            if(!$flag){
                $this->master->trans_rollback(); // 事务回滚
                $this->purchasemaster->trans_rollback(); // 事务回滚
                $returndata['message']['addError'] = '添加询价单失败!';
                echo json_encode($returndata);
                return;
            }
            // 添加配件信息到报价单
            // 1. 处理相关厂商
            $suppliers= $this->qirelationmodel->getSupplierByBrandName($this->input->post('brand_factory_text'));
            if(empty($suppliers)){
                $this->master->trans_rollback(); // 事务回滚
                $this->purchasemaster->trans_rollback(); // 事务回滚
                $returndata['message']['addError'] = '暂无供货商信息!';
                echo json_encode($returndata);
                return;
            }
            // 2. 写入到寻报价对应关系表中
            $inquiryquotionrelation = [];
            foreach($suppliers as $skey=>$sval){
                if(!array_key_exists($sval['q_shop_id'], $inquiryquotionrelation)){ // 这里只去一个报价职员
                    $inquiryquotionrelation[$sval['q_shop_id']] = [];
                    $inquiryquotionrelation[$sval['q_shop_id']]['inquirycode'] = $inquirydata['inquirycode'];
                    $inquiryquotionrelation[$sval['q_shop_id']]['shoperid'] = $sval['q_shop_id'];
                    $inquiryquotionrelation[$sval['q_shop_id']]['staffid'] = $sval['s_shop_id'];
                    $inquiryquotionrelation[$sval['q_shop_id']]['status'] = 1;
                    $inquiryquotionrelation[$sval['q_shop_id']]['addtime'] = $inquirydata['addtime'];
                }
            }
            $iqflag = $this->inquriyquotationrelationmodel->batchAddData($inquiryquotionrelation);
            if(!$iqflag){
                $this->master->trans_rollback(); // 事务回滚
                $this->purchasemaster->trans_rollback(); // 事务回滚
                $returndata['message']['addError'] = '报价关系信息处理失败!';
                echo json_encode($returndata);
                return;
            }
            // 提交事务
            $this->master->trans_commit();
            $this->purchasemaster->trans_commit();
            $returndata['message'] = $inquirydata['inquirycode'];
            $returndata['flag'] = 1;
            
            echo json_encode($returndata);
            return;
        }
        
        public function add(){
            $data = []; // 返回数据
            $userid = empty($this->input->get('userid'))? '':$this->input->get('userid');
            // 获取地址
            $data['citys'] = array();
            $data['districts'] = array();
            // 加载地址数据模型
            $data['provinces'] = $this->addressmodel->getProvince();
            
            if(is_numeric($userid)){
                // 获取用户信息
                $data['userInfo'] = $this->membersdb->getMemberInfoByUserid($userid);
                $address = $this->addressmodel->getUserDefaultAddress($userid);
                $data['userInfo']['recname'] = $address['recname'];
                $data['userInfo']['areaid'] = $address['addressid'];
                $data['userInfo']['recphone'] = $address['recphone'];
                $data['userInfo']['address'] = $address['address'];
                $data['userInfo']['shortaddress'] = str_replace($address['shortaddress'],"",$address['address']);
                $data['userInfo']['provid'] = $address['provid'];
                $data['userInfo']['cityid'] = $address['cityid'];
                $data['userInfo']['counid'] = $address['counid'];
                if (!empty($data['userInfo']['provid'])) {
                    $data['citys'] = $this->addressmodel->getArea($data['userInfo']['provid']);
                }
                if (!empty($data['userInfo']['cityid'])) {
                    $data['districts'] = $this->addressmodel->getArea($data['userInfo']['cityid']);
                }
            }else{
               $data['userInfo'] = [];
            }
            $this->load->view('inquiry/add',$data);
        }
        
        
        
  
        
}
